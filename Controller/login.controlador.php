<?php

include_once '../Model/usuarios.php';
include_once '../config/conexion.php';

if (isset($_POST['action'])) {
    $login_controller = new LoginControlador();
    if ($_POST['action'] == 'login') {
        $login_controller->ingresar();
    } else if ($_POST['action'] == 'registro') {
        $login_controller->registrar();
    }
}

class LoginControlador
{
    public function ingresar()
    {
        $usuario = new Usuario();
        $usuario->setUserName($_POST['nombre_usuario']);
        $pass = $_POST['pass'];
        $hash = $usuario->obtenerHash();
        if (password_verify($pass, $hash)) {
            header('Location: ../index.php?page=listado_usuarios');
        } else {
            header('Location: ../index.php?mensaje=Usuario o password no correcto');
        }
    }



    public function registrar()
    {
        if (empty($_POST['nombre_usuario']) || empty($_POST['email']) || empty($_POST['pass'])) {
            header('Location: ../index.php?page=registro&mensaje=Por favor, completa todos los campos');
            exit();
        }
        $usuario = new Usuario(null, $_POST['nombre_usuario'], $_POST['email'], null);
        $passhash = password_hash($_POST['pass'], PASSWORD_DEFAULT);
        $usuario->setPass($passhash);
        $usuario->guardar();
        header('Location: ../index.php?page=listado_usuarios');
    }
}
