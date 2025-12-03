<?php
// mentry.php – Router central de AJAX

// ==== CONFIG BÁSICA Y SESIÓN ==================================
ini_set('display_errors', 0);            // en producción, mantener 0
ini_set('log_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Todas las respuestas serán JSON
header('Content-Type: application/json; charset=utf-8');

// ==== INCLUDES ================================================
// Ajusta la ruta si en tu hosting cambia la estructura
require_once __DIR__ . '/conector.php';
require_once __DIR__ . '/users.php';

// Estos dos sólo se usan para el nuevo módulo de inventario/compras
// No rompen nada si la asignación de técnico no los usa.
if (file_exists(__DIR__ . '/inventory.php')) {
    require_once __DIR__ . '/inventory.php';
}
if (file_exists(__DIR__ . '/purchases.php')) {
    require_once __DIR__ . '/purchases.php';
}

// Permisos a nivel backend (opcional, sólo si ya estás usando permissions.php)
$permissionsConfig = [];
if (file_exists(__DIR__ . '/permissions.php')) {
    $permissionsConfig = require __DIR__ . '/permissions.php';
}

/**
 * Clase muy simple para autorización.
 * Si no quieres bloquear nada por ahora, puedes hacer que siempre permita.
 */
class Authorization
{
    private array $rolePermissions;
    private array $methodPermissions;

    public function __construct(array $config)
    {
        $this->rolePermissions   = $config['role_permissions']   ?? [];
        $this->methodPermissions = $config['method_permissions'] ?? [];
    }

    public function authorize(?string $role, string $class, string $method): void
    {
        // Si no hay config de permisos, no bloqueamos nada
        if (empty($this->rolePermissions) || empty($this->methodPermissions)) {
            return;
        }

        // Admin total
        if ($role && isset($this->rolePermissions[$role]) && in_array('*', $this->rolePermissions[$role], true)) {
            return;
        }

        if (!isset($this->methodPermissions[$class][$method])) {
            // Si un método no está mapeado, por ahora NO bloqueamos.
            // Si quieres bloquearlo, cambia esto a throw.
            return;
        }

        $required = $this->methodPermissions[$class][$method];

        // Sin rol → bloquear
        if (!$role) {
            throw new RuntimeException('Permiso denegado: usuario sin rol definido');
        }

        $userPerms = $this->rolePermissions[$role] ?? [];
        $requiredList = is_array($required) ? $required : [$required];

        foreach ($requiredList as $perm) {
            if (in_array($perm, $userPerms, true)) {
                return; // tiene al menos un permiso válido
            }
        }

        throw new RuntimeException("Permiso denegado: {$class}.{$method}");
    }
}

// ==== LECTURA DEL REQUEST =====================================
function readRequestPayload(): array
{
    // Primero intentamos JSON
    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);

    if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
        return $data;
    }

    // Fallback a POST normal (caso legacy)
    if (!empty($_POST)) {
        return $_POST;
    }

    return [];
}

try {
    $payload = readRequestPayload();

    $class  = $payload['class']  ?? null;
    $method = $payload['method'] ?? null;
    $info   = $payload['info']   ?? [];

    if (!$class || !$method) {
        throw new InvalidArgumentException('Parámetros "class" o "method" vacíos.');
    }

    // Clase soportada
    $class = trim($class);

    switch ($class) {
        case 'users':
            $object = new users();
            break;

        case 'inventory':
            if (!class_exists('inventory')) {
                throw new RuntimeException('Clase inventory no disponible en el servidor.');
            }
            $object = new inventory();
            break;

        case 'purchases':
            if (!class_exists('purchases')) {
                throw new RuntimeException('Clase purchases no disponible en el servidor.');
            }
            $object = new purchases();
            break;

        default:
            throw new InvalidArgumentException("Clase no soportada: {$class}");
    }

    if (!method_exists($object, $method)) {
        throw new BadMethodCallException("Método no encontrado: {$class}::{$method}()");
    }

    // Rol del usuario actual (TYPE en la tabla users: A, CO, JZ, T, C, etc.)
    $userRole = $_SESSION['utype'] ?? ($_SESSION['TYPE'] ?? null);

    // Autorización (si hay config de permisos)
    $auth = new Authorization($permissionsConfig);
    $auth->authorize($userRole, $class, $method);

    // Ejecutar método
    if (!is_array($info)) {
        $info = []; // seguridad: nunca pases algo que no sea array
    }

    $result = $object->$method($info);

    echo json_encode([
        'data'      => $result,
        'exception' => '',
    ], JSON_UNESCAPED_UNICODE);

} catch (Throwable $e) {
    // Aquí nos aseguramos de que NINGÚN error quede sin capturar
    http_response_code(500);

    // Log al error_log del servidor
    error_log('mentry.php error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());

    echo json_encode([
        'data'      => null,
        'exception' => $e->getMessage(),
    ], JSON_UNESCAPED_UNICODE);
}

?>
