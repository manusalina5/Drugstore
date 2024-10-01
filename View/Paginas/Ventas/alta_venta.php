<?php
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();

include_once 'Model/Personas/Cliente/cliente.php';
$clientes = Cliente::obtenerClientes();

?>
<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="container my-4">
    <h2 class="text-center mb-4">VENTAS</h2>

    <div class="row mb-4">
        <!-- Tarjeta de Productos -->
        <div class="col-md-6">
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
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" value="1">
                        </div>
                        <div class="mb-3">
                            <label for="precio" class="form-label">Precio Unitario</label>
                            <input type="number" class="form-control" id="precio" placeholder="$0.00" readonly>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnAgregarProducto">Agregar al carrito</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tarjeta del Carrito -->
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
                        <select class="form-select" aria-label="Select Cliente" required name="idCliente" id="seleccionarCliente">
                            <option selected value="">Elija el cliente</option>
                            <?php
                            if (!empty($clientes)) {
                                foreach ($clientes as $cliente) {
                                    echo "<option value='{$cliente['idClientes']}'>{$cliente['nombre']} {$cliente['apellido']} - {$cliente['documento']} </option>";
                                }
                            }
                            ?>
                        </select>
        

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
                        <label for="metodoPago" class="form-label">Método de Pago</label>
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
                    <div class="mb-3">
                        <label for="descuento" class="form-label">Descuento (Opcional)</label>
                        <input type="number" class="form-control" id="descuento" placeholder="0%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de acción en una sola fila -->
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex gap-3">
                <button class="btn btn-success" id="btnConfirmarVenta">Confirmar Venta</button>
                <button class="btn btn-danger" id="btnCancelarVenta">Cancelar Venta</button>
            </div>
        </div>
    </div>
</div>



<script src="Assets/js/Validaciones/ventas.js"></script>
<script src="Assets/js/Validaciones/alta_clientes_ventas.js"></script>