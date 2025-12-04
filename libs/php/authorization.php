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
        $sessionCode = strtoupper((string)($sessionUser['code'] ?? ''));

        if (isset($requestData['autorCode']) && strtoupper((string)$requestData['autorCode']) !== $sessionCode) {
            throw new Exception('El usuario autenticado no coincide con la operación solicitada');
        }

        if (isset($requestData['ucode']) && strtoupper((string)$requestData['ucode']) !== $sessionCode) {
            throw new Exception('El usuario autenticado no coincide con la operación solicitada');
        }
    }

    public function authorize(string $class, string $method, array $user)
    {
        $permission = $this->methodPermissions[$class][$method] ?? null;

        if ($permission === null) {
            return true;
        }

        if (is_array($permission)) {
            foreach ($permission as $candidate) {
                if ($this->userHasPermission($candidate, $user, false)) {
                    return true;
                }
            }

            throw new Exception('Operación no permitida para el rol actual');
        }

        return $this->authorizePermission($permission, $user);
    }

    public function authorizePermission(string $permission, array $user)
    {
        if ($this->userHasPermission($permission, $user, true)) {
            return true;
        }

        throw new Exception('Operación no permitida para el rol actual');
    }

    public function userHasPermission(string $permission, array $user, bool $failIfMissingRole = false)
    {
        $role = $user['role'] ?? $user['TYPE'] ?? null;

        if ($role === null) {
            if ($failIfMissingRole) {
                throw new Exception('Rol del usuario no disponible para validar autorización');
            }
            return false;
        }

        $allowedPermissions = $this->rolePermissions[$role] ?? [];

        return in_array('*', $allowedPermissions, true) || in_array($permission, $allowedPermissions, true);
    }
}
