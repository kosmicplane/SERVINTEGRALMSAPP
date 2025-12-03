<?php
require_once __DIR__ . '/authorization.php';

class inventory
{
    private $db;
    private $auth;

    public function __construct()
    {
        $this->db = new sql_query();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->auth = new Authorization();
        $this->ensureSchema();
    }

    private function requirePermission(string $permission, array $context = [])
    {
        $user = $this->auth->resolveUser(['data' => $context]);
        $this->auth->authorizePermission($permission, $user);
    }

    private function ensureSchema()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS inve_movimientos (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            ITEM_CODE VARCHAR(64) NOT NULL,
            TIPO_MOVIMIENTO ENUM('ENTRADA','SALIDA') NOT NULL,
            SUB_TIPO ENUM('STOCK','RECUPERADO','OC','RQ_ALMACEN','AJUSTE') NOT NULL,
            CANTIDAD DECIMAL(18,4) NOT NULL DEFAULT 0,
            COSTO_UNITARIO DECIMAL(18,4) NOT NULL DEFAULT 0,
            COSTO_TOTAL DECIMAL(18,4) NOT NULL DEFAULT 0,
            FECHA_HORA DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            ID_USUARIO VARCHAR(64) DEFAULT NULL,
            ID_OT VARCHAR(64) DEFAULT NULL,
            ID_OC VARCHAR(64) DEFAULT NULL,
            OBSERVACIONES TEXT,
            INDEX idx_item_fecha (ITEM_CODE, FECHA_HORA),
            INDEX idx_ot (ID_OT),
            INDEX idx_oc (ID_OC)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("CREATE TABLE IF NOT EXISTS po_receipts (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            PO_CODE VARCHAR(64) NOT NULL,
            ITEM_CODE VARCHAR(64) NOT NULL,
            RECEIVED_QTY DECIMAL(18,4) NOT NULL,
            UNIT_COST DECIMAL(18,2) NOT NULL,
            OT_CODE VARCHAR(64) DEFAULT NULL,
            RQCODE VARCHAR(64) DEFAULT NULL,
            CREATED_BY VARCHAR(128) DEFAULT NULL,
            CREATED_AT DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("ALTER TABLE inve ADD COLUMN IF NOT EXISTS UTILITY_PCT DECIMAL(10,2) NOT NULL DEFAULT 0 AFTER MARGIN");
        $this->db->query("ALTER TABLE inve ADD COLUMN IF NOT EXISTS REAL_AMOUNT DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER AMOUNT");
        $this->db->query("ALTER TABLE inve ADD COLUMN IF NOT EXISTS PHYSICAL_COUNT DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER REAL_AMOUNT");
        $this->db->query("ALTER TABLE inve ADD COLUMN IF NOT EXISTS VARIANCE DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER PHYSICAL_COUNT");
        $this->db->query("ALTER TABLE inve ADD COLUMN IF NOT EXISTS STATUS TINYINT(1) NOT NULL DEFAULT 1");

        $this->db->query("CREATE TABLE IF NOT EXISTS inve_cost_audit (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            ITEM_CODE VARCHAR(64) NOT NULL,
            COSTO_ANTERIOR DECIMAL(18,4) NOT NULL,
            COSTO_NUEVO DECIMAL(18,4) NOT NULL,
            USUARIO VARCHAR(64) NOT NULL,
            OBSERVACIONES TEXT,
            FECHA DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_inve_cost_item (ITEM_CODE),
            INDEX idx_inve_cost_user (USUARIO)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    }

    private function sanitize($value)
    {
        return addslashes($value);
    }

    private function fetchItem($code)
    {
        $code = $this->sanitize($code);
        $query = $this->db->query("SELECT * FROM inve WHERE CODE = '{$code}' LIMIT 1");
        if (count($query) === 0) {
            throw new Exception('Ítem de inventario no encontrado');
        }
        return $query[0];
    }

    public function listItems($info)
    {
        $code = isset($info['code']) ? $this->sanitize($info['code']) : '';
        $desc = isset($info['description']) ? $this->sanitize($info['description']) : '';
        $where = "WHERE STATUS = 1";

        if ($code !== '') {
            $where .= " AND CODE = '{$code}'";
        }
        if ($desc !== '') {
            $where .= " AND DESCRIPTION LIKE '%{$desc}%'";
        }

        $query = $this->db->query("SELECT * FROM inve {$where} ORDER BY DESCRIPTION ASC");
        return ['message' => $query, 'status' => true];
    }

    public function saveItem($info)
    {
        $otype = isset($info['otype']) ? $info['otype'] : 'c';
        $permission = $otype === 'c' ? 'inventory.create' : 'inventory.edit';
        $this->requirePermission($permission, $info);

        $CODE = $this->sanitize($info['a-inveCode'] ?? '');
        $DESCRIPTION = $this->sanitize($info['a-inveDesc'] ?? '');
        $COST = isset($info['a-inveCost']) ? floatval($info['a-inveCost']) : 0;
        $MARGIN = isset($info['a-inveMargin']) ? floatval($info['a-inveMargin']) : 0;
        $AMOUNT = isset($info['a-inveAmount']) ? floatval($info['a-inveAmount']) : 0;
        $STATUS = 1;

        if ($CODE === '' || $DESCRIPTION === '') {
            throw new Exception('Código y descripción son obligatorios');
        }

        if ($otype === 'c') {
            $existing = $this->db->query("SELECT CODE FROM inve WHERE CODE = '{$CODE}' ORDER BY CODE ASC");
            if (count($existing) > 0) {
                return ['message' => 'exist', 'status' => false];
            }

            $this->db->query("INSERT INTO inve (CODE, DESCRIPTION, COST, MARGIN, AMOUNT, REAL_AMOUNT, UTILITY_PCT, STATUS)
                VALUES ('{$CODE}', '{$DESCRIPTION}', '{$COST}', '{$MARGIN}', '{$AMOUNT}', '{$AMOUNT}', '{$MARGIN}', '{$STATUS}')");

            return ['message' => 'create', 'status' => true];
        }

        $this->db->query("UPDATE inve SET DESCRIPTION='{$DESCRIPTION}', COST='{$COST}', MARGIN='{$MARGIN}',
            AMOUNT = '{$AMOUNT}', REAL_AMOUNT = '{$AMOUNT}', UTILITY_PCT = '{$MARGIN}' WHERE CODE ='{$CODE}'");

        return ['message' => 'edit', 'status' => true];
    }

    private function calculateAverageCost($existingQty, $existingCost, $incomingQty, $incomingCost)
    {
        $totalCost = ($existingQty * $existingCost) + ($incomingQty * $incomingCost);
        $totalQty = $existingQty + $incomingQty;
        if ($totalQty <= 0) {
            return $incomingCost;
        }
        return $totalCost / $totalQty;
    }

    private function validatePurchaseOrderReception($itemCode, $qty, $unitCost, $poCode, $poItemCode, $rqCode)
    {
        if ($poCode === null) {
            return;
        }

        $order = $this->db->query("SELECT * FROM purchase_orders WHERE CODE = '{$poCode}' LIMIT 1");
        if (count($order) === 0) {
            throw new Exception('No se encontró la OC para la entrada');
        }

        $poItem = $this->db->query("SELECT * FROM purchase_order_items WHERE CODE = '{$poItemCode}' AND PO_CODE = '{$poCode}' LIMIT 1");
        if (count($poItem) === 0) {
            throw new Exception('El ítem no pertenece a la OC indicada');
        }

        $item = $poItem[0];
        $expectedCost = floatval($item['NEGOTIATED_COST'] > 0 ? $item['NEGOTIATED_COST'] : $item['UNIT_COST']);
        if (round(floatval($unitCost), 2) !== round($expectedCost, 2)) {
            throw new Exception('El costo recibido no coincide con la OC');
        }

        $received = $this->db->query("SELECT COALESCE(SUM(RECEIVED_QTY),0) AS TOTAL FROM po_receipts WHERE ITEM_CODE = '{$poItemCode}'");
        $already = isset($received[0]['TOTAL']) ? floatval($received[0]['TOTAL']) : 0;
        $remaining = floatval($item['QTY']) - $already;
        if ($qty <= 0 || $qty > $remaining) {
            throw new Exception('Cantidad recibida supera lo autorizado en la OC');
        }

        $rqNote = $rqCode ? $rqCode : null;
        $user = $this->sanitize($_SESSION['user']['code'] ?? '');
        $this->db->query("INSERT INTO po_receipts (PO_CODE, ITEM_CODE, RECEIVED_QTY, UNIT_COST, OT_CODE, RQCODE, CREATED_BY, CREATED_AT)
            VALUES ('{$poCode}', '{$poItemCode}', '{$qty}', '{$unitCost}', NULL, '{$rqNote}', '{$user}', NOW())");
    }

    private function updatePurchaseOrderStatus($poCode, $rqCode)
    {
        if ($poCode === null) {
            return;
        }

        $totalOrdered = $this->db->query("SELECT COALESCE(SUM(QTY),0) AS QTY FROM purchase_order_items WHERE PO_CODE = '{$poCode}'");
        $totalReceived = $this->db->query("SELECT COALESCE(SUM(RECEIVED_QTY),0) AS QTY FROM po_receipts WHERE PO_CODE = '{$poCode}'");

        $ordered = isset($totalOrdered[0]['QTY']) ? floatval($totalOrdered[0]['QTY']) : 0;
        $received = isset($totalReceived[0]['QTY']) ? floatval($totalReceived[0]['QTY']) : 0;

        $status = ($ordered > 0 && $received >= $ordered) ? 'RECEIVED' : 'RECEIVED_PARTIAL';
        $now = date('Y-m-d H:i:s');

        $this->db->query("UPDATE purchase_orders SET STATUS = '{$status}', UPDATED_AT = '{$now}' WHERE CODE = '{$poCode}'");
        $this->db->query("INSERT INTO purchase_order_status (PO_CODE, STATUS, COMMENTARY, CREATED_AT) VALUES ('{$poCode}', '{$status}', 'Recepción de mercancía desde inventario', '{$now}')");

        if (!empty($rqCode)) {
            $this->db->query("INSERT INTO purchase_order_status (PO_CODE, STATUS, COMMENTARY, CREATED_AT) VALUES ('{$poCode}', 'RQ_ATTENDED', 'Requisición atendida desde inventario', '{$now}')");
        }
    private function logCostAudit($itemCode, $oldCost, $newCost, $obs, $userCode)
    {
        $this->db->query("INSERT INTO inve_cost_audit (ITEM_CODE, COSTO_ANTERIOR, COSTO_NUEVO, USUARIO, OBSERVACIONES)
            VALUES ('{$itemCode}', '{$oldCost}', '{$newCost}', '{$userCode}', '{$obs}')");
    }

    public function registerEntry($info)
    {
        $this->requirePermission('inventory.movement', $info);

        $itemCode = $this->sanitize($info['item_code'] ?? '');
        $subType = $info['sub_type'] ?? 'STOCK';
        $qty = isset($info['quantity']) ? floatval($info['quantity']) : 0;
        $unitCost = isset($info['unit_cost']) ? floatval($info['unit_cost']) : 0;
        $idOc = isset($info['id_oc']) ? $this->sanitize($info['id_oc']) : null;
        $poItemCode = isset($info['po_item_code']) ? $this->sanitize($info['po_item_code']) : $itemCode;
        $idOt = isset($info['id_ot']) ? $this->sanitize($info['id_ot']) : null;
        $obs = isset($info['observaciones']) ? $this->sanitize($info['observaciones']) : '';
        $rqCode = isset($info['rq_code']) ? $this->sanitize($info['rq_code']) : null;
        $userCode = $this->sanitize($_SESSION['user']['code'] ?? '');

        if ($itemCode === '' || $qty <= 0) {
            throw new Exception('Código y cantidad válidos son obligatorios');
        }

        $item = $this->fetchItem($itemCode);
        $currentQty = floatval($item['AMOUNT']);
        $currentCost = floatval($item['COST']);

        if ($subType === 'OC') {
            $this->validatePurchaseOrderReception($itemCode, $qty, $unitCost, $idOc, $poItemCode, $rqCode);
        }

        $newAvg = $this->calculateAverageCost($currentQty, $currentCost, $qty, $unitCost);
        $newQty = $currentQty + $qty;
        $idOcValue = $idOc ? "'{$idOc}'" : "NULL";
        $idOtValue = $idOt ? "'{$idOt}'" : "NULL";
        $costTotal = $qty * $unitCost;

        $this->db->beginTransaction();
        try {
            $this->db->query("INSERT INTO inve_movimientos (ITEM_CODE, TIPO_MOVIMIENTO, SUB_TIPO, CANTIDAD, COSTO_UNITARIO, COSTO_TOTAL, ID_USUARIO, ID_OT, ID_OC, OBSERVACIONES)
                VALUES ('{$itemCode}', 'ENTRADA', '{$subType}', '{$qty}', '{$unitCost}', '{$costTotal}', '{$userCode}', {$idOtValue}, {$idOcValue}, '{$obs}')");

            $this->db->query("UPDATE inve SET AMOUNT = '{$newQty}', REAL_AMOUNT = '{$newQty}', COST = '{$newAvg}', UTILITY_PCT = '{$item['MARGIN']}' WHERE CODE = '{$itemCode}'");

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }

        if ($subType === 'OC') {
            $this->updatePurchaseOrderStatus($idOc, $rqCode);
        }

        if (!empty($idOt)) {
            $this->db->query("UPDATE orders SET TOTALCOST = IFNULL(TOTALCOST,0) + {$costTotal} WHERE CODE = '{$idOt}'");
        }

        return ['message' => 'entry', 'status' => true, 'new_qty' => $newQty, 'avg_cost' => $newAvg];
    }

    public function registerExit($info)
    {
        $subType = $info['sub_type'] ?? 'RQ_ALMACEN';
        $this->requirePermission($subType === 'AJUSTE' ? 'inventory.adjustment' : 'inventory.movement', $info);

        $itemCode = $this->sanitize($info['item_code'] ?? '');
        $qty = isset($info['quantity']) ? floatval($info['quantity']) : 0;
        $idOt = isset($info['id_ot']) ? $this->sanitize($info['id_ot']) : null;
        $obs = isset($info['observaciones']) ? $this->sanitize($info['observaciones']) : '';
        $userCode = $this->sanitize($_SESSION['user']['code'] ?? '');

        if ($itemCode === '' || $qty <= 0) {
            throw new Exception('Código y cantidad válidos son obligatorios');
        }
        if ($subType === 'RQ_ALMACEN' && empty($idOt)) {
            throw new Exception('La salida por RQ requiere una OT asociada');
        }

        $item = $this->fetchItem($itemCode);
        $currentQty = floatval($item['AMOUNT']);
        $cost = floatval($item['COST']);

        if ($qty > $currentQty) {
            throw new Exception('No hay existencias suficientes');
        }

        $newQty = $currentQty - $qty;
        $idOtValue = $idOt ? "'{$idOt}'" : "NULL";
        $costTotal = $qty * $cost;

        $this->db->beginTransaction();
        try {
            $this->db->query("INSERT INTO inve_movimientos (ITEM_CODE, TIPO_MOVIMIENTO, SUB_TIPO, CANTIDAD, COSTO_UNITARIO, COSTO_TOTAL, ID_USUARIO, ID_OT, OBSERVACIONES)
                VALUES ('{$itemCode}', 'SALIDA', '{$subType}', '{$qty}', '{$cost}', '{$costTotal}', '{$userCode}', {$idOtValue}, '{$obs}')");

            $this->db->query("UPDATE inve SET AMOUNT = '{$newQty}', REAL_AMOUNT = '{$newQty}' WHERE CODE = '{$itemCode}'");

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }

        return ['message' => 'exit', 'status' => true, 'new_qty' => $newQty, 'avg_cost' => $cost];
    }

    public function recordPhysicalCount($info)
    {
        $this->requireRole(['A', 'CO']);

        $itemCode = $this->sanitize($info['item_code'] ?? '');
        $physicalCount = isset($info['physical_count']) ? floatval($info['physical_count']) : null;
        $obs = isset($info['observaciones']) ? $this->sanitize($info['observaciones']) : '';

        if ($itemCode === '' || $physicalCount === null || $physicalCount < 0) {
            throw new Exception('Código y conteo físico válidos son obligatorios');
        }

        $item = $this->fetchItem($itemCode);
        $realAmount = floatval($item['REAL_AMOUNT']);
        $variance = $physicalCount - $realAmount;

        $this->db->query("UPDATE inve SET PHYSICAL_COUNT = '{$physicalCount}', VARIANCE = '{$variance}' WHERE CODE = '{$itemCode}'");

        return [
            'message' => 'physical_count_saved',
            'status' => true,
            'variance' => $variance,
            'physical_count' => $physicalCount,
            'real_amount' => $realAmount,
            'observaciones' => $obs,
        ];
    }

    public function applyPhysicalAdjustment($info)
    {
        $role = $this->requireRole(['A', 'CO']);

        $itemCode = $this->sanitize($info['item_code'] ?? '');
        $physicalCount = isset($info['physical_count']) ? floatval($info['physical_count']) : null;
        $unitCost = isset($info['unit_cost']) && $info['unit_cost'] !== '' ? floatval($info['unit_cost']) : null;
        $obs = isset($info['observaciones']) ? $this->sanitize($info['observaciones']) : '';
        $userCode = $this->sanitize($_SESSION['user']['code'] ?? '');

        if ($itemCode === '' || $physicalCount === null || $physicalCount < 0) {
            throw new Exception('Código y conteo físico válidos son obligatorios para el ajuste');
        }

        $item = $this->fetchItem($itemCode);
        $currentQty = floatval($item['REAL_AMOUNT']);
        $currentCost = floatval($item['COST']);
        $variance = $physicalCount - $currentQty;

        if ($variance === 0) {
            $this->db->query("UPDATE inve SET PHYSICAL_COUNT = '{$physicalCount}', VARIANCE = 0 WHERE CODE = '{$itemCode}'");
            return ['message' => 'no_adjustment_needed', 'status' => true];
        }

        $costForAdjustment = $unitCost !== null ? $unitCost : $currentCost;
        if ($costForAdjustment !== $currentCost && $role !== 'A') {
            throw new Exception('Solo un administrador puede modificar el costo en ajustes de inventario');
        }

        if ($variance < 0 && abs($variance) > $currentQty) {
            throw new Exception('El ajuste supera la existencia registrada');
        }

        $this->db->beginTransaction();
        try {
            $this->db->query("UPDATE inve SET PHYSICAL_COUNT = '{$physicalCount}', VARIANCE = '{$variance}' WHERE CODE = '{$itemCode}'");

            if ($variance > 0) {
                $newAvg = $this->calculateAverageCost($currentQty, $currentCost, $variance, $costForAdjustment);
                $newQty = $currentQty + $variance;
                $costTotal = $variance * $costForAdjustment;

                $this->db->query("INSERT INTO inve_movimientos (ITEM_CODE, TIPO_MOVIMIENTO, SUB_TIPO, CANTIDAD, COSTO_UNITARIO, COSTO_TOTAL, ID_USUARIO, OBSERVACIONES)
                    VALUES ('{$itemCode}', 'ENTRADA', 'AJUSTE', '{$variance}', '{$costForAdjustment}', '{$costTotal}', '{$userCode}', '{$obs}')");

                $this->db->query("UPDATE inve SET AMOUNT = '{$newQty}', REAL_AMOUNT = '{$newQty}', COST = '{$newAvg}' WHERE CODE = '{$itemCode}'");

                if ($newAvg !== $currentCost) {
                    $this->logCostAudit($itemCode, $currentCost, $newAvg, $obs, $userCode);
                }
            } else {
                $varianceAbs = abs($variance);
                $costTotal = $varianceAbs * $currentCost;
                $newQty = $currentQty - $varianceAbs;

                $this->db->query("INSERT INTO inve_movimientos (ITEM_CODE, TIPO_MOVIMIENTO, SUB_TIPO, CANTIDAD, COSTO_UNITARIO, COSTO_TOTAL, ID_USUARIO, OBSERVACIONES)
                    VALUES ('{$itemCode}', 'SALIDA', 'AJUSTE', '{$varianceAbs}', '{$currentCost}', '{$costTotal}', '{$userCode}', '{$obs}')");

                $this->db->query("UPDATE inve SET AMOUNT = '{$newQty}', REAL_AMOUNT = '{$newQty}' WHERE CODE = '{$itemCode}'");
            }

            $this->db->query("UPDATE inve SET VARIANCE = 0 WHERE CODE = '{$itemCode}'");
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }

        return [
            'message' => 'adjustment_applied',
            'status' => true,
            'new_qty' => $physicalCount,
            'variance' => $variance,
            'cost_used' => $costForAdjustment,
        ];
    }

    public function listMovements($info)
    {
        $itemCode = isset($info['item_code']) ? $this->sanitize($info['item_code']) : '';
        $type = isset($info['type']) ? $this->sanitize($info['type']) : '';
        $from = isset($info['from']) ? $this->sanitize($info['from']) : '';
        $to = isset($info['to']) ? $this->sanitize($info['to']) : '';
        $idOt = isset($info['id_ot']) ? $this->sanitize($info['id_ot']) : '';

        $where = "WHERE 1=1";
        if ($itemCode !== '') {
            $where .= " AND ITEM_CODE = '{$itemCode}'";
        }
        if ($type !== '') {
            $where .= " AND TIPO_MOVIMIENTO = '{$type}'";
        }
        if ($idOt !== '') {
            $where .= " AND ID_OT = '{$idOt}'";
        }
        if ($from !== '') {
            $where .= " AND FECHA_HORA >= '{$from}'";
        }
        if ($to !== '') {
            $where .= " AND FECHA_HORA <= '{$to}'";
        }

        $query = $this->db->query("SELECT * FROM inve_movimientos {$where} ORDER BY FECHA_HORA DESC LIMIT 200");

        return ['message' => $query, 'status' => true];
    }
}

?>
