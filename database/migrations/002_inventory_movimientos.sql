-- Ajustes para módulo de inventario con movimientos y costo promedio

-- Depurar tablas duplicadas que quedaron del esquema anterior
DROP TABLE IF EXISTS inventory_items;
DROP TABLE IF EXISTS inventory_movements;

-- Sincronizar existencias reales con saldo operativo inicial
UPDATE inve SET REAL_AMOUNT = AMOUNT WHERE REAL_AMOUNT = 0;

-- Asegurar índices para consultas de seguimiento
CREATE INDEX IF NOT EXISTS idx_item_fecha ON inve_movimientos (ITEM_CODE, FECHA_HORA);
CREATE INDEX IF NOT EXISTS idx_ot ON inve_movimientos (ID_OT);
CREATE INDEX IF NOT EXISTS idx_oc ON inve_movimientos (ID_OC);
