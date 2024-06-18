<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1 class="h2">Registrar Tipo Egreso</h1>
        <form class="" action="Controller/Caja/Egreso/tipoegreso.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="descripciontipoegreso" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripciontipoegreso" name="descripciontipoegreso" required>
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>