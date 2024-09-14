<?php


include_once 'Model/Compras/Compra/compras.php';
include_once 'config/conexion.php';

if (isset($_GET['idCompra'])) {
    $id = $_GET['idCompra']; 
    $compra = new Compra();
    $compra->setIdcompra($id);
    $compraData = $compra->obtenerCompraId();
} else {
    echo "El form esta vacio";
}
?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Compra</h1>
        <form action="Controller/Compras/Compra/compra.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idCompra" value="<?php echo $compraData['idCompra']; ?>">
            <div class="mb-3">
                <label for="fechacompra" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fechacompra" name="fechacompra" value="<?php echo $compraData['fechaCompra']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="horacompra" class="form-label">Hora</label>
                <input type="time" class="form-control" id="horacompra" name="horacompra" value="<?php echo $compraData['horaCompra']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="totalcompra" class="form-label">Total Compra</label>
                <input type="text" class="form-control" id="totalcompra" name="totalcompra" value="<?php echo $compraData['totalCompra']; ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>