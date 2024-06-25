<?php

include_once '../../../Model/Usuario/modulos.php';
include_once '../../../config/conexion.php';


if (isset($_POST['action'])) {
    $modulos = new ModulosControlador();
    if ($_POST['action'] == 'registro') {
        $modulos->registrarModulos();
    } else if ($_POST['action'] == 'modificar') {
        $modulos->modificarModulos();
    } else if ($_POST['action'] == 'eliminar') {
        $modulos->eliminarModulos();
    }
}

# Array ( [action] => modificar [idPerfiles] => 1 [nombreperfil] => Administrador )

class ModulosControlador
{
    public function registrarModulos()
    {
        if (empty($_POST['nombremodulo'])) {
            header('Location: ../../index.php?page=alta_modulos&modulo=usuarios&submodulo=modulos&mensaje=Por favor, completa todos los campos&status=danger');
            exit();
        }

        if (!empty($_POST['nombremodulo'])) {
            $modulo = new Modulos(null, $_POST['nombremodulo']);
            $modulo->guardar();
            header('Location: ../../../index.php?page=listado_modulos&modulo=usuarios&submodulo=modulos');
        } else {
            echo "el campo está vacío";
        }
    }

    public function modificarModulos()
    {
        if (empty($_POST['nombremodulo']) || empty($_POST['idmodulos'])) {
            header('Location: ../../index.php?page=editar_modulos&modulo=usuarios=submodulo=modulos&message=Por favor, complete todos los campos');
        } else {
            $modulos = new Modulos($_POST['idmodulos'], $_POST['nombremodulo']);
            $modulos->actualizar();
            header('Location: ../../../index.php?page=listado_modulos&modulo=usuarios&submodulo=modulos');
        }
    }

    public function eliminarModulos()
    {
        if (!empty($_POST['idmodulos'])) {
            $modulos = new Modulos($_POST['idmodulos'], null);
            $modulos->eliminarModulo();
            header('Location: ../../../index.php?page=listado_modulos&modulo=usuarios&submodulo=modulos');
        }
    }
}
