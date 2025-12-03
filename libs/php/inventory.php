<?php

class inventory
{
    private $db;

    public function __construct()
    {
        $this->db = new sql_query();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->ensureSchema();
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

    private function requireRole(array $allowedRoles)
    {
        $role = null;
        if (isset($_SESSION['user']['role'])) {
            $role = $_SESSION['user']['role'];
        } elseif (isset($_SESSION['user']['TYPE'])) {
            $role = $_SESSION['user']['TYPE'];
        }

        if ($role === null || !in_array($role, $allowedRoles, true)) {
            throw new Exception('Operación no permitida para el rol actual');
        }

        return $role;
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
        $this->requireRole(['A', 'CO']);

        $otype = isset($info['otype']) ? $info['otype'] : 'c';
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

    private function logCostAudit($itemCode, $oldCost, $newCost, $obs, $userCode)
    {
        $this->db->query("INSERT INTO inve_cost_audit (ITEM_CODE, COSTO_ANTERIOR, COSTO_NUEVO, USUARIO, OBSERVACIONES)
            VALUES ('{$itemCode}', '{$oldCost}', '{$newCost}', '{$userCode}', '{$obs}')");
    }

    public function registerEntry($info)
    {
        $this->requireRole(['A', 'CO']);

        $itemCode = $this->sanitize($info['item_code'] ?? '');
        $subType = $info['sub_type'] ?? 'STOCK';
        $qty = isset($info['quantity']) ? floatval($info['quantity']) : 0;
        $unitCost = isset($info['unit_cost']) ? floatval($info['unit_cost']) : 0;
        $idOc = isset($info['id_oc']) ? $this->sanitize($info['id_oc']) : null;
        $idOt = isset($info['id_ot']) ? $this->sanitize($info['id_ot']) : null;
        $obs = isset($info['observaciones']) ? $this->sanitize($info['observaciones']) : '';
        $userCode = $this->sanitize($_SESSION['user']['code'] ?? '');

        if ($itemCode === '' || $qty <= 0) {
            throw new Exception('Código y cantidad válidos son obligatorios');
        }

        $item = $this->fetchItem($itemCode);
        $currentQty = floatval($item['AMOUNT']);
        $currentCost = floatval($item['COST']);

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

        return ['message' => 'entry', 'status' => true, 'new_qty' => $newQty, 'avg_cost' => $newAvg];
    }

    public function registerExit($info)
    {
        $subType = $info['sub_type'] ?? 'RQ_ALMACEN';
        if ($subType === 'AJUSTE') {
            $this->requireRole(['A']);
        } else {
            $this->requireRole(['A', 'CO']);
        }

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
