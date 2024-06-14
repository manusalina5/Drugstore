<?php

include_once '../../../Model/Personas/Direccion/direccion.php';
include_once '../../../config/conexion.php';


if (isset($_POST['action'])) {
    $direccion = new DireccionControlador();
    if ($_POST['action'] == 'registro') {
        $direccion->registrarDireccion();
    } else if ($_POST['action'] == 'modificar'){
        $direccion->modificarDireccion();
    } else if ($_POST['action'] == 'eliminar'){
        $direccion->eliminarDireccion();
    }
}

class DireccionControlador {
    
    public function registrarDireccion(){
        if (empty($_POST['descripciondireccion'])){
            header('Location: ../../index.php?page=registro&Por favor, completa todos los campos');
        }

        if (!empty($_POST['descripciondireccion'])) {
            $direccion = new Direccion(null, $_POST['descripciondireccion'], null);
            $direccion->guardar();
            header('Location: ../../../index.php?page=listado_direccion&modulo=personas&submodulo=direccion');
        } else {
            echo 'El campo está vacío';
        }
    }

    public function modificarDireccion(){
        if (empty($_POST['descripciondireccion']) || empty($_POST['iddireccion'])){
            header('Location: ../../index.php?page=modificar&message=Por favor, complete todos los cmapos');
        } else {
            $direccion = new Direccion($_POST['iddireccion'], $_POST['descripciondireccion'], null);
            $direccion->actualizar();
            header('Location: ../../../index.php?page=listado_direccion&modulo=personas&submodulo=direccion');
        }
    }

    public function eliminarDireccion(){
        if (!empty($_POST['iddireccion'])) {
            $direccion = new Direccion($_POST['iddireccion'], null, null);
            $direccion->eliminar();
            header('Location: ../../../index.php?page=listado_direccion&modulo=personas&submodulo=direccion');
        }
    }
}