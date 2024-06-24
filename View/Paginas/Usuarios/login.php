<link rel="stylesheet" href="Assets/css/login.css">
<div class="row "  id="div-row">
    <div class="col">
    </div>
    <div class="col">
        <h1 class="text-center">Iniciar Sesión</h1>
        <form id="form_login" class="" action="Controller/Usuario/login.controlador.php" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                <p id="username_parrafo">Se requiere el nombre de usuario</p>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input  type="password" class="form-control" id="password" name="pass">
                <p id="password_parrafo">Se requiere una contraseña</p>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Recordarme</label>
            </div>
            <div class="d-grid gap-1">
            <button onclick="validate()" type="button" class="btn btn-primary">Ingresar</button>
            </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>

<script src="Assets/js/Validaciones/login.js"></script>