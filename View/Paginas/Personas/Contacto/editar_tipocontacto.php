<?php
include_once 'Model/Personas/Contacto/tipocontacto.php';
include_once 'config/conexion.php';

if (isset($_GET['idtipocontacto'])) {
    $id = $_GET['idtipocontacto']; 
    $tipocontacto = new Tipocontacto();
    $tipocontacto->setId($id);
    $tipocontactoData = $tipocontacto->obtenerTipocontactoPorId();
}else{
    echo "El form esta vacio";
}
?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Tipo de Contacto</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Personas/Contacto/tipocontacto.controlador.php" method="POST" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idtipocontacto" value="<?php echo $tipocontactoData['idtipoContacto']; ?>">
            <div class="mb-3">
                <label for="valortipocontacto" class="form-label">Valor</label>
                <input type="text" class="form-control" id="valortipocontacto" name="valortipocontacto" value="<?php echo $tipocontactoData['valor']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>

<script src="Assets/js/Validaciones/alta_tipocontacto.js"></script>
