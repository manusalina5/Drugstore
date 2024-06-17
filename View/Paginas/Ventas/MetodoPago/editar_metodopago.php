<?php


include_once 'Model/Ventas/MetodoPago/metodopago.php';
include_once 'config/conexion.php';

if (isset($_GET['idmetodoPago'])) {
    $id = $_GET['idmetodoPago']; 
    $metodopago = new MetodoPago();
    $metodopago->setIdmetodoPago($id);
    $metodopagoData = $metodopago->obtenerMetodoPagoId();
} else {
    echo "El form esta vacio";
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Método de Pago</h1>
        <form action="Controller/Ventas/MetodoPago/metodopago.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idmetodoPago" value="<?php echo $metodopagoData['idmetodoPago']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $metodopagoData['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $metodopagoData['descripcion']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>