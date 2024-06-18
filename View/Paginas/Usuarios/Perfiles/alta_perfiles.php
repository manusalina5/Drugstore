<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Registrar Perfil</h1>
        <form class="" action="Controller/Usuario/Perfiles/perfiles.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombreperfil" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombreperfil" name="nombreperfil" required>
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>

        </form>
    </div>
    <div class="col">
    </div>
</div>