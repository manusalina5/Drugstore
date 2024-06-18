<?php

include_once 'Model/Productos/rubro.php';
include_once 'config/conexion.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $rubro = new Rubro();
    $rubro->setId($id);
    $rubroData = $rubro->obtenerRubrosPorId();
}

?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Rubro</h1>
        <form action="Controller/Productos/rubro.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="id" value="<?php echo $rubroData['idRubros']; ?>">
            <div class="mb-3">
                <label for="nombrerubro" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombrerubro" name="nombrerubro" value="<?php echo $rubroData['nombre']; ?>" required>
            </div>
            <div class="d-grid gap-1">
            <button type="submit" class="btn btn-success">Modificar</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>
