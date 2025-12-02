<?php

class Migrator
{
    private \PDO $pdo;
    private string $migrationsPath;

    public function __construct(\PDO $pdo, string $migrationsPath)
    {
        $this->pdo = $pdo;
        $this->migrationsPath = rtrim($migrationsPath, '/');
        $this->ensureVersionTable();
    }

    private function ensureVersionTable(): void
    {
        $this->pdo->exec(
            'CREATE TABLE IF NOT EXISTS schema_versions (
                version TEXT PRIMARY KEY,
                applied_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
            )'
        );
    }

    private function appliedVersions(): array
    {
        $stmt = $this->pdo->query('SELECT version FROM schema_versions');
        $versions = $stmt ? $stmt->fetchAll(\PDO::FETCH_COLUMN) : [];
        return $versions ?: [];
    }

    public function migrate(): void
    {
        $applied = $this->appliedVersions();
        $files = glob($this->migrationsPath . '/*.sql');
        sort($files);

        foreach ($files as $file) {
            $version = basename($file, '.sql');
            if (in_array($version, $applied, true)) {
                continue;
            }

            $sql = file_get_contents($file);
            if ($sql === false) {
                throw new RuntimeException("No se pudo leer la migración {$file}");
            }

            $this->pdo->beginTransaction();
            try {
                $this->pdo->exec($sql);
                $insert = $this->pdo->prepare('INSERT INTO schema_versions(version) VALUES(:version)');
                $insert->execute([':version' => $version]);
                $this->pdo->commit();
            } catch (Throwable $e) {
                $this->pdo->rollBack();
                throw $e;
            }
        }
    }
}
