<?php

include_once '../../Model/Productos/rubro.php';
include_once '../../config/conexion.php';

if (isset($_POST['action'])) {
    $rubro_controller = new RubroControlador();
    if ($_POST['action'] == 'registro') {
        $rubro_controller->registrarRubro();
    } else if ($_POST['action'] == 'modificar') {
        $rubro_controller->modificarRubro();
    } else if ($_POST['action'] == 'eliminar') {
        $rubro_controller->eliminarRubro();
    }
}


class RubroControlador
{

    public function registrarRubro()
    {

        if (!empty($_POST['nombreRubro'])) {
            $rubro = new Rubro();
            $rubro->setNombre($_POST['nombreRubro']);
            $rubro->guardar();
            header('Location: ../../index.php?page=listado_rubro&modulo=productos');
        }

    }

    public function modificarRubro()
    {
        if (empty($_POST['nombrerubro']) || empty($_POST['id'])) {
            header('Location: ../index.php?page=modificar&id=' . $_POST['id'] . 'message=Por favor, completa todos los campos');
        } else {
            $rubro = new Rubro($_POST['id'], $_POST['nombrerubro']);
            $rubro->actualizar();
            header('Location: ../../index.php?page=listado_rubro&modulo=productos');
        }
    }

    public function eliminarRubro()
    {
        if (!empty($_POST['id'])) {
            $rubro = new Rubro($_POST['id'], null);
            $rubro->eliminar();
            header('Location: ../../index.php?page=listado_rubro&modulo=productos');

        }
    }

}

