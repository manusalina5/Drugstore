<?php
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();

// include_once 'Model/Personas/Proveedor/proveedor.php';
// $proveedores = Proveedor::obtenerProveedores();

?>
<link rel="stylesheet" href="Assets/css/validaciones.css">

<h1>REGISTRAR COMPRA</h1>
<!-- Barra de progreso -->
<div class="row mt-3">
    <div class="col">
        <div class="progress mb-4" style="height: 25px">
            <div id="progress-bar" class="progress-bar progress-bar-animated progress-bar-striped bg-success"
                role="progressbar" aria-valuenow="0" aria-valuemax="100" aria-valuemin="0" style="width: 0%">
                0%
            </div>
        </div>
    </div>
</div>

<!-- Etapa 1: Proveedor -->
<div class="step-content etapa-1 active">
    <!-- Contenido de la etapa 1 -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Proveedor</h4>
        </div>
        <div class="card-body">
            <div class="mb-2">
                <input type="text" class="form-control" id="buscarProveedor"
                    placeholder="Tipee para buscar un proveedor">
                <div id="listaProveedores" class="list-group mt-2"></div>
            </div>
            <div class="mb-2">
                <input type="hidden" class="form-control" id="proveedorId" placeholder="Id del proveedor">
            </div>
            <button type="button" id="botonAgregarProveedor" class="btn btn-success mt-2" data-bs-toggle="modal"
            data-bs-target="#modalAgregarProveedor" style="display: none;">Agregar Proveedor</button>

            <!-- Modal - Alta de Proveedores -->
            <?php require('View/Paginas/Personas/Proveedor/form.alta_proveedor.php'); ?>

        </div>
    </div>
    <button onclick="nextStep()" class="btn btn-primary">Siguiente</button>
</div>

<!-- Etapa 2: Carrito de Compras -->
<div class="step-content etapa-2">
    <!-- Contenido de la etapa 2 -->
    <div class="d-flex flex-column gap-3 mb-2">
        <div class="row mb-6">
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

            <!-- Tarjeta de Agregar Producto -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Agregar Producto</h4>
                    </div>
                    <div class="card-body">
                        <form id="formAgregarProducto">
                            <!-- Buscar Producto -->
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="buscarProducto" class="form-label">Buscar Producto</label>
                                    <input type="text" class="form-control" id="buscarProducto"
                                        placeholder="Nombre o código del producto">
                                    <div id="listaProductos" class="list-group mt-2"></div>
                                </div>
                                <div class="col-sm-6">
                                    <label for="codBarras" class="form-label">Código de Barras</label>
                                    <input type="text" id="codBarras" class="form-control"
                                        placeholder="Código de barras">
                                </div>
                            </div>

                            <input type="hidden" id="idProducto" name="">

                            <!-- Precio Unitario, Precio Nuevo y Código de Barras -->
                            <div class="row g-6 mb-3">
                                <div class="col-sm-6">
                                    <label for="precio" class="form-label">Precio Unitario</label>
                                    <input type="number" class="form-control" id="precio" placeholder="$0.00" readonly>
                                </div>
                                <div class="col-sm-6">
                                    <label for="precioNuevo" class="form-label">Precio Nuevo</label>
                                    <input type="text" id="precioNuevo" class="form-control" placeholder="Precio nuevo">
                                </div>
                            </div>

                            <!-- Cantidad, Stock y Estado Stock -->
                            <div class="row g-3 mb-3">
                                <div class="col-sm">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantidad" value="1">
                                </div>
                                <div class="col-sm-4">
                                    <label for="stock" class="form-label" >Stock</label>
                                    <input type="text" id="stock" class="form-control alert-success" disabled>
                                </div>
                                <div class="col-sm-4">
                                    <label for="nivel_stock" class="form-label">Estado Stock</label>
                                    <input type="text" id="nivel_stock" class="form-control" disabled>
                                </div>
                            </div>

                            <!-- Botón Agregar al Carrito -->
                            <button type="button" class="btn btn-primary" id="btnAgregarProducto">Agregar al
                                carrito</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button onclick="prevStep()" class="btn btn-secondary">Anterior</button>
    <button onclick="nextStep()" class="btn btn-primary">Siguiente</button>
</div>

<!-- Etapa 3: Método de Pago -->
<div class="step-content etapa-3">
    <!-- Contenido de la etapa 3 -->
    <div class="card mb-4">
        <div class="card-header">
            <h4>Método de Pago</h4>
        </div>
        <div class="card-body">
            <select class="form-select" id="metodoPago">
                <?php foreach ($metodosDePagos as $metodopago) {
                    $id = $metodopago['idmetodoPago'];
                    $nombre = $metodopago['nombre'];
                    echo "<option value='$id'>$nombre</option>";
                } ?>
            </select>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="d-flex gap-2 justify-content-end">
        <button class="btn btn-success" id="btnConfirmarCompra">Confirmar Compra</button>
        <button class="btn btn-danger" id="btnCancelarCompra">Cancelar Compra</button>
    </div>
    <button onclick="prevStep()" class="btn btn-secondary">Anterior</button>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="modalConfirmarCompra" tabindex="-1" aria-labelledby="modalConfirmarCompraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConfirmarCompraLabel">Confirmar Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas confirmar esta compra?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="confirmarCompraBtn">Confirmar</button>
            </div>
        </div>
    </div>
</div>




</div>
<script src="Assets/js/Validaciones/compras.js"></script>
<script src="Assets/js/Buscadores/buscar_proveedorcompra.js"></script>
<script src="Assets/js/Buscadores/buscar_productoscompra.js"></script>
<script src="Assets/js/Validaciones/carrito_compras.js"></script>