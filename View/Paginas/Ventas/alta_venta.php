<?php
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();

// include_once 'Model/Personas/Cliente/cliente.php';
// $clientes = Cliente::obtenerClientes();

?>
<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="container">
    <h1 class="text-left h2">VENTAS</h1>
    <div class="d-flex flex-column gap-3 mb-2"> <!-- Contenedor principal -->

        <!-- Información de la Caja en una sola fila -->
        <div class="d-flex justify-content-between align-items-center bg-light p-3 border rounded"> <!-- Contenedor para la información -->
            <div class="d-flex gap-4"> <!-- Contenedor para la información de la caja -->
                <p class="mb-0"><strong>Saldo Inicial:</strong> $<span id="saldoInicial">0.00</span></p>
                <p class="mb-0"><strong>Ventas del Día:</strong> $<span id="ventasDia">0.00</span></p>
                <p class="mb-0"><strong>Saldo Final:</strong> $<span id="saldoFinal">0.00</span></p>
                <p class="mb-0"><strong>Estado Caja: <span id="estadoCaja"></span></strong> </p>
            </div>
            <div class="d-flex gap-2"> <!-- Contenedor para los botones -->
                <button id="btnAbrirCaja" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAbrirCaja">Abrir Caja</button>
                <button id="btnModalCerrarCaja" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCerrarCaja">Cerrar Caja</button>
            </div>
        </div>
    </div>

    <!-- Modal Abrir Caja-->
    <div class="modal fade" id="modalAbrirCaja" tabindex="-1" aria-labelledby="modalAbrirCaja" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAbrirCajaLabel">Abrir Caja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModalAbrirCaja" action="Controller/Caja/caja.controlador.php?action=abrircaja" method="POST">
                        <div class="mb-3">
                            <label for="montoInicial" class="form-label">Monto Inicial</label>
                            <input type="number" class="form-control" id="montoInicial" name="montoInicial" placeholder="Ingrese el monto inicial" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="btnModalAbrirCaja">Abrir Caja</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cerrar Caja-->
    <div class="modal fade" id="modalCerrarCaja" tabindex="-1" aria-labelledby="modalCerrarCaja" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalCerrarCajaLabel">Abrir Caja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModalCerrarCaja" action="Controller/Caja/caja.controlador.php?action=cerrarcaja" method="POST">
                        <div class="mb-3">
                            <label for="montoFinal" class="form-label">Monto Final</label>
                            <input type="number" class="form-control" id="montoFinal" name="montoFinal" placeholder="Ingrese el monto final" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="btnModalAbrirCaja">Abrir Caja</button>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-6">
        <!-- Tarjeta del Carrito (Columna aislada) -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Carrito de Compras</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="carrito"></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th id="totalCarrito">$0.00</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tarjeta de Agregar Producto y Métodos de Pago (Columna combinada) -->
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
                                    <input type="text" class="form-control" id="buscarProducto" placeholder="Nombre o código del producto">
                                    <div id="listaProductos" class="list-group mt-2"></div>
                                </div>
                                <input type="hidden" id="idProducto" name="">

                                <!-- Código de barras y cantidad -->
                                <div class="mb-3">
                                    <div class="row g-3">
                                        <div class="col-sm">
                                            <label for="precio" class="form-label">Precio Unitario</label>
                                            <input type="number" class="form-control" id="precio" placeholder="$0.00" readonly>
                                        </div>
                                        <div class="col-sm-8">
                                            <label for="codBarras" class="form-label">Código de Barras</label>
                                            <input type="text" id="codBarras" class="form-control" placeholder="Código de barras">
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
                                            <label for="nivel_stock" class="form-label" id="stocklabel">Estado Stock</label>
                                            <input type="text" id="nivel_stock" class="form-control" title="" disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- Agregar al carrito -->
                                <div class="mb-6">
                                    <button type="button" class="btn btn-primary" id="btnAgregarProducto">Agregar al carrito</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de Cliente y Métodos de Pago -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Cliente</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-2">
                                <input type="text" class="form-control" id="buscarCliente" placeholder="Ingresar nombre del cliente">
                                <div id="listaClientes" class="list-group mt-2"></div>
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="clienteId" placeholder="Id del cliente">
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">Agregar Cliente</button>

                            <!-- Modal - Alta de clientes-->
                            <?php require('View/Paginas/Personas/Cliente/form.alta_cliente.php'); ?>
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
                        <button class="btn btn-success" id="btnConfirmarVenta">Confirmar Venta</button>
                        <button class="btn btn-danger" id="btnCancelarVenta">Cancelar Venta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<script src="Assets/js/Validaciones/ventas.js"></script>
<script src="Assets/js/Validaciones/alta_clientes_ventas.js"></script>
<script src="Assets/js/Buscadores/buscar_clienteventa.js"></script>
<script src="Assets/js/Buscadores/buscar_productosventa.js"></script>
<script src="Assets/js/Validaciones/carrito_ventas.js"></script>
<script src="Assets/js/Funciones/caja.ventas.js"></script>