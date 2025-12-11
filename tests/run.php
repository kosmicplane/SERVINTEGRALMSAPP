<?php
require_once __DIR__ . '/../src/Database/Migrator.php';
require_once __DIR__ . '/../src/InventorySystem.php';

function withFreshDatabase(callable $callback): void
{
    $pdo = new PDO('sqlite::memory:');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $migrator = new Migrator($pdo, __DIR__ . '/../database/migrations');
    $migrator->migrate();
    $system = new InventorySystem($pdo);
    $callback($system, $pdo);
}

function runTest(string $name, callable $callback): void
{
    try {
        withFreshDatabase(function (InventorySystem $system, PDO $pdo) use ($callback) {
            $callback($system, $pdo);
        });
        echo "[PASS] {$name}\n";
    } catch (Throwable $e) {
        echo "[FAIL] {$name}: {$e->getMessage()}\n";
        exit(1);
    }
}

runTest('Cotización aprobada genera OT', function (InventorySystem $system, PDO $pdo) {
    $system->setPermission('manager', 'create_quotation', true);
    $system->setPermission('manager', 'approve_quotation', true);
    $system->setPermission('manager', 'generate_work_order', true);

    $supplierId = $system->createSupplier('Proveedor Demo');
    $itemCode = $system->createInventoryItem('SKU-1', 'Producto 1');

    $quotationId = $system->createQuotation($supplierId, [
        ['item_code' => $itemCode, 'quantity' => 2, 'unit_price' => 100],
    ], 'manager');

    $workOrderId = $system->approveQuotation($quotationId, 'manager');

    $woStatus = $pdo->query('SELECT status FROM work_orders WHERE id = ' . $workOrderId)->fetchColumn();
    $quotationStatus = $pdo->query('SELECT status FROM quotations WHERE id = ' . $quotationId)->fetchColumn();

    if ($woStatus !== 'open' || $quotationStatus !== 'approved') {
        throw new RuntimeException('No se generó la OT o la cotización no fue aprobada');
    }
});

runTest('RQ de almacén descuenta inventario y referencia a OT', function (InventorySystem $system, PDO $pdo) {
    $system->setPermission('storekeeper', 'create_rq', true);
    $system->setPermission('storekeeper', 'fulfill_rq', true);
    $system->setPermission('storekeeper', 'generate_work_order', true);

    $workOrderId = $system->generateWorkOrder(null, 'storekeeper');
    $itemCode = $system->createInventoryItem('SKU-2', 'Cable', 10, 5.0);

    $rqId = $system->createWarehouseRequisition($workOrderId, [
        ['item_code' => $itemCode, 'quantity' => 4],
    ], 'storekeeper');

    $system->fulfillWarehouseRequisition($rqId, 'storekeeper');

    $stmt = $pdo->prepare('SELECT AMOUNT FROM inve WHERE CODE = :code');
    $stmt->execute([':code' => $itemCode]);
    $stock = (int)$stmt->fetchColumn();
    if ($stock !== 6) {
        throw new RuntimeException('El stock esperado de 6 no coincide');
    }

    $movement = $pdo->query('SELECT * FROM inve_movimientos ORDER BY ID DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC);
    if ($movement['ID_OT'] != $workOrderId) {
        throw new RuntimeException('El movimiento no está ligado correctamente a la OT');
    }

    $expectedColumns = ['FECHA_HORA', 'ITEM_CODE', 'TIPO_MOVIMIENTO', 'SUB_TIPO', 'CANTIDAD', 'COSTO_UNITARIO', 'COSTO_TOTAL', 'ID_OT', 'ID_OC', 'ID_USUARIO', 'OBSERVACIONES'];
    foreach ($expectedColumns as $column) {
        if (!array_key_exists($column, $movement)) {
            throw new RuntimeException("La columna {$column} no se encontró en el movimiento de inventario");
        }
    }
});

runTest('RQ de compras genera OC y entrada con costos promedio', function (InventorySystem $system, PDO $pdo) {
    $system->setPermission('buyer', 'create_rq', true);
    $system->setPermission('buyer', 'create_purchase_order', true);
    $system->setPermission('buyer', 'receive_purchase', true);
    $system->setPermission('buyer', 'generate_work_order', true);

    $supplierId = $system->createSupplier('Proveedor Compras');
    $itemCode = $system->createInventoryItem('SKU-3', 'Pieza', 5, 20.0);
    $workOrderId = $system->generateWorkOrder(null, 'buyer');

    $rqId = $system->createPurchaseRequisition($workOrderId, [
        ['item_code' => $itemCode, 'quantity' => 5, 'expected_unit_cost' => 18.0],
    ], 'buyer');

    $poId = $system->createPurchaseOrderFromRequisition($rqId, $supplierId, 'buyer');

    $system->receivePurchaseOrder($poId, [
        ['item_code' => $itemCode, 'quantity' => 5, 'unit_cost' => 16.0],
    ], 'buyer');

    $stmt = $pdo->prepare('SELECT AMOUNT, COST FROM inve WHERE CODE = :code');
    $stmt->execute([':code' => $itemCode]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ((int)$data['AMOUNT'] !== 10) {
        throw new RuntimeException('La entrada no actualizó el stock correctamente');
    }

    $expectedAverage = ((5 * 20) + (5 * 16)) / 10;
    if (abs($data['COST'] - $expectedAverage) > 0.0001) {
        throw new RuntimeException('El costo promedio no coincide');
    }

    $status = $pdo->query('SELECT status FROM purchase_orders WHERE id = ' . $poId)->fetchColumn();
    if ($status !== 'received') {
        throw new RuntimeException('La orden de compra no está cerrada');
    }
});

runTest('Exportación de inventario genera CSV', function (InventorySystem $system) {
    $system->setPermission('manager', 'export_inventory', true);
    $system->createInventoryItem('SKU-4', 'Filtro', 3, 12.5);
    $csv = $system->exportInventory('manager');

    if (strpos($csv, 'SKU-4') === false || strpos($csv, 'Filtro') === false) {
        throw new RuntimeException('La exportación no incluye el inventario cargado');
    }
});

runTest('Restricciones de permisos bloquean operaciones', function (InventorySystem $system) {
    $system->setPermission('guest', 'create_quotation', false);
    $supplierId = $system->createSupplier('Proveedor Restringido');
    $itemCode = $system->createInventoryItem('SKU-5', 'Bloqueado');
    $error = null;

    try {
        $system->createQuotation($supplierId, [
            ['item_code' => $itemCode, 'quantity' => 1, 'unit_price' => 10],
        ], 'guest');
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }

    if ($error === null) {
        throw new RuntimeException('Se permitió crear la cotización sin permisos');
    }
});
