<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Registrar Marca</h1>
        <form class="" action="Controller/Productos/marca.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombremarca" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombremarca" name="nombremarca" required>
            </div>
            <div class="d-grid gap-1">
            <button type="submit" class="btn btn-success">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>