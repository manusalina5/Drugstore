<?php
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();

// include_once 'Model/Personas/Proveedor/proveedor.php';
// $proveedores = Proveedor::obtenerProveedores();

?>
<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="container">
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="progress mb-4" style="height: 25px">
                    <div class="progress-bar progress-bar-animated progress-bar-striped bg-success" role="progressbar"
                        aria-valuenow="33.3" aria-valuemax="100" aria-valuemin="0" style="width: 33.3%">
                        33%
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="etapa-1">
        <!-- Tarjeta de Proveedor -->
        <div class="card mb-4">
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
                    <input type="text" class="form-control" id="proveedorId" placeholder="Id del proveedor">
                </div>
                <button type="button" class="btn btn-secondary mt-2" data-bs-toggle="modal"
                    data-bs-target="#modalAgregarProveedor">Agregar Proveedor</button>

                <!-- Modal - Alta de Proveedores -->
                <?php require('View/Paginas/Personas/Proveedor/form.alta_proveedor.php'); ?>
            </div>
        </div>
    </div>
    <div class="etapa-2">
        <div class="d-flex flex-column gap-3 mb-2">
            <!-- Contenedor Principal -->

            <!-- Tarjeta del Carrito de Compras -->
            
        </div>
    </div>

    <div class="etapa-3">
        <!-- Tarjeta de Método de Pago -->
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
    </div>
</div>

</div>
<script src="Assets/js/Validaciones/compras.js"></script>
<script src="Assets/js/Buscadores/buscar_proveedorcompra.js"></script>
<script src="Assets/js/Buscadores/buscar_productoscompra.js"></script>
<script src="Assets/js/Validaciones/carrito_compras.js"></script>