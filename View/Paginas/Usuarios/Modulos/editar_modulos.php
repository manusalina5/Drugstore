<?php

include_once 'Model/Usuario/modulos.php';
include_once 'config/conexion.php';

if(isset($_GET['idmodulos'])){
    $idModulo = $_GET['idmodulos'];

    $modulo = new Modulos();
    $moduloData = $modulo->obtenerModulosPorId($idModulo);
}

?>

<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Modificar Modulo</h1>
        <form class="" action="Controller/Usuario/Modulos/modulo.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idmodulos" value="<?php echo $moduloData['idmodulos']; ?>">
            <div class="mb-3">
                <label for="nombremodulo" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombremodulo" name="nombremodulo" value="<?php echo $moduloData['nombre']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>