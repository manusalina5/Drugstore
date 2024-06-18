<?php

include_once '../../../Model/Usuario/perfiles.php';
include_once '../../../config/conexion.php';


if (isset($_POST['action'])) {
    $perfiles = new PerfilesControlador();
    if ($_POST['action'] == 'registro') {
        $perfiles->registrarPerfiles();
    } else if ($_POST['action'] == 'modificar') {
        $perfiles->modificarperfiles();
    } else if ($_POST['action'] == 'eliminar') {
        $perfiles->eliminarPerfiles();
    }
}

# Array ( [action] => modificar [idPerfiles] => 1 [nombreperfil] => Administrador )

class PerfilesControlador
{
    public function registrarPerfiles()
    {
        if (empty($_POST['nombreperfil'])) {
            header('Location: ../../index.php?page=registro&mensaje=Por favor, completa todos los campos&status=danger');
        }

        if (!empty($_POST['nombreperfil'])) {
            $tipodocumento = new Perfil(null, $_POST['nombreperfil']);
            $tipodocumento->guardar();
            header('Location: ../../../index.php?page=listado_perfiles&modulo=usuarios&submodulo=perfiles');
        } else {
            echo "el campo está vacío";
        }
    }

    public function modificarPerfiles()
    {
        if (empty($_POST['nombreperfil']) || empty($_POST['idPerfiles'])) {
            header('Location: ../../index.php?page=editar_perfiles&modulo=usuarios=submodulo=perfiles&message=Por favor, complete todos los campos');
        } else {
            $perfiles = new Perfil($_POST['idPerfiles'], $_POST['nombreperfil']);
            $perfiles->actualizar();
            header('Location: ../../../index.php?page=listado_perfiles&modulo=usuarios&submodulo=perfiles');
        }
    }

    public function eliminarPerfiles()
    {
        if (!empty($_POST['idPerfiles'])) {
            $perfiles = new Perfil($_POST['idPerfiles'], null);
            $perfiles->eliminar();
            header('Location: ../../../index.php?page=listado_perfiles&modulo=usuarios&submodulo=perfiles');
        }
    }
}
