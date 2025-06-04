<?php
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();
?>
<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="">
    <h1 class="text-left h2">VENTAS</h1>
    <div class="d-flex flex-column gap-3 mb-2"> <!-- Contenedor principal -->

        <!--CAJA -->
        <?php include_once 'View/Paginas/Caja/ventas-caja.php'; ?>
        <!-- Fin de la sección de caja -->

        <!-- barra de progreso -->
        <div class="progress mb-2">
            <div id="barra-de-progreso" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 33%"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <div class="bg-light border rounded pb-3 pt-3">

            <!-- INICIO PASO 1 -->
            <div class="paso paso-1">
                <?php include_once 'View/Paginas/Ventas/venta-paso1.php'; ?>
            </div>
            <!-- FIN PASO 1 -->

            <!-- INICIO PASO 2 -->

            <div class="paso paso-2">
                <?php include_once 'View/Paginas/Ventas/venta-paso2.php'; ?>
            </div>


            <!-- FIN PASO 2-->

            <!-- INICIO PASO 3-->

            <div class="paso paso-3">
                <?php include_once 'View/Paginas/Ventas/venta-paso3.php'; ?>
            </div>

            <!-- FIN PASO 3 -->

            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-secondary me-2" id="btnAnterior">Anterior</button>
                <button class="btn btn-primary me-2" id="btnSiguiente">Siguiente</button>
                <button class="btn btn-success" id="btnFinalizar">Finalizar</button>
            </div>

        </div>

    </div>
</div>

<!-- Modal Agregar Cliente -->
<?php require('View/Paginas/Personas/Cliente/form.alta_cliente.php'); ?>



<script src="Assets/js/Validaciones/ventas.js"></script>
<script src="Assets/js/Validaciones/alta_clientes_ventas.js"></script>
<script src="Assets/js/Buscadores/buscar_clienteventa.js"></script>
<script src="Assets/js/Buscadores/buscar_productosventa.js"></script>
<script src="Assets/js/Validaciones/carrito_ventas.js"></script>
<script src="Assets/js/Funciones/caja.ventas.js"></script>
<script src="Assets/js\Ventas/ventas-pasos.js"></script>