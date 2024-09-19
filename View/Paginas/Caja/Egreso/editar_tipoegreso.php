<?php


include_once 'Model/Caja/Egreso/tipoegreso.php';
include_once 'config/conexion.php';

if (isset($_GET['idtipoEgresos'])) {
    $id = $_GET['idtipoEgresos']; 
    $tipoegreso = new TipoEgreso();
    $tipoegreso->setId($id);
    $tipoegresoData = $tipoegreso->obtenerTipoEgresoPorId();
} else {
    echo "El form esta vacio";
}
?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Tipo de Egreso</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Caja/Egreso/tipoegreso.controlador.php" method="POST" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idtipoEgresos" value="<?php echo $tipoegresoData['idtipoEgresos']; ?>">
            <div class="mb-3">
                <label for="descripciontipoegreso" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripciontipoegreso" name="descripciontipoegreso" value="<?php echo $tipoegresoData['descripcion']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>

<script src="Assets/js/Validaciones/alta_tipoegreso.js"></script>