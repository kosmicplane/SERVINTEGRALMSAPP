-- Ajustes para módulo de inventario con movimientos y costo promedio

-- 1. Ajustar tabla principal de inventario existente `inve`
CREATE TABLE IF NOT EXISTS inve (
    CODE VARCHAR(64) PRIMARY KEY,
    DESCRIPTION VARCHAR(255) NOT NULL,
    COST DECIMAL(18,4) NOT NULL DEFAULT 0,
    MARGIN DECIMAL(10,2) NOT NULL DEFAULT 0,
    AMOUNT DECIMAL(18,4) NOT NULL DEFAULT 0,
    STATUS TINYINT(1) NOT NULL DEFAULT 1
);

ALTER TABLE inve ADD COLUMN UTILITY_PCT DECIMAL(10,2) NOT NULL DEFAULT 0;
ALTER TABLE inve ADD COLUMN REAL_AMOUNT DECIMAL(18,4) NOT NULL DEFAULT 0;
ALTER TABLE inve ADD COLUMN PHYSICAL_COUNT DECIMAL(18,4) NOT NULL DEFAULT 0;
ALTER TABLE inve ADD COLUMN VARIANCE DECIMAL(18,4) NOT NULL DEFAULT 0;

-- 2. Crear tabla de movimientos de inventario
CREATE TABLE IF NOT EXISTS inve_movimientos (
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    ITEM_CODE VARCHAR(64) NOT NULL,
    TIPO_MOVIMIENTO TEXT NOT NULL,
    SUB_TIPO TEXT NOT NULL,
    CANTIDAD DECIMAL(18,4) NOT NULL DEFAULT 0,
    COSTO_UNITARIO DECIMAL(18,4) NOT NULL DEFAULT 0,
    COSTO_TOTAL DECIMAL(18,4) NOT NULL DEFAULT 0,
    FECHA_HORA DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ID_USUARIO VARCHAR(64) DEFAULT NULL,
    ID_OT VARCHAR(64) DEFAULT NULL,
    ID_OC VARCHAR(64) DEFAULT NULL,
    OBSERVACIONES TEXT
);

CREATE INDEX IF NOT EXISTS idx_item_fecha ON inve_movimientos (ITEM_CODE, FECHA_HORA);
CREATE INDEX IF NOT EXISTS idx_ot ON inve_movimientos (ID_OT);
CREATE INDEX IF NOT EXISTS idx_oc ON inve_movimientos (ID_OC);

-- 3. Sincronización de existencias
-- Regla: cada inserción en `inve_movimientos` debe ajustar `inve.AMOUNT` (existencia operativa) y `inve.REAL_AMOUNT`.
-- ENTRADA: sumar cantidades; SALIDA: restar cantidades.
-- El costo promedio se mantiene en `inve.COST` y se recalcula en cada ENTRADA usando el costo ingresado.

-- 4. Campos de conteo físico
-- `REAL_AMOUNT` conserva la existencia operativa calculada por movimientos.
-- `PHYSICAL_COUNT` permitirá registrar conteos físicos manuales.
-- `VARIANCE` guarda la diferencia entre REAL_AMOUNT y PHYSICAL_COUNT cuando se realicen conciliaciones.
