-- Auditoría de ajustes de costo y campos de conteo físico

-- Tabla de auditoría de costos
CREATE TABLE IF NOT EXISTS inve_cost_audit (
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    ITEM_CODE VARCHAR(64) NOT NULL,
    COSTO_ANTERIOR DECIMAL(18,4) NOT NULL,
    COSTO_NUEVO DECIMAL(18,4) NOT NULL,
    USUARIO VARCHAR(64) NOT NULL,
    OBSERVACIONES TEXT,
    FECHA DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE INDEX IF NOT EXISTS idx_inve_cost_item ON inve_cost_audit (ITEM_CODE);
CREATE INDEX IF NOT EXISTS idx_inve_cost_user ON inve_cost_audit (USUARIO);
