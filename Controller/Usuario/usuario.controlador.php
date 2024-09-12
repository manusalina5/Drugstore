<?php

include_once '../../Model/Usuario/usuarios.php';
include_once '../../Model/Usuario/perfiles.php';
include_once '../../config/conexion.php';

session_start();

if (isset($_GET['action']) && $_GET['action'] == 'buscar') {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $registro_por_pagina = 10;
    $inicio = ($pagina - 1) * $registro_por_pagina;

    $usuarioObj = new Usuario();
    $usuarios = $usuarioObj->buscarUsuarios($busqueda, $inicio, $registro_por_pagina);
    $total_paginas = Usuario::totalPaginasBusqueda($busqueda, $registro_por_pagina);

    echo json_encode([
        'usuarios' => $usuarios,
        'total_paginas' => $total_paginas
    ]);
    exit();
}

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

    public function validarPass($pass)
    {
        $usuario = new Usuario();
        $usuario->setIdUsuario($_POST['idUsuario']);
        $hash = $usuario->obtenerHash();
        return password_verify($pass, $hash);
    }

    public function actualizarPass()
    {
        if (
            empty($_POST['idUsuario']) ||
            empty($_POST['confirmarPass']) ||
            empty($_POST['nuevoPass']) ||
            empty($_POST['passActual'])
        ) {
            header('Location: ../../index.php?page=editar_pass&modulo=usuarios&mensaje=Completar todos los campos!&status=danger');
        } else {
            if ($this->validarPass($_POST['passActual'])) {
                if ($_POST['nuevoPass'] == $_POST['confirmarPass']) {
                    $usuario = new Usuario();
                    $usuario->setPass($_POST['nuevoPass']);
                    $usuario->setIdUsuario($_POST['idUsuario']);
                    $usuario->actualizarPass();
                    header('Location: ../../index.php?page=salida&modulo=usuarios&mensaje=Se actualizo correctamente la contraseña, ingrese nuevamente&status=success');
                } else {
                    header('Location: ../../index.php?mensaje=Las contraseñas no coinciden&status=danger');
                }
            } else {
                header('Location: ../../index.php?page=editar_pass&modulo=usuarios&mensaje=Contraseña actual incorrecta&status=danger');
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
