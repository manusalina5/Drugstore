<?php

include_once '../../../Model/Caja/Egreso/tipoegreso.php';
include_once '../../../config/conexion.php';

if (isset($_POST['action'])) {
    $tipoegreso = new TipoEgresoControlador();
    if ($_POST['action'] == 'registro') {
        $tipoegreso->registrarTipoEgreso();
    } else if ($_POST['action'] == 'modificar') {
        $tipoegreso->modificarTipoEgreso();
    } else if ($_POST['action'] == 'eliminar') {
        $tipoegreso->eliminarTipoEgreso();
    }
}


class TipoEgresoControlador{

    public function registrarTipoEgreso(){
        if (empty($_POST['descripciontipoegreso'])){
            header('Location: ../../index.php?page=registro&=Por favor, completa todos los campos');
        }
        if (!empty($_POST['descripciontipoegreso'])){
            $tipoegreso = new TipoEgreso(null, $_POST['descripciontipoegreso']);
            $tipoegreso->guardar();
            header('Location: ../../../index.php?page=listado_tipoegreso&modulo=caja&submodulo=egreso');
        } else {
            echo "El campo está vacío";
        }
    }

    public function modificarTipoEgreso(){
        if (empty($_POST['descripciontipoegreso']) || empty($_POST['idtipoegreso'])){
            header('Location: ../../index.php?page=modificar&message=Por favor, complete todos los campos');
        } else {
            $tipoegreso = new TipoEgreso($_POST['idtipoegreso'], $_POST['descripciontipoegreso']);
            $tipoegreso->actualizar();
            header('Location: ../../../index.php?page=listado_tipoegreso&modulo=caja&submodulo=egreso');
        }
    }

    public function eliminarTipoEgreso(){
        if (!empty($_POST['idtipoegreso'])){
            $tipoegreso = new TipoEgreso($_POST['idtipoegreso'], null);
            $tipoegreso->eliminar();
            header('Location: ../../../index.php?page=listado_tipoegreso&modulo=caja&submodulo=egreso');
        }
    }
}