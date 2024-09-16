<?php

include_once 'Model/Productos/rubro.php';
include_once 'config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $rubro = new Rubro();
    $rubro->setId($id);
    $rubroData = $rubro->obtenerRubrosPorId();
}

?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Rubro</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form action="Controller/Productos/rubro.controlador.php" method="POST" id="form" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="id" value="<?php echo $rubroData['idRubros']; ?>">
            <div class="mb-3">
                <label for="nombreRubro" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreRubro" name="nombreRubro" value="<?php echo $rubroData['nombre']; ?>" required>
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-success">Modificar</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>

<script src="Assets/js/Validaciones/alta_rubro.js"></script>