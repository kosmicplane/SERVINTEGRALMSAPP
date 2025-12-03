-- Inventario, requisiciones, órdenes de compra, cotizaciones, proveedores y vínculos con OT
CREATE TABLE IF NOT EXISTS suppliers (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    contact TEXT,
    email TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Catálogo de inventario real
CREATE TABLE IF NOT EXISTS inve (
    CODE TEXT PRIMARY KEY,
    DESCRIPTION TEXT NOT NULL,
    COST REAL NOT NULL DEFAULT 0,
    MARGIN REAL NOT NULL DEFAULT 0,
    AMOUNT REAL NOT NULL DEFAULT 0,
    STATUS INTEGER NOT NULL DEFAULT 1,
    UTILITY_PCT REAL NOT NULL DEFAULT 0,
    REAL_AMOUNT REAL NOT NULL DEFAULT 0,
    PHYSICAL_COUNT REAL NOT NULL DEFAULT 0,
    VARIANCE REAL NOT NULL DEFAULT 0
);

-- Movimientos de inventario (entradas/salidas)
CREATE TABLE IF NOT EXISTS inve_movimientos (
    ID INTEGER PRIMARY KEY AUTOINCREMENT,
    ITEM_CODE TEXT NOT NULL,
    TIPO_MOVIMIENTO TEXT NOT NULL,
    SUB_TIPO TEXT NOT NULL,
    CANTIDAD REAL NOT NULL DEFAULT 0,
    COSTO_UNITARIO REAL NOT NULL DEFAULT 0,
    COSTO_TOTAL REAL NOT NULL DEFAULT 0,
    FECHA_HORA TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ID_USUARIO TEXT DEFAULT NULL,
    ID_OT TEXT DEFAULT NULL,
    ID_OC TEXT DEFAULT NULL,
    OBSERVACIONES TEXT,
    FOREIGN KEY (ITEM_CODE) REFERENCES inve(CODE)
);

CREATE INDEX IF NOT EXISTS idx_item_fecha ON inve_movimientos (ITEM_CODE, FECHA_HORA);
CREATE INDEX IF NOT EXISTS idx_ot ON inve_movimientos (ID_OT);
CREATE INDEX IF NOT EXISTS idx_oc ON inve_movimientos (ID_OC);

CREATE TABLE IF NOT EXISTS quotations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    supplier_id INTEGER NOT NULL,
    status TEXT NOT NULL,
    total REAL NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    approved_at TEXT,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
);

CREATE TABLE IF NOT EXISTS quotation_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quotation_id INTEGER NOT NULL,
    item_code TEXT NOT NULL,
    quantity REAL NOT NULL,
    unit_price REAL NOT NULL,
    FOREIGN KEY (quotation_id) REFERENCES quotations(id),
    FOREIGN KEY (item_code) REFERENCES inve(CODE)
);

CREATE TABLE IF NOT EXISTS work_orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    quotation_id INTEGER,
    status TEXT NOT NULL,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (quotation_id) REFERENCES quotations(id)
);

CREATE TABLE IF NOT EXISTS requisitions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    type TEXT NOT NULL CHECK(type IN ('warehouse','purchasing')),
    status TEXT NOT NULL,
    work_order_id INTEGER,
    requested_by TEXT,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (work_order_id) REFERENCES work_orders(id)
);

CREATE TABLE IF NOT EXISTS requisition_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    requisition_id INTEGER NOT NULL,
    item_code TEXT NOT NULL,
    quantity REAL NOT NULL,
    expected_unit_cost REAL,
    FOREIGN KEY (requisition_id) REFERENCES requisitions(id),
    FOREIGN KEY (item_code) REFERENCES inve(CODE)
);

CREATE TABLE IF NOT EXISTS purchase_orders (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    supplier_id INTEGER NOT NULL,
    requisition_id INTEGER,
    status TEXT NOT NULL,
    total_cost REAL NOT NULL DEFAULT 0,
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id),
    FOREIGN KEY (requisition_id) REFERENCES requisitions(id)
);

CREATE TABLE IF NOT EXISTS purchase_order_items (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    purchase_order_id INTEGER NOT NULL,
    item_code TEXT NOT NULL,
    quantity REAL NOT NULL,
    unit_cost REAL NOT NULL,
    FOREIGN KEY (purchase_order_id) REFERENCES purchase_orders(id),
    FOREIGN KEY (item_code) REFERENCES inve(CODE)
);

CREATE TABLE IF NOT EXISTS role_permissions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    role TEXT NOT NULL,
    action TEXT NOT NULL,
    allowed INTEGER NOT NULL DEFAULT 0,
    UNIQUE(role, action)
);
