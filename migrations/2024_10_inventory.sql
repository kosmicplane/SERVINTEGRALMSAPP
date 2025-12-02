-- Inventory module schema for items and movements
CREATE TABLE IF NOT EXISTS movement_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(120) NOT NULL,
    direction ENUM('entry','exit') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(40) NOT NULL UNIQUE,
    description VARCHAR(255) NOT NULL,
    avg_cost DECIMAL(14,4) NOT NULL DEFAULT 0,
    stock DECIMAL(14,4) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS movements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    movement_type_id INT NOT NULL,
    quantity DECIMAL(14,4) NOT NULL,
    unit_cost DECIMAL(14,4) NOT NULL DEFAULT 0,
    total_cost DECIMAL(14,4) NOT NULL DEFAULT 0,
    notes TEXT,
    created_by VARCHAR(120) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES items(id),
    FOREIGN KEY (movement_type_id) REFERENCES movement_types(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS cost_adjustments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    previous_cost DECIMAL(14,4) NOT NULL DEFAULT 0,
    new_cost DECIMAL(14,4) NOT NULL DEFAULT 0,
    reason TEXT,
    created_by VARCHAR(120) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES items(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO movement_types (code, name, direction)
VALUES
    ('ING_STOCK', 'Entrada a stock', 'entry'),
    ('ING_RECUP', 'Entrada por recuperados', 'entry'),
    ('ING_OC', 'Entrada por orden de compra', 'entry'),
    ('SAL_RQ', 'Salida requisición almacén', 'exit'),
    ('AJUSTE', 'Ajuste de inventario', 'exit')
ON DUPLICATE KEY UPDATE name = VALUES(name), direction = VALUES(direction);
