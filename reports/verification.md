# Verificación de implementaciones previas

## Componentes nuevos encontrados
- Se agregó un migrador SQLite con versión única `001_core_schema.sql` que crea tablas de proveedores, ítems de inventario, cotizaciones, órdenes de trabajo, requisiciones, órdenes de compra, movimientos de inventario y permisos por rol. 【F:database/migrations/001_core_schema.sql†L1-L65】
- Existe un servicio PHP `InventorySystem` orientado a tests que gestiona cotizaciones→OT, requisiciones (almacén/compras), órdenes de compra, movimientos de inventario con costo promedio y exportación CSV sobre la base SQLite migrada. 【F:src/InventorySystem.php†L1-L201】【F:src/InventorySystem.php†L202-L304】
- Las pruebas `tests/run.php` usan el migrador en memoria y validan flujos básicos (cotización aprobada genera OT, requisición descuenta stock, OC recibe con costo promedio, exportación CSV y bloqueos por permisos). 【F:tests/run.php†L1-L112】【F:tests/run.php†L113-L206】
- En el backend heredado se añadieron clases `authorization.php` y `permissions.php` con un mapeo estático de permisos aplicados solo a métodos de la clase `users`. 【F:libs/php/authorization.php†L1-L49】【F:libs/php/permissions.php†L1-L46】
- Se incorporó una clase `quotes` y su UI `js/quotes.js` para crear/actualizar cotizaciones simples desde el frontend clásico mediante `mentry.php`. 【F:libs/php/quotes.php†L1-L178】【F:js/quotes.js†L1-L120】
- Se añadió `purchases.php` con creación dinámica de tablas para proveedores, OCs y movimientos de inventario al vuelo, pero fuera del esquema migrado. 【F:libs/php/purchases.php†L1-L189】

## Hallazgos y brechas
- El migrador y `InventorySystem` no están integrados al flujo principal (`mentry.php` sigue despachando clases legacy) ni a la base MySQL usada por la app; las migraciones son SQLite y solo consumidas por pruebas. 【F:src/InventorySystem.php†L7-L21】【F:tests/run.php†L4-L14】
- La autorización aplicada en `mentry.php` solo cubre métodos listados en `permissions.php` para la clase `users`; los nuevos endpoints de `quotes` y `purchases` quedan sin control de rol. 【F:libs/php/mentry.php†L23-L46】【F:libs/php/permissions.php†L18-L41】
- No hay migraciones ni modelos para entradas/salidas de inventario ligadas a OT en la base MySQL original; `purchases.php` crea tablas independientes en tiempo de ejecución y no registra costo promedio ni conteos físicos conforme a los requerimientos. 【F:libs/php/purchases.php†L1-L189】
- La UI legacy solo expone un módulo básico de cotizaciones; no se implementaron pantallas para requisiciones, órdenes de compra, entradas/salidas ni exportación de inventario vinculadas al backend real. 【F:js/quotes.js†L1-L120】
- Los tests automatizados se ejecutan sobre SQLite en memoria y no aseguran que el flujo esté disponible en la aplicación desplegada. 【F:tests/run.php†L1-L206】

## Conclusión
Las tareas reportadas como completadas se encuentran parcialmente en archivos nuevos orientados a pruebas y con lógica no integrada al stack productivo. La app principal (PHP clásico con MySQL) sigue careciendo de integración completa de inventario, RQ/OC, entradas/salidas, roles y permisos efectivos en los endpoints reales.
