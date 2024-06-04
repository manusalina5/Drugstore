<?php

include_once '../../Model/Productos/marca.php';
include_once '../../config/conexion.php';

if (isset($_POST['action'])){
    $marcaControlador = new MarcaControlador(); 
    if($_POST['action'] == 'registro'){
        $marcaControlador->registrarMarca();
    }else if($_POST['action'] == 'modificar'){
        $marcaControlador->modificarMarca();
    }
}


class MarcaControlador
{
    public function registrarMarca(){
        if(empty($_POST['nombremarca'])){
            header('Localation: ../../index.php?page=registro&=Por favor, completa todos los campos');
        }

        if(!empty($_POST['nombremarca'])){            
            $marca = new Marca(null, $_POST['nombremarca']);
            $marca->guardar();
            header('Location: ../../index.php?page=listado_marca&modulo=productos');
        }else{
            echo 'El campo esta vacio';
        }
    }

    public function modificarMarca() {
        if (empty($_POST['nombremarca']) || empty($_POST['id'])) {
            header('Location: ../index.php?page=modificar&id='.$_POST['id'].'&message=Por favor, completa todos los campos');
        } else {
            $marca = new Marca($_POST['id'], $_POST['nombremarca']);
            $marca->actualizar();
            header('Location: ../../index.php?page=listado_marca&modulo=productos');
        }
    }

    public function eliminarMarca() {
        
    }
}
