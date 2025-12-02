<?php

class InventorySystem
{
    private \PDO $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function setPermission(string $role, string $action, bool $allowed): void
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO role_permissions(role, action, allowed) VALUES(:role, :action, :allowed)
            ON CONFLICT(role, action) DO UPDATE SET allowed = excluded.allowed'
        );
        $stmt->execute([
            ':role' => $role,
            ':action' => $action,
            ':allowed' => $allowed ? 1 : 0,
        ]);
    }

    private function requirePermission(string $role, string $action): void
    {
        $stmt = $this->pdo->prepare('SELECT allowed FROM role_permissions WHERE role = :role AND action = :action');
        $stmt->execute([':role' => $role, ':action' => $action]);
        $allowed = $stmt->fetchColumn();
        if ($allowed != 1) {
            throw new RuntimeException("El rol {$role} no tiene permiso para {$action}");
        }
    }

    public function createSupplier(string $name, ?string $contact = null, ?string $email = null): int
    {
        $stmt = $this->pdo->prepare('INSERT INTO suppliers(name, contact, email) VALUES(:name, :contact, :email)');
        $stmt->execute([
            ':name' => $name,
            ':contact' => $contact,
            ':email' => $email,
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function createInventoryItem(string $sku, string $name, int $stock = 0, float $averageCost = 0): int
    {
        $stmt = $this->pdo->prepare(
            'INSERT INTO inventory_items(sku, name, stock, average_cost) VALUES(:sku, :name, :stock, :average_cost)'
        );
        $stmt->execute([
            ':sku' => $sku,
            ':name' => $name,
            ':stock' => $stock,
            ':average_cost' => $averageCost,
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function createQuotation(int $supplierId, array $items, string $role): int
    {
        $this->requirePermission($role, 'create_quotation');
        $total = 0;
        foreach ($items as $item) {
            $total += $item['quantity'] * $item['unit_price'];
        }

        $stmt = $this->pdo->prepare('INSERT INTO quotations(supplier_id, status, total) VALUES(:supplier, :status, :total)');
        $stmt->execute([
            ':supplier' => $supplierId,
            ':status' => 'draft',
            ':total' => $total,
        ]);
        $quotationId = (int)$this->pdo->lastInsertId();

        foreach ($items as $item) {
            $insertItem = $this->pdo->prepare(
                'INSERT INTO quotation_items(quotation_id, inventory_item_id, quantity, unit_price) VALUES(:quotation, :inventory, :qty, :price)'
            );
            $insertItem->execute([
                ':quotation' => $quotationId,
                ':inventory' => $item['inventory_item_id'],
                ':qty' => $item['quantity'],
                ':price' => $item['unit_price'],
            ]);
        }

        return $quotationId;
    }

    public function approveQuotation(int $quotationId, string $role): int
    {
        $this->requirePermission($role, 'approve_quotation');

        $this->pdo->beginTransaction();
        try {
            $update = $this->pdo->prepare(
                'UPDATE quotations SET status = :status, approved_at = CURRENT_TIMESTAMP WHERE id = :id'
            );
            $update->execute([':status' => 'approved', ':id' => $quotationId]);

            $workOrderId = $this->generateWorkOrder($quotationId, $role);
            $this->pdo->commit();
            return $workOrderId;
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function generateWorkOrder(?int $quotationId, string $role): int
    {
        $this->requirePermission($role, 'generate_work_order');
        $stmt = $this->pdo->prepare('INSERT INTO work_orders(quotation_id, status) VALUES(:quotation, :status)');
        $stmt->execute([
            ':quotation' => $quotationId,
            ':status' => 'open',
        ]);
        return (int)$this->pdo->lastInsertId();
    }

    public function createWarehouseRequisition(int $workOrderId, array $items, string $role): int
    {
        $this->requirePermission($role, 'create_rq');
        $stmt = $this->pdo->prepare(
            'INSERT INTO requisitions(type, status, work_order_id, requested_by) VALUES(:type, :status, :work_order_id, :requested_by)'
        );
        $stmt->execute([
            ':type' => 'warehouse',
            ':status' => 'pending',
            ':work_order_id' => $workOrderId,
            ':requested_by' => $role,
        ]);

        $rqId = (int)$this->pdo->lastInsertId();
        $this->storeRequisitionItems($rqId, $items);
        return $rqId;
    }

    public function fulfillWarehouseRequisition(int $requisitionId, string $role): void
    {
        $this->requirePermission($role, 'fulfill_rq');
        $this->pdo->beginTransaction();
        try {
            $items = $this->requisitionItems($requisitionId);
            $rq = $this->getRequisition($requisitionId);

            foreach ($items as $item) {
                $this->consumeInventory((int)$item['inventory_item_id'], (int)$item['quantity'], $rq['work_order_id'], $requisitionId);
            }

            $update = $this->pdo->prepare('UPDATE requisitions SET status = :status WHERE id = :id');
            $update->execute([':status' => 'fulfilled', ':id' => $requisitionId]);
            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function createPurchaseRequisition(int $workOrderId, array $items, string $role): int
    {
        $this->requirePermission($role, 'create_rq');
        $stmt = $this->pdo->prepare(
            'INSERT INTO requisitions(type, status, work_order_id, requested_by) VALUES(:type, :status, :work_order_id, :requested_by)'
        );
        $stmt->execute([
            ':type' => 'purchasing',
            ':status' => 'pending',
            ':work_order_id' => $workOrderId,
            ':requested_by' => $role,
        ]);

        $rqId = (int)$this->pdo->lastInsertId();
        $this->storeRequisitionItems($rqId, $items);
        return $rqId;
    }

    public function createPurchaseOrderFromRequisition(int $requisitionId, int $supplierId, string $role): int
    {
        $this->requirePermission($role, 'create_purchase_order');
        $items = $this->requisitionItems($requisitionId);
        $total = 0;
        foreach ($items as $item) {
            $expected = $item['expected_unit_cost'] ?? 0;
            $total += $item['quantity'] * $expected;
        }

        $stmt = $this->pdo->prepare(
            'INSERT INTO purchase_orders(supplier_id, requisition_id, status, total_cost) VALUES(:supplier, :requisition, :status, :total)'
        );
        $stmt->execute([
            ':supplier' => $supplierId,
            ':requisition' => $requisitionId,
            ':status' => 'open',
            ':total' => $total,
        ]);
        $poId = (int)$this->pdo->lastInsertId();

        foreach ($items as $item) {
            $insert = $this->pdo->prepare(
                'INSERT INTO purchase_order_items(purchase_order_id, inventory_item_id, quantity, unit_cost) VALUES(:po, :inventory, :qty, :cost)'
            );
            $insert->execute([
                ':po' => $poId,
                ':inventory' => $item['inventory_item_id'],
                ':qty' => $item['quantity'],
                ':cost' => $item['expected_unit_cost'] ?? 0,
            ]);
        }

        return $poId;
    }

    public function receivePurchaseOrder(int $purchaseOrderId, array $receipts, string $role): void
    {
        $this->requirePermission($role, 'receive_purchase');
        $this->pdo->beginTransaction();
        try {
            foreach ($receipts as $receipt) {
                $this->increaseInventory(
                    (int)$receipt['inventory_item_id'],
                    (int)$receipt['quantity'],
                    (float)$receipt['unit_cost'],
                    $purchaseOrderId
                );
            }

            $update = $this->pdo->prepare('UPDATE purchase_orders SET status = :status WHERE id = :id');
            $update->execute([':status' => 'received', ':id' => $purchaseOrderId]);
            $this->pdo->commit();
        } catch (Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function exportInventory(string $role): string
    {
        $this->requirePermission($role, 'export_inventory');
        $stmt = $this->pdo->query('SELECT sku, name, stock, average_cost FROM inventory_items ORDER BY sku');
        $rows = $stmt ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];

        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['SKU', 'Nombre', 'Stock', 'Costo Promedio'], ',', '"', '\\');
        foreach ($rows as $row) {
            fputcsv($csv, [$row['sku'], $row['name'], $row['stock'], $row['average_cost']], ',', '"', '\\');
        }
        rewind($csv);
        $content = stream_get_contents($csv);
        fclose($csv);
        return $content === false ? '' : $content;
    }

    private function storeRequisitionItems(int $requisitionId, array $items): void
    {
        foreach ($items as $item) {
            $stmt = $this->pdo->prepare(
                'INSERT INTO requisition_items(requisition_id, inventory_item_id, quantity, expected_unit_cost) VALUES(:rq, :inventory, :qty, :cost)'
            );
            $stmt->execute([
                ':rq' => $requisitionId,
                ':inventory' => $item['inventory_item_id'],
                ':qty' => $item['quantity'],
                ':cost' => $item['expected_unit_cost'] ?? null,
            ]);
        }
    }

    private function consumeInventory(int $inventoryItemId, int $quantity, ?int $workOrderId, int $requisitionId): void
    {
        $current = $this->getInventoryItem($inventoryItemId);
        if ($current['stock'] < $quantity) {
            throw new RuntimeException('Inventario insuficiente para completar la requisición');
        }

        $newStock = $current['stock'] - $quantity;
        $update = $this->pdo->prepare('UPDATE inventory_items SET stock = :stock WHERE id = :id');
        $update->execute([':stock' => $newStock, ':id' => $inventoryItemId]);

        $movement = $this->pdo->prepare(
            'INSERT INTO inventory_movements(inventory_item_id, movement_type, quantity, unit_cost, work_order_id, reference_type, reference_id)
            VALUES(:inventory, :type, :qty, :cost, :wo, :ref_type, :ref_id)'
        );
        $movement->execute([
            ':inventory' => $inventoryItemId,
            ':type' => 'OUT',
            ':qty' => $quantity,
            ':cost' => $current['average_cost'],
            ':wo' => $workOrderId,
            ':ref_type' => 'requisition',
            ':ref_id' => $requisitionId,
        ]);
    }

    private function increaseInventory(int $inventoryItemId, int $quantity, float $unitCost, int $purchaseOrderId): void
    {
        $current = $this->getInventoryItem($inventoryItemId);
        $existingStockValue = $current['stock'] * $current['average_cost'];
        $newStockValue = $existingStockValue + ($quantity * $unitCost);
        $newStock = $current['stock'] + $quantity;
        $newAverage = $newStock > 0 ? $newStockValue / $newStock : $unitCost;

        $update = $this->pdo->prepare('UPDATE inventory_items SET stock = :stock, average_cost = :cost WHERE id = :id');
        $update->execute([
            ':stock' => $newStock,
            ':cost' => $newAverage,
            ':id' => $inventoryItemId,
        ]);

        $movement = $this->pdo->prepare(
            'INSERT INTO inventory_movements(inventory_item_id, movement_type, quantity, unit_cost, work_order_id, reference_type, reference_id)
            VALUES(:inventory, :type, :qty, :cost, :wo, :ref_type, :ref_id)'
        );
        $movement->execute([
            ':inventory' => $inventoryItemId,
            ':type' => 'IN',
            ':qty' => $quantity,
            ':cost' => $unitCost,
            ':wo' => null,
            ':ref_type' => 'purchase_order',
            ':ref_id' => $purchaseOrderId,
        ]);
    }

    private function requisitionItems(int $requisitionId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM requisition_items WHERE requisition_id = :rq');
        $stmt->execute([':rq' => $requisitionId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    private function getRequisition(int $requisitionId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM requisitions WHERE id = :id');
        $stmt->execute([':id' => $requisitionId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            throw new RuntimeException('Requisición no encontrada');
        }
        return $result;
    }

    private function getInventoryItem(int $inventoryItemId): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM inventory_items WHERE id = :id');
        $stmt->execute([':id' => $inventoryItemId]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$result) {
            throw new RuntimeException('Ítem de inventario no encontrado');
        }
        return $result;
    }
}
