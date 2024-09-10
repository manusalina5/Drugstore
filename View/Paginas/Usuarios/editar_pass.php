<?php
$user_id = $_SESSION['user_id'];

?>
<link rel="stylesheet" href="Assets/css/registro.css">
<div class="alert alert-danger text-center" id="alert-cambio-pass">Las contraseñas no coinciden</div>';
<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1 class="text-center h2">Actualizar Contraseña</h1>
        <form id="form-pass" action="Controller/Usuario/usuario.controlador.php" method="POST">
            <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($user_id); ?>">
            <input type="hidden" name="action" value="actualizarPass">
            <div class="mb-3">
                <label for="passActual" class="form-label">Contraseña actual</label>
                <input type="password" class="form-control" id="passActual" name="passActual" required>
            </div>
            <div class="mb-3">
                <label for="nuevoPass" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="nuevoPass" name="nuevoPass" required>
            </div>
            <div class="mb-3">
                <label for="confirmarPass" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirmarPass" name="confirmarPass" required>
            </div>
            <div class="d-grid gap-2">
                <button onclick="validarCambioPass()" type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>

<script src="Assets/js/Validaciones/usuarios.js"></script>
<script>
    document.getElementById("form-pass").addEventListener("submit", validarCambioPass);
</script>