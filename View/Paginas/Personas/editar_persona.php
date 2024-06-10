<?php
include_once 'Model/Personas/persona.php';
include_once 'config/conexion.php';

if (isset($_GET['idPersona'])) {
    $id = $_GET['idPersona']; 
    $persona = new Persona();
    $persona->setId($id);
    $personaData = $persona->obtenerPersonasPorId();
}else{
    echo "El form esta vacio";
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Persona</h1>
        <form action="Controller/Personas/persona.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idPersona" value="<?php echo $personaData['idPersona']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Valor</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $personaData['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Valor</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $personaData['apellido']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>

