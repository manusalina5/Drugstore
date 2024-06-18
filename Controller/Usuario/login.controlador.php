<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../../Model/Usuario/usuarios.php';
include_once '../../Model/Usuario/perfiles.php';
include_once '../../config/conexion.php';

session_start();

if (isset($_POST['action'])) {
    $login_controller = new LoginControlador();
    if ($_POST['action'] == 'login') {
        $login_controller->ingresar();
    }
}

class LoginControlador
{
    public function ingresar()
    {
        $usuario = new Usuario();
        $perfil = new Perfil();
        $usuario->setUserName($_POST['nombre_usuario']);
        $resultado = $usuario->validarUsuario();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                if (password_verify($_POST['pass'], $row['password'])) {
                        # Se inicializa el nombre de usuario en la sesion
                        $_SESSION['nombre_usuario'] = $row['username'];

                        # Se obtiene el perfil
                        $perfilData = $perfil->obtenerPerfilesPorId($row['perfiles_idperfiles']);

                        # Se inicializa el perfil de usuario en la sesion
                        $_SESSION['idPerfil'] = $perfilData['idperfiles'];
                        $_SESSION['nombre_perfil'] = $perfilData['nombre'];
                        $_SESSION['user_id'] = $row['idUsuario'];
                        if ($_POST['pass'] == 'drugstore123') {
                            header('Location: ../../index.php?page=actualizar_pass&modulo=usuarios');
                        }else{
                            header('Location: ../../index.php?page=listado_usuarios');
                        }
                        
                    } else {
                        header('Location: ../../index.php?mensaje=Usuario o password no correcto&status=danger');
                    }
                
            }
        } else {
            header('Location: ../../index.php?mensaje=Usuario o password no correcto&status=danger');
        }
    }
}
