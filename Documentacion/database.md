# Diseño de la Base de Datos

## Diagrama Entidad-Relación
![Diagrama ER](db-diagram.png)

## Tablas Principales
- **productos**:
  - `idProductos` (INT, PK, auto_increment)
  - `nombre` (VARCHAR, NOT NULL)
  - `codBarras` (VARCHAR, UNIQUE)
  - `cantidad` (INT, NOT NULL)
  - `precioVenta` (DECIMAL, NOT NULL)
  - `Marca_idMarca` (INT, FK)

- **ventas**:
  - `idVenta` (INT, PK, auto_increment)
  - `fecha` (DATE, NOT NULL)
  - `montoTotal` (DECIMAL, NOT NULL)
  - `usuario_id` (INT, FK)
  - `metodoPago` (VARCHAR)

## Consultas Comunes
- **Obtener el inventario actual**:
  ```sql
  SELECT nombre, cantidad, precioVenta FROM productos WHERE cantidad > 0;
  ```
- **Registrar una nueva venta**:
  ```sql
  INSERT INTO ventas (fecha, montoTotal, usuario_id, metodoPago)
  VALUES (CURDATE(), 1500.00, 1, 'Tarjeta de Crédito');
  ```
