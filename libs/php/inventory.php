<?php
require_once('dataBase.php');

class InventoryService
{
    private $db;
    private $allowedExportRoles = array('A', 'CO');

    public function __construct()
    {
        $this->db = new sql_query();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->ensureMovementTypes();
    }

    private function ensureMovementTypes()
    {
        $defaults = array(
            array('ING_STOCK', 'Entrada a stock', 'entry'),
            array('ING_RECUP', 'Entrada por recuperados', 'entry'),
            array('ING_OC', 'Entrada por orden de compra', 'entry'),
            array('SAL_RQ', 'Salida requisición almacén', 'exit'),
            array('AJUSTE', 'Ajuste de inventario', 'exit'),
        );

        foreach ($defaults as $row) {
            $code = $row[0];
            $name = $row[1];
            $direction = $row[2];
            $sql = "INSERT INTO movement_types (code, name, direction) VALUES ('{$code}', '{$name}', '{$direction}')" .
                " ON DUPLICATE KEY UPDATE name = '{$name}', direction = '{$direction}'";
            $this->db->query($sql);
        }
    }

    private function requireRole($roles)
    {
        if (empty($_SESSION['TYPE']) || !in_array($_SESSION['TYPE'], $roles)) {
            throw new Exception('No autorizado', 403);
        }
    }

    public function registerMovement($payload)
    {
        $this->requireRole(array('A', 'CO', 'JZ'));
        $code = $this->escape($payload['item_code']);
        $description = $this->escape($payload['description']);
        $movementCode = $this->escape($payload['movement_code']);
        $quantity = (float)$payload['quantity'];
        $unitCost = isset($payload['unit_cost']) ? (float)$payload['unit_cost'] : 0;
        $notes = $this->escape(isset($payload['notes']) ? $payload['notes'] : '');
        $user = isset($_SESSION['RESPNAME']) ? $_SESSION['RESPNAME'] : 'sistema';

        if ($quantity == 0) {
            throw new Exception('La cantidad debe ser diferente de cero', 400);
        }

        $movementType = $this->findMovementType($movementCode);
        if (!$movementType) {
            throw new Exception('Tipo de movimiento no encontrado', 404);
        }

        $item = $this->findOrCreateItem($code, $description);
        $previousCost = (float)$item['avg_cost'];
        $previousStock = (float)$item['stock'];

        if ($movementType['direction'] === 'entry') {
            $newStock = $previousStock + $quantity;
            $newAvgCost = $newStock > 0 ? (($previousStock * $previousCost) + ($quantity * $unitCost)) / $newStock : $unitCost;
        } else {
            $newStock = $previousStock - $quantity;
            if ($newStock < 0) {
                throw new Exception('No hay existencias suficientes para la salida solicitada', 400);
            }
            $newAvgCost = $previousCost;
            if ($movementCode === 'AJUSTE' && $unitCost > 0) {
                $newAvgCost = $unitCost;
            }
        }

        $unitCostToSave = $unitCost > 0 ? $unitCost : $newAvgCost;
        $totalCost = $unitCostToSave * $quantity;

        $this->db->beginTransaction();
        try {
            $this->updateItem($item['id'], $newStock, $newAvgCost);
            $this->insertMovement($item['id'], $movementType['id'], $quantity, $unitCostToSave, $totalCost, $notes, $user);

            if ($movementCode === 'AJUSTE' && $previousCost != $newAvgCost) {
                $this->insertCostAdjustment($item['id'], $previousCost, $newAvgCost, $notes, $user);
            }
            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }

        return array(
            'item_code' => $code,
            'stock' => $newStock,
            'avg_cost' => $newAvgCost,
        );
    }

    public function listMovements($filters)
    {
        $this->requireRole(array('A', 'CO', 'JZ', 'T'));
        $where = array();

        if (!empty($filters['item_code'])) {
            $code = $this->escape($filters['item_code']);
            $where[] = "items.code = '{$code}'";
        }
        if (!empty($filters['movement_code'])) {
            $movement = $this->escape($filters['movement_code']);
            $where[] = "movement_types.code = '{$movement}'";
        }
        if (!empty($filters['from'])) {
            $from = $this->escape($filters['from']);
            $where[] = "movements.created_at >= '{$from}'";
        }
        if (!empty($filters['to'])) {
            $to = $this->escape($filters['to']);
            $where[] = "movements.created_at <= '{$to}'";
        }

        $whereSql = count($where) ? 'WHERE ' . implode(' AND ', $where) : '';
        $sql = "SELECT movements.id, items.code AS item_code, items.description, movement_types.code AS movement_code, movement_types.name, movement_types.direction, movements.quantity, movements.unit_cost, movements.total_cost, movements.notes, movements.created_by, movements.created_at FROM movements INNER JOIN items ON items.id = movements.item_id INNER JOIN movement_types ON movement_types.id = movements.movement_type_id {$whereSql} ORDER BY movements.created_at DESC LIMIT 200";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function exportMovementsCsv($filters)
    {
        $this->requireRole($this->allowedExportRoles);
        $rows = $this->listMovements($filters);
        $out = fopen('php://temp', 'r+');
        fputcsv($out, array('ID', 'Código', 'Descripción', 'Tipo', 'Dirección', 'Cantidad', 'Costo unitario', 'Costo total', 'Notas', 'Usuario', 'Fecha'));
        foreach ($rows as $row) {
            fputcsv($out, array($row['id'], $row['item_code'], $row['description'], $row['name'], $row['direction'], $row['quantity'], $row['unit_cost'], $row['total_cost'], $row['notes'], $row['created_by'], $row['created_at']));
        }
        rewind($out);
        return stream_get_contents($out);
    }

    private function findMovementType($code)
    {
        $code = $this->escape($code);
        $sql = "SELECT * FROM movement_types WHERE code = '{$code}'";
        $resp = $this->db->query($sql);
        return count($resp) ? $resp[0] : null;
    }

    private function findOrCreateItem($code, $description)
    {
        $codeEsc = $this->escape($code);
        $sql = "SELECT * FROM items WHERE code = '{$codeEsc}'";
        $resp = $this->db->query($sql);
        if (count($resp)) {
            return $resp[0];
        }
        $desc = $this->escape($description);
        $insert = "INSERT INTO items (code, description) VALUES ('{$codeEsc}', '{$desc}')";
        $this->db->query($insert);
        $resp = $this->db->query($sql);
        return $resp[0];
    }

    private function updateItem($itemId, $stock, $avgCost)
    {
        $sql = "UPDATE items SET stock = '{$stock}', avg_cost = '{$avgCost}' WHERE id = '{$itemId}'";
        $this->db->query($sql);
    }

    private function insertMovement($itemId, $movementTypeId, $quantity, $unitCost, $totalCost, $notes, $user)
    {
        $sql = "INSERT INTO movements (item_id, movement_type_id, quantity, unit_cost, total_cost, notes, created_by) VALUES ('{$itemId}', '{$movementTypeId}', '{$quantity}', '{$unitCost}', '{$totalCost}', '{$notes}', '{$user}')";
        $this->db->query($sql);
    }

    private function insertCostAdjustment($itemId, $previousCost, $newCost, $reason, $user)
    {
        $sql = "INSERT INTO cost_adjustments (item_id, previous_cost, new_cost, reason, created_by) VALUES ('{$itemId}', '{$previousCost}', '{$newCost}', '{$reason}', '{$user}')";
        $this->db->query($sql);
    }

    private function escape($value)
    {
        return addslashes(trim($value));
    }
}
?>
