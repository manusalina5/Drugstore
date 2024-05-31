<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Iniciar Sesión</h1>
        <form class="" action="Controller/login.controlador.php" method="POST">
            <input type="hidden" name="action" value="login">
            <div class="mb-3">
                <label for="exampleUserName" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" id="exampleUserName" name="nombre_usuario">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="pass">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>