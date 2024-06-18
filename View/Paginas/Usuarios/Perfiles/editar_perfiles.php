<?php

include_once 'Model/Usuario/perfiles.php';
include_once 'config/conexion.php';

if(isset($_GET['idPerfiles'])){
    $idPefil = $_GET['idPerfiles'];

    $perfil = new Perfil();
    $perfilData = $perfil->obtenerPerfilesPorId($idPefil);
}

?>

<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Modificar Perfil</h1>
        <form class="" action="Controller/Usuario/Perfiles/perfiles.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idPerfiles" value="<?php echo $perfilData['idPerfiles']; ?>">
            <div class="mb-3">
                <label for="nombreperfil" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreperfil" name="nombreperfil" value="<?php echo $perfilData['nombre']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>