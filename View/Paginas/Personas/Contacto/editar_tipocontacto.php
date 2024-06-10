<?php
include_once 'Model/Personas/Contacto/tipocontacto.php';
include_once 'config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $tipocontacto = new Tipocontacto();
    $tipocontacto->setId($id);
    $tipocontactoData = $tipocontacto->obtenerTipocontactoPorId();
}else{
    echo "El form esta vacio";
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Tipo de Contacto</h1>
        <form action="Controller/Personas/Contacto/tipocontacto.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idtipocontacto" value="<?php echo $tipocontactoData['idtipocontactos']; ?>">
            <div class="mb-3">
                <label for="valortipocontacto" class="form-label">Valor</label>
                <input type="text" class="form-control" id="valortipocontacto" name="valortipocontacto" value="<?php echo $tipocontactoData['valor']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>
