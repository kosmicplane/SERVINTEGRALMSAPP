# SERVINTEGRALMSAPP

Aplicación PHP sin framework para gestión de clientes, órdenes y operaciones de inventario. El backend se despacha por `libs/php/mentry.php` y las vistas principales están en `index.html` con Bootstrap + jQuery.

## Estructura de carpetas
- `index.html` / `js/` / `css/`: UI principal y scripts (incluye `main.js` con la lógica de formularios y AJAX).
- `libs/php/`: Clases del backend. Destacan:
  - `mentry.php`: dispatcher genérico que recibe `class` y `method` y resuelve autorización.
  - `authorization.php` y `permissions.php`: control de roles/permisos.
  - `users.php`: operaciones legadas de catálogo y órdenes.
  - `inventory.php`: módulo de inventario con movimientos, costo promedio y validaciones.
  - `purchases.php`: esqueleto para proveedores/OC.
- `database/migrations/`: scripts SQL manuales (`001_core_schema.sql`, `002_inventory_movimientos.sql`).
- `tests/`: scripts de prueba simple (`run.php`).
- `irsc/`, `bs/`, `css/`, `lang/`: recursos estáticos, traducciones y assets.

## Migraciones SQL relevantes
El archivo `database/migrations/002_inventory_movimientos.sql` documenta los ALTER/CREATE necesarios para el módulo de inventario (columnas de utilidad, conteo físico y tabla `inve_movimientos`).

## Flujos clave
- **Crear ítem de inventario:** En "Administrar Inventario" diligenciar código, descripción, costo y margen, luego "Crear" (requiere rol administrador/logística). Se guarda en `inventory::saveItem`.
- **Entrada de stock (stock/recuperado/OC):** Sección "Entrada de inventario" seleccionando ítem, tipo, cantidad y costo. Envía a `inventory::registerEntry`, crea movimiento y recalcula costo promedio.
- **Salida por RQ de almacén:** Sección "Salida de inventario" con tipo "RQ Almacén", cantidad e OT asociada. Usa `inventory::registerExit` y descuenta existencias validando saldo.
- **Salida por ajuste:** Mismo formulario pero tipo "Ajuste" (solo administrador). Valida stock y registra movimiento.
- **Listado de movimientos:** En "Movimientos de inventario" filtrar por ítem, tipo, rango de fechas u OT y presionar "Buscar". Los datos provienen de `inventory::listMovements`.
- **Integridad de existencias:** Cada ENTRADA suma `inve.AMOUNT`/`REAL_AMOUNT` y recalcula costo promedio; cada SALIDA resta asegurando no quedar negativo.

## Guías rápidas de operación
- **RQ a almacén (consumo interno):** Registrar salida con tipo "RQ Almacén" asociando la OT correspondiente para dejar el vínculo listo para costeo interno.
- **RQ por compras y OC:** El módulo `libs/php/purchases.php` contiene los esbozos para convertir RQ de compras en OC. El campo `id_oc` en `inventory::registerEntry` permite asociar la entrada con la OC cuando se reciba la mercancía.
- **Entradas/salidas de almacén:** Usar los formularios dedicados en la sección de inventario; cada movimiento queda en `inve_movimientos` y afecta `inve.AMOUNT`.
- **Generación de cotización, aprobación y OT:** El flujo de referencia se encuentra en `tests/run.php` y `database/migrations/001_core_schema.sql` (cotizaciones, aprobación y creación de OT enlazadas).
- **Exportación de inventario:** La lógica de exportación de referencia está en `tests/run.php`; el costo promedio actualizado en `inve.COST` es la base para cualquier exportación o costo interno.

## Seguridad y roles
- Roles se resuelven desde sesión y `permissions.php`. Sólo `A` (administrador) y `CO` (logística) pueden crear ítems y registrar movimientos; ajustes restrictivos validados en backend (`inventory::requireRole`).
- Frontend aplica guardas via `js/permissions.js` deshabilitando controles sin permisos.

## Uso del dispatcher
Todos los formularios hacen AJAX a `libs/php/mentry.php` con `{class, method, data}`. Ejemplos:
- `class: "inventory", method: "saveItem"` para crear/editar ítems.
- `class: "inventory", method: "registerEntry"` para entradas.
- `class: "inventory", method: "registerExit"` para salidas.
- `class: "inventory", method: "listMovements"` para listados.

## Checklist funcional
- Inventario soporta costo promedio y movimientos entrada/salida vinculables a OT/OC.
- Validaciones de rol y stock previenen saldos negativos.
- UI incluye formularios separados para entradas, salidas y consulta de movimientos.
- Documentación de estructura y migraciones incluida en este README.
