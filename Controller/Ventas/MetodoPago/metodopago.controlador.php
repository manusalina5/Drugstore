<?php

include_once '../../../Model/Ventas/MetodoPago/metodopago.php';
include_once '../../../config/conexion.php';

if (isset($_POST['action'])) {
    $metodopago = new MetodoPagoControlador();
    if ($_POST['action'] == 'registro') {
        $metodopago->registrarMetodoPago();
    } else if ($_POST['action'] == 'modificar') {
        $metodopago->modificarMetodoPago();
    } else if ($_POST['action'] == 'eliminar') {
        $metodopago->eliminarMetodoPago();
    }
}

class MetodoPagoControlador{
    public function registrarMetodoPago(){
        if (empty($_POST['nombre']) || (empty($_POST['descripcion']))){
            header('Location: ../../index.php?page=registro&Por favor, completa todos los campos');
        }

        if (!empty($_POST['nombre']) || (!empty($_POST['descripcion']))){
            $metodopago = new MetodoPago(null, $_POST['nombre'], $_POST['descripcion']);
            $metodopago->guardar();
            header('Location: ../../../index.php?page=listado_metodopago&modulo=ventas&submodulo=metodopago');
        } else {
            echo "El campo está vacío";
        }
    }


    public function modificarMetodoPago(){
        if (empty($_POST['nombre']) || (empty($_POST['descripcion']))){
            header('Location: ../../index.php?page=modificar&message=Por favor, complete todos los campos');
        } else {
            $metodopago = new MetodoPago($_POST['idmetodoPago'], $_POST['nombre'], $_POST['descripcion']);
            $metodopago->actualizar();
            header('Location: ../../../index.php?page=listado_metodopago&modulo=ventas&submodulo=metodopago');
        }
    }

    public function eliminarMetodoPago(){
        if (!empty($_POST['idmetodoPago'])){
            $metodopago = new MetodoPago($_POST['idmetodoPago'], null, null);
            $metodopago->eliminar();
            header('Location: ../../../index.php?page=listado_metodopago&modulo=ventas&submodulo=metodopago');
        }
    }
}