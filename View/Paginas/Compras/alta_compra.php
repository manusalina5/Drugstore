<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Alta de Compra</h1>
        <form action="Controller/Compras/Compra/compra.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idCompra" value="<?php echo $compraData['idCompra']; ?>">
            <div class="mb-3">
                <label for="fechacompra" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fechacompra" name="fechacompra" required>
            </div>

            <div class="mb-3">
                <label for="horacompra" class="form-label">Hora</label>
                <input type="time" class="form-control" id="horacompra" name="horacompra" required>
            </div>

            <div class="mb-3">
                <label for="totalcompra" class="form-label">Total Compra</label>
                <input type="text" class="form-control" id="totalcompra" name="totalcompra" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col"></div>
</div>