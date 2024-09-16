<div class="container mt-4">
        <!-- Encabezado -->
        <h2 class="text-center">Gestión de Compras</h2>

        <!-- Formulario para agregar compras -->
        <div class="card my-4">
            <div class="card-header">
                <h4>Registrar Nueva Compra</h4>
            </div>
            <div class="card-body">
                <form id="form-compras">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="Nombre del proveedor" required>
                        </div>
                        <div class="col-md-4">
                            <label for="producto" class="form-label">Producto</label>
                            <input type="text" class="form-control" id="producto" name="producto" placeholder="Nombre del producto" required>
                        </div>
                        <div class="col-md-4">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="precio" class="form-label">Precio Unitario</label>
                            <input type="number" step="0.01" class="form-control" id="precio" name="precio" placeholder="Precio Unitario" required>
                        </div>
                        <div class="col-md-4">
                            <label for="fecha" class="form-label">Fecha de Compra</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Registrar Compra</button>
                </form>
            </div>
        </div>

        <!-- Tabla de compras -->
        <div class="card">
            <div class="card-header">
                <h4>Listado de Compras</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Proveedor</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                            <th>Fecha de Compra</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Ejemplo de una fila (se puede llenar dinámicamente con PHP o JavaScript) -->
                        <tr>
                            <td>1</td>
                            <td>Proveedor XYZ</td>
                            <td>Producto ABC</td>
                            <td>100</td>
                            <td>$10.00</td>
                            <td>$1000.00</td>
                            <td>2024-09-14</td>
                            <td>
                                <button class="btn btn-warning btn-sm">Editar</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>