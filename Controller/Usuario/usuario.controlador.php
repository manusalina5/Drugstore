<?php

include_once '../../Model/Usuario/usuarios.php';
include_once '../../Model/Usuario/perfiles.php';
include_once '../../config/conexion.php';

session_start();

//print_r($_POST);
// echo "<br>";
// echo $_SESSION['nombre_usuario'];
//exit();

session_start();

if (isset($_POST['action'])) {
    $login_controller = new UsuarioControlador();
    if ($_POST['action'] == 'registro') {
        $login_controller->registrar();
    } else if ($_POST['action'] == 'reestrablecerPass') {
        $login_controller->reestrablecerContraseña();
    } else if ($_POST['action'] == 'actualizarPass') {
        $login_controller->actualizarPass();
    } else if ($_POST['action'] == 'eliminar') {
        $login_controller->eliminarUsuario();
    }
}

class UsuarioControlador
{

    public function registrar()
    {
        if (
            empty($_POST['nombre_usuario']) ||
            empty($_POST['pass']) ||
            empty($_POST['idEmpleado']) ||
            empty($_POST['idPerfil'])
        ) {
            header('Location: ../index.php?page=registro&mensaje=Por favor, completa todos los campos&status=danger');
            exit();
        }
        $usuario = new Usuario(null, $_POST['nombre_usuario'], $_POST['pass'], $_POST['idEmpleado'], $_POST['idPerfil']);
        $usuario->guardar();
        header('Location: ../../index.php?page=listado_usuarios&modulo=usuarios');
    }

    public function reestrablecerContraseña()
    {
        if (empty($_POST['idUsuario'])) {
            header('Location: ../../index.php?page=listado_usuarios&modulo=usuarios&mensaje=Id usuario vacio&status=danger');
        } else {
            $usuario = new Usuario();
            $usuario->setIdUsuario($_POST['idUsuario']);
            $usuario->reestablecerPass();
            header('Location: ../../index.php?page=listado_usuarios&modulo=usuarios&mensaje=Se reestablecio correctamente la contraseña&status=success');
        }
    }

    public function actualizarPass()
    {
        if (
            empty($_POST['idUsuario']) ||
            empty($_POST['confirmarPass']) ||
            empty($_POST['nuevoPass'])
        ) {
            header('Location: ../../index.php?page=actualizar_pass&modulo=usuarios&mensaje=Completar todos los campos!&status=danger');
        } else {
            if ($_POST['nuevoPass'] == $_POST['confirmarPass']) {
                $usuario = new Usuario();
                $usuario->setPass($_POST['nuevoPass']);
                $usuario->setIdUsuario($_POST['idUsuario']);
                $usuario->actualizarPass();
                header('Location: ../../index.php?mensaje=Se actualizo correctamente la contraseña&status=success');
            } else {
                header('Location: ../../index.php?page=actualizar_pass&modulo=usuarios&mensaje=Las contraseñas no coinciden&status=danger');
            }
        }
    }

    public function eliminarUsuario()
    {
        if (empty($_POST['idUsuario'])) {
            header('Location: ../../index.php?page=listado_usuarios&modulo=usuarios&mensaje=Id del usuario vacio&status=danger');
        } else {
            if ($_POST['username'] == $_SESSION['nombre_usuario']) {
                header('Location: ../../index.php?page=listado_usuarios&modulo=usuarios&mensaje=Error: No puede eliminar el usuario logueado&status=danger');
            } else {
                $usuario = new Usuario();
                $usuario->setIdUsuario($_POST['idUsuario']);
                $usuario->eliminar();
                header('Location: ../../index.php?page=listado_usuarios&modulo=usuarios&mensaje=Se elimino correctamente el usuario&status=success');
            }
        }
    }
}
