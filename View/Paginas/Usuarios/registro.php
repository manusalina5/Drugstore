<link rel="stylesheet" href="Assets/css/registro.css">
<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1 class="text-center">Registrar Usuario</h1>
        <form id="form_registro" action="Controller/Usuario/usuario.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input onfocusout="validate_username(event)" type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
                <p id="username_parrafo" class="text-danger" style="display:none;">El usuario ya existe</p>
                <p id="username_parrafoVacio" class="text-danger" style="display:none;">El usuario no puede estar vacío</p>
                <p id="username_valido" class="text-success" style="display:none;">El usuario está disponible</p>
            </div>
            <div class="mb-3">
                <!-- <label for="password" class="form-label">Contraseña</label> -->
                <input type="hidden" class="form-control" id="password" name="pass" value='drugstore123'>
                <p id="password_parrafo" class="text-danger" style="display:none;">La contraseña está vacía</p>
            </div>
            <div class="mb-3">
                <label for="selectEmpleados">Empleados</label>
                <select class='form-select' aria-label='select empleados' required name='idEmpleado' id="selectEmpleados">
                    <option value="">Selecciona al empleado</option>
                    <?php
                    include_once('Model/Personas/Empleado/empleado.php');
                    $empleadoObj = new Empleado();
                    $empleados = $empleadoObj->obtenerEmpleadosSinUsuario();
                    if(!empty($empleados)){
                        foreach($empleados as $empleado){
                            $nombreApellido = $empleado['nombre'] . ' ' . $empleado['apellido'];
                            echo "<option value='{$empleado['idEmpleado']}'>{$nombreApellido}</option>";
                        }
                    }
                    ?>
                </select>
                <p id="empleado_parrafo" class="text-danger" style="display:none;">Elija un empleado</p>
            </div>
            <div class="mb-3">
                <label for="selectPerfiles">Perfiles</label>
                <select class='form-select' aria-label='select perfiles' required name='idPerfil' id="selectPerfiles">
                    <option value="">Selecciona el perfil</option>
                    <?php
                    include_once('Model/Usuario/perfiles.php');
                    $perfilObj = new Perfil();
                    $perfiles = $perfilObj->obtenerPerfiles();
                    if(!empty($perfiles)){
                        foreach($perfiles as $perfil){
                            $nombrePerfil = $perfil['nombre'];
                            $idPerfil = $perfil['idPerfiles'];
                            echo "<option value='{$idPerfil}'>{$nombrePerfil}</option>";
                        }
                    }
                    ?>
                </select>
                <p id="perfil_parrafo" class="text-danger" style="display:none;">Elija un perfil</p>
            </div>
            <!-- <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div> -->
            <div class="d-grid gap-1">
                <button onclick="validate(event)" type="submit" class="btn btn-success">Registrar</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>
<script src="Assets/js/Validaciones/usuarios.js"></script>