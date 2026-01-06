<?php
// Script de diagnóstico manual para roles y endpoints protegidos.
// Configuración: exportar DIAG_BASE_URL y un JSON en DIAG_CREDENTIALS con las credenciales.
// Ejemplo de DIAG_CREDENTIALS:
// {
//   "A": {"email": "admin@example.com", "password": "secret"},
//   "CO": {"email": "coordinador@example.com", "password": "secret"},
//   "JZ": {"email": "jefe@example.com", "password": "secret"}
// }

$baseUrl = getenv('DIAG_BASE_URL') ?: 'http://localhost/libs/php/mentry.php';
$credentialsJson = getenv('DIAG_CREDENTIALS') ?: '{}';
$credentials = json_decode($credentialsJson, true) ?: [];

$roleProbes = [
    'A' => [
        ['class' => 'inventory', 'method' => 'listItems', 'data' => []],
        ['class' => 'purchases', 'method' => 'listPurchaseOrders', 'data' => []],
    ],
    'CO' => [
        ['class' => 'inventory', 'method' => 'listMovements', 'data' => []],
        ['class' => 'purchases', 'method' => 'listSuppliers', 'data' => []],
    ],
    'JZ' => [
        ['class' => 'inventory', 'method' => 'exportInventory', 'data' => []],
        ['class' => 'users', 'method' => 'getLeg', 'data' => ['legCode' => 'TEST']],
    ],
    'T' => [
        ['class' => 'users', 'method' => 'getUserLegs', 'data' => []],
        ['class' => 'inventory', 'method' => 'listItems', 'data' => []],
    ],
    'C' => [
        ['class' => 'inventory', 'method' => 'listItems', 'data' => []],
    ],
];

function postJson(string $url, array $payload, string $cookieFile): array
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => ['info' => json_encode($payload)],
        CURLOPT_COOKIEJAR => $cookieFile,
        CURLOPT_COOKIEFILE => $cookieFile,
    ]);

    $raw = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);

    if ($raw === false) {
        return ['status' => false, 'message' => 'cURL error: ' . $error];
    }

    $decoded = json_decode($raw, true);
    if (!is_array($decoded)) {
        return ['status' => false, 'message' => 'Respuesta inválida: ' . $raw];
    }

    return $decoded;
}

function loginRole(string $role, array $credential, string $baseUrl, string $cookieFile): array
{
    if (empty($credential['email']) || empty($credential['password'])) {
        return ['status' => false, 'message' => 'Faltan credenciales'];
    }

    $payload = [
        'class' => 'users',
        'method' => 'login',
        'data' => [
            'autor' => $credential['email'],
            'pssw' => $credential['password'],
            'type' => $role,
        ],
    ];

    return postJson($baseUrl, $payload, $cookieFile);
}

function runProbesForRole(string $role, array $probes, array $credential, string $baseUrl): void
{
    $cookieFile = tempnam(sys_get_temp_dir(), 'diag_cookie_');
    $login = loginRole($role, $credential, $baseUrl, $cookieFile);
    if (empty($login['status'])) {
        echo "[FAIL] Login falló para rol {$role}: {$login['message']}\n";
        @unlink($cookieFile);
        return;
    }

    echo "[OK] Login exitoso para rol {$role}\n";

    foreach ($probes as $probe) {
        $payload = [
            'class' => $probe['class'],
            'method' => $probe['method'],
            'data' => $probe['data'],
        ];
        $response = postJson($baseUrl, $payload, $cookieFile);
        $statusText = !empty($response['exception']) ? 'error: ' . $response['exception'] : 'ok';
        echo "    - {$probe['class']}::{$probe['method']} => {$statusText}\n";
    }

    @unlink($cookieFile);
}

echo "Usando endpoint base: {$baseUrl}\n";
foreach ($roleProbes as $role => $probes) {
    $credential = $credentials[$role] ?? [];
    runProbesForRole($role, $probes, $credential, $baseUrl);
}
