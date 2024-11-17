<?php
if (!empty($_SESSION['nombre_usuario'])) {
    $username = $_SESSION['nombre_usuario'];
    echo "<h2 class='text-center fs-3'>Bienvenido<strong class='textusername'> " . "@" . $username . "!</strong></h2>";
}

include_once 'Controller/Dashboard/dashboard.controlador.php';
include_once 'Model/Dahsboard/producto_dashboard.php';
include_once 'Model/Dahsboard/proveedor_dashboard.php';
include_once 'Model/Dahsboard/venta_dashboard.php';

$dashboardData = (new DashboardController())->getDashboardData();
?>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">Productos Registrados</h5>
                <p class="card-text display-4"><?= $dashboardData['productos'] ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">Ventas Realizadas</h5>
                <p class="card-text display-4"><?= $dashboardData['ventas'] ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center mb-3">
            <div class="card-body">
                <h5 class="card-title">Proveedores Registrados</h5>
                <p class="card-text display-4"><?= $dashboardData['proveedores'] ?></p>
            </div>
        </div>
    </div>
</div>


<div class="text-center">
    <img src="assets/img/sgd-sinfondo.png" class="img-dashboard" alt="sgd-logo">
</div>