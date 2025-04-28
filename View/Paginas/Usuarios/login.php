<link rel="stylesheet" href="Assets/css/login.css">
<link rel="stylesheet" href="Assets/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap" rel="stylesheet">
<div class="container">
    <div class="row d-flex justify-content-center vh-100 align-items-center" id="div-row">
        <div class="col-md-5 p-5 shadow-lg bg-body-tertiary rounded">

            <div class="text-center">
                <img src="assets/img/sgd-sinfondo.png" class="w-75 h-75 m-5" alt="sgd-logo">
            </div>
            <h1 class="fs-3 text-center">INICIAR SESIÓN</h1>
            <form id="form_login" action="Controller/Usuario/login.controlador.php" method="POST">
                <input type="hidden" name="action" value="login">
                <div class="mb-3">
                    <label for="nombre_usuario" class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                    </div>
                    <p id="username_parrafo">Se requiere el nombre de usuario</p>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="pass">
                    <p id="password_parrafo">Se requiere una contraseña</p>
                </div>
                <div class="d-grid gap-1">
                    <button onclick="validate()" type="button" class="btn btn-primary">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="Assets/js/Validaciones/login.js"></script>
<script src="Assets/js/bootstrap.bundle.min.js"></script>