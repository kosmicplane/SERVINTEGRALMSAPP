<?php
require_once __DIR__ . '/../src/Database/Migrator.php';

$dsn = getenv('DB_DSN') ?: 'sqlite:' . __DIR__ . '/app.db';
$user = getenv('DB_USER') ?: null;
$pass = getenv('DB_PASS') ?: null;

$pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$migrator = new Migrator($pdo, __DIR__ . '/migrations');
$migrator->migrate();

echo "Migraciones aplicadas en {$dsn}\n";
