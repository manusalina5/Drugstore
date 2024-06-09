<?php

include_once '../../../Model/Personas/Contacto/tipoContacto.php';
include_once '../../../config/conexion.php';

if (isset($_POST['action'])) {
    $tipocontacto = new TipoContactoControlador();
    if ($_POST['action'] == 'registro') {
        $tipocontacto->registrarTipoContacto();
    } else if ($_POST['action'] == 'modificar') {
        $tipocontacto->modificarTipoContacto();
    } else if ($_POST['action'] == 'eliminar') {
        $tipocontacto->eliminarTipoContacto();
    }
}

class TipoContactoControlador
{
    public function registrarTipoContacto(){
        if (empty($_POST['valortipocontacto'])) {
            header('Location: ../../index.php?page=registro&=Por favor, completa todos los campos');
        }

        if (!empty($_POST['valortipocontacto'])) {
            $tipodocumento = new TipoContacto(null, $_POST['valortipodecontacto']);
            $tipodocumento->guardar();
            header('Location: ../../../index.php?page=listado_tipocontacto&modulo=personas&submodulo=contacto');
        } else {
            echo "el campo está vacío";
        }
    }

    public function modificarTipoContacto(){
        if (empty($_POST['valortipocontacto']) || empty($_POST['idtipocontacto'])){
            header('Location: ../../index.php?page=modificar&message=Por favor, complete todos los campos');
        } else {
            $tipocontacto = new TipoContacto($_POST['idtipocontacto'], $_POST['valortipocontacto']);
            $tipocontacto->actualizar();
            header('Location: ../../../index.php?page=listado_tipocontacto&modulo=personas&submodulo=contacto');
        }
    }

    public function eliminarTipoContacto(){
        if (!empty($_POST['idtipocontacto'])) {
            $tipocontacto = new TipoContacto($_POST['idtipocontacto'], null);
            $tipocontacto->eliminar();
            header('Location: ../../../index.php?page=listado_tipocontacto&modulo=personas&submodulo=contacto');
        }
    }
}