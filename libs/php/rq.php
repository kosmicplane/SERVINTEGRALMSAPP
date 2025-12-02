<?php
require('dataBase.php');

class rq_service {
    private $db;

    public function __construct()
    {
        $this->db = new sql_query();
    }

    public function handle($action, $payload)
    {
        switch ($action) {
            case 'create':
                return $this->create($payload);
            case 'list':
                return $this->list($payload);
            case 'approve':
                return $this->approve($payload);
            case 'attend':
                return $this->attend($payload);
            case 'link-ot':
                return $this->linkOt($payload);
            default:
                return $this->error('Acción no soportada');
        }
    }

    private function create($payload)
    {
        $code = md5(($payload['order_code'] ?? '') . ($payload['requester'] ?? '') . microtime(true));
        $type = $payload['type'] ?? 'warehouse';
        $requester = $payload['requester'] ?? '';
        $notes = $payload['notes'] ?? '';
        $order = $payload['order_code'] ?? '';
        $items = json_decode($payload['items'] ?? '[]', true);

        $this->db->beginTransaction();
        try {
            $str = "INSERT INTO rq_headers (CODE, TYPE, ORDER_CODE, REQUESTER, NOTES, STATE) VALUES ('{$code}', '{$type}', '{$order}', '{$requester}', '{$notes}', 'pending')";
            $this->db->query($str);
            $this->appendHistory($code, 'pending', 'Creado', $requester);

            foreach ($items as $item) {
                $sku = $item['sku'];
                $desc = $item['description'];
                $qty = $item['qty'];
                $ucost = $item['unit_cost'] ?? 0;
                $source = $item['source'] ?? $type;
                $insert = "INSERT INTO rq_items (RQ_CODE, SKU, DESCRIPTION, QTY, UNIT_COST, SOURCE) VALUES ('{$code}', '{$sku}', '{$desc}', '{$qty}', '{$ucost}', '{$source}')";
                $this->db->query($insert);
            }

            $this->db->commit();
            return ["status" => true, "code" => $code];
        } catch (Exception $e) {
            $this->db->rollBack();
            return $this->error($e->getMessage());
        }
    }

    private function list($payload)
    {
        $order = $payload['order_code'] ?? '';
        $where = $order !== '' ? "WHERE ORDER_CODE = '{$order}'" : '';
        $headers = $this->db->query("SELECT * FROM rq_headers {$where} ORDER BY CREATED_AT DESC");
        $result = [];
        foreach ($headers as $header) {
            $items = $this->db->query("SELECT * FROM rq_items WHERE RQ_CODE = '" . $header['CODE'] . "'");
            $history = $this->db->query("SELECT * FROM rq_status_history WHERE RQ_CODE = '" . $header['CODE'] . "' ORDER BY CREATED_AT ASC");
            $header['ITEMS'] = $items;
            $header['HISTORY'] = $history;
            $result[] = $header;
        }
        return ["status" => true, "data" => $result];
    }

    private function approve($payload)
    {
        $code = $payload['code'] ?? '';
        $approver = $payload['approver'] ?? '';
        $str = "UPDATE rq_headers SET STATE='approved', APPROVED_BY='{$approver}' WHERE CODE='{$code}'";
        $this->db->query($str);
        $this->appendHistory($code, 'approved', 'Aprobado', $approver);
        return ["status" => true, "code" => $code];
    }

    private function attend($payload)
    {
        $code = $payload['code'] ?? '';
        $attendedBy = $payload['attended_by'] ?? '';
        $items = $this->db->query("SELECT * FROM rq_items WHERE RQ_CODE = '{$code}'");
        $header = $this->db->query("SELECT * FROM rq_headers WHERE CODE = '{$code}'");
        if (count($header) === 0) {
            return $this->error('RQ no encontrada');
        }
        $orderCode = $header[0]['ORDER_CODE'];

        $this->db->beginTransaction();
        try {
            foreach ($items as $item) {
                $movement = "INSERT INTO inventory_movements (RQ_CODE, SKU, QTY, UNIT_COST, ORDER_CODE, MOVEMENT_TYPE) VALUES ('{$code}', '{$item['SKU']}', '{$item['QTY']}', '{$item['UNIT_COST']}', '{$orderCode}', 'out')";
                $this->db->query($movement);
            }
            $total = array_reduce($items, function ($carry, $item) {
                return $carry + ($item['QTY'] * $item['UNIT_COST']);
            }, 0);
            $impact = "INSERT INTO order_cost_impacts (ORDER_CODE, RQ_CODE, TOTAL_COST, NOTES) VALUES ('{$orderCode}', '{$code}', '{$total}', 'Atención de RQ de almacén')";
            $this->db->query($impact);
            $update = "UPDATE rq_headers SET STATE='attended', ATTENDED_BY='{$attendedBy}' WHERE CODE='{$code}'";
            $this->db->query($update);
            $this->appendHistory($code, 'attended', 'Atendido', $attendedBy);
            $this->db->commit();
            return ["status" => true, "code" => $code, "total" => $total];
        } catch (Exception $e) {
            $this->db->rollBack();
            return $this->error($e->getMessage());
        }
    }

    private function linkOt($payload)
    {
        $code = $payload['code'] ?? '';
        $order = $payload['order_code'] ?? '';
        $str = "UPDATE rq_headers SET ORDER_CODE='{$order}' WHERE CODE='{$code}'";
        $this->db->query($str);
        $this->appendHistory($code, 'pending', 'Vinculado a OT ' . $order, $payload['autor'] ?? '');
        return ["status" => true, "code" => $code];
    }

    private function appendHistory($code, $state, $comment, $user)
    {
        $str = "INSERT INTO rq_status_history (RQ_CODE, STATE, COMMENT, CHANGED_BY) VALUES ('{$code}', '{$state}', '{$comment}', '{$user}')";
        $this->db->query($str);
    }

    private function error($msg)
    {
        return ["status" => false, "message" => $msg];
    }
}

$action = isset($_POST['action']) ? $_POST['action'] : '';
$service = new rq_service();
$response = $service->handle($action, $_POST);
echo json_encode($response);
?>
