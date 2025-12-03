<?php

class purchases
{
    private $db;

    public function __construct()
    {
        $this->db = new sql_query();
    }

    private function ensureTables()
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS suppliers (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            CODE VARCHAR(64) UNIQUE,
            NAME VARCHAR(255) NOT NULL,
            NIT VARCHAR(64) DEFAULT NULL,
            CONTACT VARCHAR(255) DEFAULT NULL,
            EMAIL VARCHAR(255) DEFAULT NULL,
            PHONE VARCHAR(128) DEFAULT NULL,
            ADDRESS VARCHAR(255) DEFAULT NULL,
            CITY VARCHAR(128) DEFAULT NULL,
            CREATED_AT DATETIME NOT NULL,
            UPDATED_AT DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("CREATE TABLE IF NOT EXISTS purchase_orders (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            CODE VARCHAR(64) UNIQUE,
            RQCODE VARCHAR(64) DEFAULT NULL,
            SUPPLIERCODE VARCHAR(64) NOT NULL,
            STATUS VARCHAR(32) NOT NULL,
            CURRENCY VARCHAR(8) DEFAULT 'COP',
            NOTES TEXT,
            CREATED_BY VARCHAR(128) DEFAULT NULL,
            CREATED_AT DATETIME NOT NULL,
            UPDATED_AT DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("CREATE TABLE IF NOT EXISTS purchase_order_items (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            CODE VARCHAR(64) UNIQUE,
            PO_CODE VARCHAR(64) NOT NULL,
            RQ_ITEM_CODE VARCHAR(64) DEFAULT NULL,
            DESCRIPTION TEXT NOT NULL,
            QTY DECIMAL(18,4) NOT NULL DEFAULT 0,
            UNIT_COST DECIMAL(18,2) NOT NULL DEFAULT 0,
            NEGOTIATED_COST DECIMAL(18,2) NOT NULL DEFAULT 0,
            CREATED_AT DATETIME NOT NULL,
            UPDATED_AT DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("CREATE TABLE IF NOT EXISTS purchase_order_status (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            PO_CODE VARCHAR(64) NOT NULL,
            STATUS VARCHAR(32) NOT NULL,
            COMMENTARY TEXT,
            CREATED_BY VARCHAR(128) DEFAULT NULL,
            CREATED_AT DATETIME NOT NULL
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

        $this->db->query("CREATE TABLE IF NOT EXISTS inventory_items (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            SKU VARCHAR(128) UNIQUE,
            DESCRIPTION TEXT,
            AVG_COST DECIMAL(18,4) DEFAULT 0,
            ON_HAND DECIMAL(18,4) DEFAULT 0,
            UPDATED_AT DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("CREATE TABLE IF NOT EXISTS inventory_movements (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            SKU VARCHAR(128) NOT NULL,
            QTY DECIMAL(18,4) NOT NULL,
            UNIT_COST DECIMAL(18,2) NOT NULL,
            MOV_TYPE VARCHAR(32) NOT NULL,
            PO_CODE VARCHAR(64) DEFAULT NULL,
            OT_CODE VARCHAR(64) DEFAULT NULL,
            RQCODE VARCHAR(64) DEFAULT NULL,
            CREATED_AT DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        ");
    }

    public function createSupplier($info)
    {
        $this->ensureTables();
        $code = md5($info['NAME'] . $info['NIT'] . date('c'));
        $now = date('Y-m-d H:i:s');

        $str = "INSERT INTO suppliers (CODE, NAME, NIT, CONTACT, EMAIL, PHONE, ADDRESS, CITY, CREATED_AT, UPDATED_AT) VALUES ('{$code}', '{$info['NAME']}', '{$info['NIT']}', '{$info['CONTACT']}', '{$info['EMAIL']}', '{$info['PHONE']}', '{$info['ADDRESS']}', '{$info['CITY']}', '{$now}', '{$now}')";
        $this->db->query($str);

        return [
            'message' => ['CODE' => $code],
            'status' => true,
        ];
    }

    public function listSuppliers()
    {
        $this->ensureTables();
        $query = $this->db->query("SELECT * FROM suppliers ORDER BY NAME ASC");
        return ['message' => $query, 'status' => true];
    }

    public function createPoFromRq($info)
    {
        $this->ensureTables();
        $poCode = 'OC-' . date('YmdHis');
        $now = date('Y-m-d H:i:s');
        $status = 'CREATED';

        $rqCode = isset($info['rq_code']) ? $info['rq_code'] : null;
        $supplier = $info['supplier_code'];
        $currency = isset($info['currency']) ? $info['currency'] : 'COP';
        $notes = isset($info['notes']) ? $info['notes'] : '';
        $createdBy = isset($info['created_by']) ? $info['created_by'] : null;

        $this->db->query("INSERT INTO purchase_orders (CODE, RQCODE, SUPPLIERCODE, STATUS, CURRENCY, NOTES, CREATED_BY, CREATED_AT, UPDATED_AT) VALUES ('{$poCode}', '{$rqCode}', '{$supplier}', '{$status}', '{$currency}', '{$notes}', '{$createdBy}', '{$now}', '{$now}')");

        $items = isset($info['items']) ? $info['items'] : [];
        foreach ($items as $item) {
            $itemCode = md5($poCode . $item['description'] . $item['rq_item_code'] . $now . rand());
            $qty = isset($item['qty']) ? $item['qty'] : 0;
            $cost = isset($item['unit_cost']) ? $item['unit_cost'] : 0;
            $nego = isset($item['negotiated_cost']) ? $item['negotiated_cost'] : $cost;
            $desc = $item['description'];
            $rqItem = isset($item['rq_item_code']) ? $item['rq_item_code'] : null;

            $sql = "INSERT INTO purchase_order_items (CODE, PO_CODE, RQ_ITEM_CODE, DESCRIPTION, QTY, UNIT_COST, NEGOTIATED_COST, CREATED_AT, UPDATED_AT) VALUES ('{$itemCode}', '{$poCode}', '{$rqItem}', '{$desc}', '{$qty}', '{$cost}', '{$nego}', '{$now}', '{$now}')";
            $this->db->query($sql);
        }

        $this->db->query("INSERT INTO purchase_order_status (PO_CODE, STATUS, COMMENTARY, CREATED_BY, CREATED_AT) VALUES ('{$poCode}', '{$status}', 'Orden creada desde RQ', '{$createdBy}', '{$now}')");

        return ['message' => ['POCODE' => $poCode], 'status' => true];
    }

    public function updateNegotiatedCosts($info)
    {
        $this->ensureTables();
        $poCode = $info['po_code'];
        $items = isset($info['items']) ? $info['items'] : [];
        $now = date('Y-m-d H:i:s');

        foreach ($items as $item) {
            if (!isset($item['code'])) {
                continue;
            }
            $cost = isset($item['negotiated_cost']) ? $item['negotiated_cost'] : $item['unit_cost'];
            $sql = "UPDATE purchase_order_items SET NEGOTIATED_COST = '{$cost}', UPDATED_AT = '{$now}' WHERE CODE = '{$item['code']}'";
            $this->db->query($sql);
        }

        $this->db->query("UPDATE purchase_orders SET UPDATED_AT = '{$now}', STATUS = 'NEGOTIATED' WHERE CODE = '{$poCode}'");
        $this->db->query("INSERT INTO purchase_order_status (PO_CODE, STATUS, COMMENTARY, CREATED_AT) VALUES ('{$poCode}', 'NEGOTIATED', 'Costos pactados', '{$now}')");

        return ['message' => 'updated', 'status' => true];
    }

    public function listPurchaseOrders()
    {
        $this->ensureTables();
        $query = $this->db->query("SELECT purchase_orders.*, suppliers.NAME AS SUPPLIERNAME FROM purchase_orders LEFT JOIN suppliers ON suppliers.CODE = purchase_orders.SUPPLIERCODE ORDER BY purchase_orders.CREATED_AT DESC LIMIT 50");

        foreach ($query as &$po) {
            $po['ITEMS'] = $this->db->query("SELECT * FROM purchase_order_items WHERE PO_CODE = '{$po['CODE']}'");
        }

        return ['message' => $query, 'status' => true];
    }

    public function receivePurchase($info)
    {
        $this->ensureTables();
        $poCode = $info['po_code'];
        $receipts = isset($info['receipts']) ? $info['receipts'] : [];
        $now = date('Y-m-d H:i:s');

        $poQuery = $this->db->query("SELECT * FROM purchase_orders WHERE CODE = '{$poCode}' LIMIT 1");
        if (count($poQuery) === 0) {
            throw new Exception('Orden de compra no encontrada');
        }

        $items = $this->db->query("SELECT * FROM purchase_order_items WHERE PO_CODE = '{$poCode}'");
        $itemsByCode = [];
        foreach ($items as $item) {
            $receivedSum = $this->db->query("SELECT COALESCE(SUM(RECEIVED_QTY),0) AS TOTAL FROM po_receipts WHERE ITEM_CODE = '{$item['CODE']}'");
            $itemsByCode[$item['CODE']] = [
                'data' => $item,
                'received' => isset($receivedSum[0]['TOTAL']) ? floatval($receivedSum[0]['TOTAL']) : 0,
            ];
        }

        $this->db->beginTransaction();
        try {
            foreach ($receipts as $rec) {
                $itemCode = $rec['item_code'];
                $qty = floatval($rec['qty']);
                $cost = floatval($rec['unit_cost']);
                $sku = $rec['sku'];
                $desc = isset($rec['description']) ? $rec['description'] : '';
                $ot = isset($rec['ot_code']) ? $rec['ot_code'] : null;
                $rq = isset($rec['rq_code']) ? $rec['rq_code'] : null;

                if (!isset($itemsByCode[$itemCode])) {
                    throw new Exception('El ítem recibido no pertenece a la OC');
                }

                $item = $itemsByCode[$itemCode]['data'];
                $already = $itemsByCode[$itemCode]['received'];
                $remaining = floatval($item['QTY']) - $already;
                if ($qty <= 0 || $qty > $remaining) {
                    throw new Exception('Cantidad inválida o superior a lo solicitado en la OC');
                }

                $expectedCost = floatval($item['NEGOTIATED_COST'] > 0 ? $item['NEGOTIATED_COST'] : $item['UNIT_COST']);
                if (round($cost, 2) !== round($expectedCost, 2)) {
                    throw new Exception('El costo recibido no coincide con la OC');
                }

                $this->db->query("INSERT INTO po_receipts (PO_CODE, ITEM_CODE, RECEIVED_QTY, UNIT_COST, OT_CODE, RQCODE, CREATED_BY, CREATED_AT) VALUES ('{$poCode}', '{$itemCode}', '{$qty}', '{$cost}', '{$ot}', '{$rq}', '{$info['created_by']}', '{$now}')");
                $itemsByCode[$itemCode]['received'] += $qty;

                $existing = $this->db->query("SELECT * FROM inventory_items WHERE SKU = '{$sku}'");
                if (count($existing) > 0) {
                    $current = $existing[0];
                    $newQty = floatval($current['ON_HAND']) + $qty;
                    $newAvg = $newQty > 0 ? ((($current['AVG_COST'] * $current['ON_HAND']) + ($cost * $qty)) / $newQty) : $cost;
                    $this->db->query("UPDATE inventory_items SET AVG_COST = '{$newAvg}', ON_HAND = '{$newQty}', DESCRIPTION = '{$desc}', UPDATED_AT = '{$now}' WHERE SKU = '{$sku}'");
                } else {
                    $this->db->query("INSERT INTO inventory_items (SKU, DESCRIPTION, AVG_COST, ON_HAND, UPDATED_AT) VALUES ('{$sku}', '{$desc}', '{$cost}', '{$qty}', '{$now}')");
                }

                $this->db->query("INSERT INTO inventory_movements (SKU, QTY, UNIT_COST, MOV_TYPE, PO_CODE, OT_CODE, RQCODE, CREATED_AT) VALUES ('{$sku}', '{$qty}', '{$cost}', 'RECEIPT', '{$poCode}', '{$ot}', '{$rq}', '{$now}')");

                $this->registerLegacyMovement($sku, $desc, $qty, $cost, $poCode, $ot, $rq, $info['created_by'], $now);
            }

            $totalOrdered = $this->db->query("SELECT COALESCE(SUM(QTY),0) AS QTY FROM purchase_order_items WHERE PO_CODE = '{$poCode}'");
            $totalReceived = $this->db->query("SELECT COALESCE(SUM(RECEIVED_QTY),0) AS QTY FROM po_receipts WHERE PO_CODE = '{$poCode}'");

            $ordered = isset($totalOrdered[0]['QTY']) ? floatval($totalOrdered[0]['QTY']) : 0;
            $received = isset($totalReceived[0]['QTY']) ? floatval($totalReceived[0]['QTY']) : 0;

            $status = ($ordered > 0 && $received >= $ordered) ? 'RECEIVED' : 'RECEIVED_PARTIAL';
            $this->db->query("UPDATE purchase_orders SET STATUS = '{$status}', UPDATED_AT = '{$now}' WHERE CODE = '{$poCode}'");
            $this->db->query("INSERT INTO purchase_order_status (PO_CODE, STATUS, COMMENTARY, CREATED_AT) VALUES ('{$poCode}', '{$status}', 'Recepción de mercancía', '{$now}')");

            if (!empty($poQuery[0]['RQCODE'])) {
                $this->db->query("INSERT INTO purchase_order_status (PO_CODE, STATUS, COMMENTARY, CREATED_AT) VALUES ('{$poCode}', 'RQ_ATTENDED', 'Requisición atendida', '{$now}')");
            }

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }

        return ['message' => 'received', 'status' => true];
    }

    private function registerLegacyMovement($sku, $desc, $qty, $cost, $poCode, $ot, $rq, $user, $now)
    {
        try {
            $inveItem = $this->db->query("SELECT * FROM inve WHERE CODE = '{$sku}' LIMIT 1");
            if (count($inveItem) > 0) {
                $item = $inveItem[0];
                $currentQty = floatval($item['AMOUNT']);
                $newQty = $currentQty + $qty;
                $newCost = $newQty > 0 ? ((($item['COST'] * $currentQty) + ($cost * $qty)) / $newQty) : $cost;
                $this->db->query("UPDATE inve SET AMOUNT = '{$newQty}', REAL_AMOUNT = '{$newQty}', COST = '{$newCost}' WHERE CODE = '{$sku}'");
            } else {
                $this->db->query("INSERT INTO inve (CODE, DESCRIPTION, COST, AMOUNT, REAL_AMOUNT, UTILITY_PCT, STATUS) VALUES ('{$sku}', '{$desc}', '{$cost}', '{$qty}', '{$qty}', 0, 1)");
                $newCost = $cost;
            }

            $idOtValue = $ot ? "'{$ot}'" : "NULL";
            $idRq = $rq ? "Ingreso asociado a RQ {$rq}" : '';
            $this->db->query("INSERT INTO inve_movimientos (ITEM_CODE, TIPO_MOVIMIENTO, SUB_TIPO, CANTIDAD, COSTO_UNITARIO, COSTO_TOTAL, ID_USUARIO, ID_OT, ID_OC, OBSERVACIONES)
                VALUES ('{$sku}', 'ENTRADA', 'OC', '{$qty}', '{$cost}', '{$qty * $cost}', '{$user}', {$idOtValue}, '{$poCode}', '{$idRq}')");

            if (!empty($ot)) {
                $this->db->query("INSERT INTO inve_movimientos (ITEM_CODE, TIPO_MOVIMIENTO, SUB_TIPO, CANTIDAD, COSTO_UNITARIO, COSTO_TOTAL, ID_USUARIO, ID_OT, ID_OC, OBSERVACIONES)
                    VALUES ('{$sku}', 'SALIDA', 'RQ_ALMACEN', '{$qty}', '{$newCost}', '{$qty * $newCost}', '{$user}', {$idOtValue}, '{$poCode}', 'Consumo directo en OT')");
                $this->db->query("UPDATE inve SET AMOUNT = AMOUNT - {$qty}, REAL_AMOUNT = REAL_AMOUNT - {$qty} WHERE CODE = '{$sku}'");
                $this->db->query("UPDATE inventory_items SET ON_HAND = ON_HAND - {$qty} WHERE SKU = '{$sku}'");
                $this->db->query("UPDATE orders SET TOTALCOST = IFNULL(TOTALCOST,0) + {$qty * $newCost} WHERE CODE = '{$ot}'");
            }
        } catch (Exception $e) {
            // Ignorar fallas de tablas legadas pero no detener recepción
        }
    }
}

?>
