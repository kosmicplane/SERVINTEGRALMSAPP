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

        $this->db->query("CREATE TABLE IF NOT EXISTS inve (
            CODE VARCHAR(64) PRIMARY KEY,
            DESCRIPTION VARCHAR(255) NOT NULL,
            COST DECIMAL(18,4) NOT NULL DEFAULT 0,
            MARGIN DECIMAL(10,2) NOT NULL DEFAULT 0,
            AMOUNT DECIMAL(18,4) NOT NULL DEFAULT 0,
            STATUS TINYINT(1) NOT NULL DEFAULT 1,
            UTILITY_PCT DECIMAL(10,2) NOT NULL DEFAULT 0,
            REAL_AMOUNT DECIMAL(18,4) NOT NULL DEFAULT 0,
            PHYSICAL_COUNT DECIMAL(18,4) NOT NULL DEFAULT 0,
            VARIANCE DECIMAL(18,4) NOT NULL DEFAULT 0,
            UPDATED_AT DATETIME NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

        $this->db->query("CREATE TABLE IF NOT EXISTS inve_movimientos (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            ITEM_CODE VARCHAR(64) NOT NULL,
            TIPO_MOVIMIENTO VARCHAR(32) NOT NULL,
            SUB_TIPO VARCHAR(32) NOT NULL,
            CANTIDAD DECIMAL(18,4) NOT NULL DEFAULT 0,
            COSTO_UNITARIO DECIMAL(18,4) NOT NULL DEFAULT 0,
            COSTO_TOTAL DECIMAL(18,4) NOT NULL DEFAULT 0,
            FECHA_HORA DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            ID_USUARIO VARCHAR(64) DEFAULT NULL,
            ID_OT VARCHAR(64) DEFAULT NULL,
            ID_OC VARCHAR(64) DEFAULT NULL,
            OBSERVACIONES TEXT
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

        foreach ($receipts as $rec) {
            $itemCode = $rec['item_code'];
            $qty = $rec['qty'];
            $cost = $rec['unit_cost'];
            $sku = $rec['sku'];
            $desc = isset($rec['description']) ? $rec['description'] : '';
            $ot = isset($rec['ot_code']) ? $rec['ot_code'] : null;
            $rq = isset($rec['rq_code']) ? $rec['rq_code'] : null;

            $this->db->query("INSERT INTO po_receipts (PO_CODE, ITEM_CODE, RECEIVED_QTY, UNIT_COST, OT_CODE, RQCODE, CREATED_BY, CREATED_AT) VALUES ('{$poCode}', '{$itemCode}', '{$qty}', '{$cost}', '{$ot}', '{$rq}', '{$info['created_by']}', '{$now}')");

            $existing = $this->db->query("SELECT * FROM inve WHERE CODE = '{$sku}'");
            if (count($existing) > 0) {
                $current = $existing[0];
                $newQty = $current['AMOUNT'] + $qty;
                $newAvg = $newQty > 0 ? ((($current['COST'] * $current['AMOUNT']) + ($cost * $qty)) / $newQty) : $cost;
                $this->db->query("UPDATE inve SET COST = '{$newAvg}', AMOUNT = '{$newQty}', REAL_AMOUNT = '{$newQty}', DESCRIPTION = '{$desc}', UPDATED_AT = '{$now}' WHERE CODE = '{$sku}'");
            } else {
                $this->db->query("INSERT INTO inve (CODE, DESCRIPTION, COST, AMOUNT, REAL_AMOUNT, UPDATED_AT) VALUES ('{$sku}', '{$desc}', '{$cost}', '{$qty}', '{$qty}', '{$now}')");
            }

            $totalCost = $qty * $cost;
            $this->db->query("INSERT INTO inve_movimientos (ITEM_CODE, TIPO_MOVIMIENTO, SUB_TIPO, CANTIDAD, COSTO_UNITARIO, COSTO_TOTAL, ID_OC, ID_OT, OBSERVACIONES, FECHA_HORA, ID_USUARIO) VALUES ('{$sku}', 'ENTRADA', 'OC', '{$qty}', '{$cost}', '{$totalCost}', '{$poCode}', '{$ot}', 'Entrada de mercancía OC {$poCode}', '{$now}', '{$info['created_by']}')");
        }

        $this->db->query("UPDATE purchase_orders SET STATUS = 'RECEIVED', UPDATED_AT = '{$now}' WHERE CODE = '{$poCode}'");
        $this->db->query("INSERT INTO purchase_order_status (PO_CODE, STATUS, COMMENTARY, CREATED_AT) VALUES ('{$poCode}', 'RECEIVED', 'Recepción de mercancía', '{$now}')");

        return ['message' => 'received', 'status' => true];
    }
}

?>
