<?php
class Authorization
{
    private $rolePermissions;
    private $methodPermissions;

    public function __construct()
    {
        $config = require __DIR__ . '/permissions.php';
        $this->rolePermissions = $config['role_permissions'] ?? [];
        $this->methodPermissions = $config['method_permissions'] ?? [];
    }

    public function resolveUser(array $params)
    {
        if (!empty($_SESSION['user']) && is_array($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        if (isset($params['data']['user']) && is_array($params['data']['user'])) {
            return $params['data']['user'];
        }

        throw new Exception('Usuario no autenticado o sesión expirada');
    }

    public function assertUserConsistency(array $sessionUser, array $requestData)
    {
        if (isset($requestData['autorCode']) && $requestData['autorCode'] !== ($sessionUser['code'] ?? null)) {
            throw new Exception('El usuario autenticado no coincide con la operación solicitada');
        }

        if (isset($requestData['ucode']) && $requestData['ucode'] !== ($sessionUser['code'] ?? null)) {
            throw new Exception('El usuario autenticado no coincide con la operación solicitada');
        }
    }

    public function authorize(string $class, string $method, array $user)
    {
        $permission = $this->methodPermissions[$class][$method] ?? null;

        if ($permission === null) {
            return true;
        }

        $role = $user['role'] ?? $user['TYPE'] ?? null;

        if ($role === null) {
            throw new Exception('Rol del usuario no disponible para validar autorización');
        }

        $allowedPermissions = $this->rolePermissions[$role] ?? [];

        if (in_array('*', $allowedPermissions, true) || in_array($permission, $allowedPermissions, true)) {
            return true;
        }

        throw new Exception('Operación no permitida para el rol actual');
    }
}
