<?php

include_once 'Model/Personas/Direccion/direccion.php';
include_once 'config/conexion.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $direccion = new Direccion();
    $direccion->setId($id);
    $direccionData = direccion->obtenerDireccionPorId();
} else{
    echo "El form está vacío";
}

?>


<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Direccion</h1>
        <form action="Controller/Personas/Direccion/direccion.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="iddireccion" value="<?php echo $direccionData['iddireccion']; ?>">
            <div class="mb-3">
                <label for="descripciondireccion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripciondireccion" name="descripciondireccion" value="<?php echo $direccionData['descripcion']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>