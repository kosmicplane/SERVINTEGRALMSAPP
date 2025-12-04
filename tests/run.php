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

    $movement = $pdo->query('SELECT ID_OT FROM inve_movimientos ORDER BY ID DESC LIMIT 1')->fetch(PDO::FETCH_ASSOC);
    if ($movement['ID_OT'] != $workOrderId) {
        throw new RuntimeException('El movimiento no está ligado correctamente a la OT');
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

function runSimpleTest(string $name, callable $callback): void
{
    try {
        $callback();
        echo "[PASS] {$name}\n";
    } catch (Throwable $e) {
        echo "[FAIL] {$name}: {$e->getMessage()}\n";
        exit(1);
    }
}

function ensureInventoryTestDoubles(): void
{
    if (!class_exists('sql_query')) {
        class sql_query
        {
            public static $fixture = [];
            public $queries = [];

            public function __construct()
            {
            }

            public function beginTransaction(): void
            {
                $this->queries[] = 'BEGIN';
            }

            public function commit(): void
            {
                $this->queries[] = 'COMMIT';
            }

            public function rollBack(): void
            {
                $this->queries[] = 'ROLLBACK';
            }

            public function query($string)
            {
                $this->queries[] = $string;

                if (preg_match("/SELECT \* FROM inve WHERE CODE = '([^']+)'/", $string, $matches)) {
                    $code = $matches[1];
                    return isset(self::$fixture[$code]) ? [self::$fixture[$code]] : [];
                }

                if (preg_match('/SELECT CODE, DESCRIPTION, AMOUNT, COST FROM inve/', $string)) {
                    $rows = [];
                    foreach (self::$fixture as $code => $data) {
                        $rows[] = [
                            'CODE' => $code,
                            'DESCRIPTION' => $data['DESCRIPTION'] ?? '',
                            'AMOUNT' => $data['AMOUNT'] ?? 0,
                            'COST' => $data['COST'] ?? 0,
                        ];
                    }

                    return $rows;
                }

                return [];
            }
        }
    }
}

function makeInventoryForRole(string $role): inventory
{
    ensureInventoryTestDoubles();

    if (!isset($_SESSION) || !is_array($_SESSION)) {
        $_SESSION = [];
    }

    $_SESSION['user'] = [
        'role' => $role,
        'TYPE' => $role,
        'code' => 'tester',
    ];

    sql_query::$fixture = [
        'SKU-TEST' => [
            'CODE' => 'SKU-TEST',
            'DESCRIPTION' => 'Item de prueba',
            'AMOUNT' => 10,
            'REAL_AMOUNT' => 10,
            'COST' => 5,
            'MARGIN' => 0,
        ],
    ];

    require_once __DIR__ . '/../libs/php/inventory.php';

    return new inventory();
}

runSimpleTest('Inventario: conteo físico permitido para roles autorizados', function () {
    $inv = makeInventoryForRole('A');

    $result = $inv->recordPhysicalCount([
        'item_code' => 'SKU-TEST',
        'physical_count' => 12,
        'observaciones' => 'conteo',
    ]);

    if ($result['status'] !== true || $result['variance'] !== 2.0) {
        throw new RuntimeException('El conteo físico no devolvió los datos esperados');
    }
});

runSimpleTest('Inventario: conteo físico bloqueado para roles no autorizados', function () {
    $inv = makeInventoryForRole('C');

    try {
        $inv->recordPhysicalCount([
            'item_code' => 'SKU-TEST',
            'physical_count' => 5,
        ]);

        throw new RuntimeException('Se permitió el conteo físico a un rol no autorizado');
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'Rol actual no autorizado') === false) {
            throw $e;
        }
    }
});

runSimpleTest('Inventario: cambio de costo en ajuste requiere administrador', function () {
    $inv = makeInventoryForRole('CO');

    try {
        $inv->applyPhysicalAdjustment([
            'item_code' => 'SKU-TEST',
            'physical_count' => 12,
            'unit_cost' => 8,
        ]);

        throw new RuntimeException('Se permitió cambiar el costo sin rol administrador');
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'Solo un administrador puede modificar el costo') === false) {
            throw $e;
        }
    }
});

runSimpleTest('Inventario: exportación permitida para roles autorizados', function () {
    $inv = makeInventoryForRole('JZ');

    $result = $inv->exportInventory();

    if (empty($result['message']) || $result['status'] !== true) {
        throw new RuntimeException('La exportación no generó el archivo esperado');
    }
});

runSimpleTest('Inventario: exportación bloqueada para roles no permitidos', function () {
    $inv = makeInventoryForRole('T');

    try {
        $inv->exportInventory();
        throw new RuntimeException('Se permitió exportar inventario a un rol no autorizado');
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'Rol actual no autorizado') === false) {
            throw $e;
        }
    }
});
