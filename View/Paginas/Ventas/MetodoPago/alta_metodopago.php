<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Registrar Método de Pago</h1>
        <form class="" action="Controller/Ventas/MetodoPago/metodopago.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>