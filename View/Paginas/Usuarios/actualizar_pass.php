<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Actualizar Contraseña de <?php echo $_SESSION['nombre_usuario']; ?></h1>
        <form action="Controller/Usuario/usuario.controlador.php" method="POST">
            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="action" value="actualizarPass">
            <div class="mb-3">
                <label for="nuevoPass" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="nuevoPass" name="nuevoPass" required>
            </div>
            <div class="mb-3">
                <label for="confirmarPass" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirmarPass" name="confirmarPass" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>