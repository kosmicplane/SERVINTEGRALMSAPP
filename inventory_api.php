<?php
header('Content-Type: application/json');
require_once('libs/php/inventory.php');

$service = new InventoryService();
$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

try {
    if ($method === 'POST' && $action === 'register_movement') {
        $payload = json_decode(file_get_contents('php://input'), true);
        if (!is_array($payload)) {
            throw new Exception('Datos inválidos', 400);
        }
        $result = $service->registerMovement($payload);
        echo json_encode(array('status' => 'ok', 'data' => $result));
        exit;
    }

    if ($method === 'GET' && $action === 'list_movements') {
        $filters = array(
            'item_code' => isset($_GET['item_code']) ? $_GET['item_code'] : null,
            'movement_code' => isset($_GET['movement_code']) ? $_GET['movement_code'] : null,
            'from' => isset($_GET['from']) ? $_GET['from'] : null,
            'to' => isset($_GET['to']) ? $_GET['to'] : null,
        );
        $rows = $service->listMovements($filters);
        echo json_encode(array('status' => 'ok', 'data' => $rows));
        exit;
    }

    if ($method === 'GET' && $action === 'export_movements') {
        $filters = array(
            'item_code' => isset($_GET['item_code']) ? $_GET['item_code'] : null,
            'movement_code' => isset($_GET['movement_code']) ? $_GET['movement_code'] : null,
            'from' => isset($_GET['from']) ? $_GET['from'] : null,
            'to' => isset($_GET['to']) ? $_GET['to'] : null,
        );
        $csv = $service->exportMovementsCsv($filters);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="movimientos.csv"');
        echo $csv;
        exit;
    }

    throw new Exception('Operación no soportada', 400);
} catch (Exception $e) {
    $code = $e->getCode();
    if ($code < 100) {
        $code = 400;
    }
    http_response_code($code);
    echo json_encode(array('status' => 'error', 'message' => $e->getMessage()));
    exit;
}
?>
