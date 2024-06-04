<?php

include_once '../../Model/Productos/rubro.php';
include_once '../../config/conexion.php';

if(isset($_POST['action'])) {
    $rubro_controller = new RubroControlador();
    if ($_POST['action'] == 'registro'){
        $rubro_controller->registrarRubro();
    } # agregar modificar (else)
}

class RubroControlador{

    public function registrarRubro(){

        if(!empty($_POST['nombreRubro'])){
            $rubro = new Rubro();
            $rubro->setNombre($_POST['nombreRubro']);
            $rubro->guardar();
            header('Location: ../../index.php?page=listado_rubro&modulo=productos');
        }
        
    }

    public function modificarRubro(){
        if (empty($_POST['nombre']) || empty($_POST['id'])) {
            header('Location: ../index.php?page=modificar&id='.$_POST['id'].'message=Por favor, completa todos los campos');
        } else{
            $rubro = new Rubro($_POST['id'], $_POST['nombre']);
            $rubro->actualizar();
            header('Location: ../../index.php?page=listado_rubro');
        }
    }
    
}

