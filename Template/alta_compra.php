<?php
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();

// include_once 'Model/Personas/Proveedor/proveedor.php';
// $proveedores = Proveedor::obtenerProveedores();

?>
<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="container">
    <h1 class="text-left h2">COMPRAS</h1>
    <div class="d-flex flex-column gap-3 mb-2"> <!-- Contenedor principal -->


        <div class="row mb-6">
            <!-- Tarjeta del Carrito de Compras (Columna aislada) -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Carrito de Compras</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-sm text-sm">
                            <thead>
                                <tr>
                                    <th class="py-1 px-1">Producto</th>
                                    <th class="py-1 px-1">Cantidad</th>
                                    <th class="py-1 px-1">Precio Unitario</th>
                                    <th class="py-1 px-1">Nuevo Precio</th>
                                    <th class="py-1 px-1">Subtotal</th>
                                    <th class="py-1 px-1"></th>
                                </tr>
                            </thead>
                            <tbody id="carrito"></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end py-1 px-1">Total</th>
                                    <th id="totalCarrito" class="py-1 px-1">$0.00</th>
                                    <th class="py-1 px-1"></th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>

            <!-- Tarjeta de Agregar Producto-->
            <div class="col-md-6">
                <div class="row mb-4">
                    <!-- Tarjeta de Agregar Producto -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Agregar Producto</h4>
                            </div>
                            <div class="card-body">
                                <form id="formAgregarProducto">
                                    <div class="mb-3">
                                        <label for="buscarProducto" class="form-label">Buscar Producto</label>
                                        <input type="text" class="form-control" id="buscarProducto"
                                            placeholder="Nombre o código del producto">
                                        <div id="listaProductos" class="list-group mt-2"></div>
                                    </div>
                                    <input type="hidden" id="idProducto" name="">

                                    <!-- Código de barras y cantidad -->
                                    <div class="mb-3">
                                        <div class="row g-3">
                                            <div class="col-sm">
                                                <label for="precio" class="form-label">Precio Unitario</label>
                                                <input type="number" class="form-control" id="precio"
                                                    placeholder="$0.00" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="precioNuevo" class="form-label">Precio Nuevo</label>
                                                <input type="text" id="precioNuevo" class="form-control"
                                                    placeholder="Precio nuevo">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="codBarras" class="form-label">Código de Barras</label>
                                                <input type="text" id="codBarras" class="form-control"
                                                    placeholder="Código de barras">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cantidad -->
                                    <div class="mb-3">
                                        <div class="row g-3">
                                            <div class="col-sm">
                                                <label for="cantidad" class="form-label">Cantidad</label>
                                                <input type="number" class="form-control" id="cantidad" value="1">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="stock" class="form-label">Stock</label>
                                                <input type="text" id="stock" class="form-control alert-success">
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="nivel_stock" class="form-label" id="stocklabel">Estado
                                                    Stock</label>
                                                <input type="text" id="nivel_stock" class="form-control" title=""
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Agregar al carrito -->
                                    <div class="mb-6">
                                        <button type="button" class="btn btn-primary" id="btnAgregarProducto">Agregar al
                                            carrito</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tarjetas de Proveedor y Métodos de Pago -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Proveedor</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="buscarProveedor"
                                        placeholder="Ingresar nombre del proveedor">
                                    <div id="listaProveedores" class="list-group mt-2"></div>
                                </div>
                                <div class="mb-2">
                                    <input type="text" class="form-control" id="proveedorId"
                                        placeholder="Id del proveedor">
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#modalAgregarProveedor">Agregar Proveedor</button>

                                <!-- Modal - Alta de proveedores -->
                                <?php require('View/Paginas/Personas/Proveedor/form.alta_proveedor.php'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Método de Pago</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <select class="form-select" id="metodoPago">
                                        <?php
                                        foreach ($metodosDePagos as $metodopago) {
                                            $id = $metodopago['idmetodoPago'];
                                            $nombre = $metodopago['nombre'];
                                            echo "<option value='$id'>$nombre</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción en una sola fila -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex gap-2 justify-content-end">
                            <button class="btn btn-success" id="btnConfirmarCompra">Confirmar Compra</button>
                            <button class="btn btn-danger" id="btnCancelarCompra">Cancelar Compra</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <script src="Assets/js/Validaciones/compras.js"></script>
    <script src="Assets/js/Buscadores/buscar_proveedorcompra.js"></script>
    <script src="Assets/js/Buscadores/buscar_productoscompra.js"></script>
    <script src="Assets/js/Validaciones/carrito_compras.js"></script>