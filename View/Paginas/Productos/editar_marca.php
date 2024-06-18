<?php
include_once 'Model/Productos/marca.php';
include_once 'config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Suponemos que se pasa el ID de la marca por la URL

    $marca = new Marca();
    $marca->setId($id);
    $marcaData = $marca->obtenerMarcaPorId();
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Marca</h1>
        <form action="Controller/Productos/marca.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="id" value="<?php echo $marcaData['idmarca']; ?>">
            <div class="mb-3">
                <label for="nombremarca" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombremarca" name="nombremarca" value="<?php echo $marcaData['nombre']; ?>" required>
            </div>
            <div class="d-grid gap-1">
            <button type="submit" class="btn btn-success">Modificar</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>
