<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h2 class="h4 text-center">Registrar Método de Pago</h2>

        <form class="" action="Controller/Ventas/MetodoPago/metodopago.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
            <div class=" boton-agregar">
            <a href="index.php?page=listado_metodopago&modulo=ventas&submodulo=metodopago" class="btn btn-success">Ver Metodos de Pago</a>
        </div>

        </form>
    </div>
    <div class="col">
    </div>
</div>