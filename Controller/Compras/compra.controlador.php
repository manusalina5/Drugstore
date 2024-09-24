<?php

include_once '../../../Model/Compras/Compra/compras.php';
include_once '../../../config/conexion/php';

if (isset($_POST['action'])) {
    $compra = new CompraControlador();
    if ($_POST['action'] == 'registro') {
        $compra->registrarMetodoPago();
    } else if ($_POST['action'] == 'modificar') {
        $compra->modificarCompra();
    } else if ($_POST['action'] == 'eliminar') {
        $compra->eliminarCompra();
    }
}


class CompraControlador{
    public function registrarCompra(){
        if (empty($_POST['fechacompra']) || 
        (empty($_POST['horacompra'])) || 
        (empty($_POST['totalcompra'])) ){
            header('Location: ../../index.php?page=registro&Por favor, completa todos los campos');
        }

        if ((empty($_POST['fechacompra'])) || 
        (empty($_POST['horacompra'])) || 
        (empty($_POST['totalcompra']))) {
            $compra = new Compra(null, $_POST['fechacompra'], $_POST['horacompra'], $_POST['totalcompra'] );
            $metodopago = $compra->guardar();
            header('Location: ../../../index.php?page=listado_compra&modulo=compras&submodulo=compra');
        } else {
            echo "El campo está vacío";
        }
    }

    public function modificarCompra(){
        if (empty($_POST['fechacompra']) || 
        (empty($_POST['horacompra'])) || 
        (empty($_POST['totalcompra'])) ){
            header('Location: ../../index.php?page=modificar&message=Por favor, complete todos los campos');
        } else {
            $compra = new Compra($_POST['idCompra'], $_POST['fechacompra'], $_POST['horacompra'], $_POST['totalcompra'] );
            $compra->actualizar();
            header('Location: ../../../index.php?page=listado_compra&modulo=compras&submodulo=compra');
        }
    }

    public function eliminarCompra(){
        if (!empty($_POST['idCompra'])){
            $compra = new Compra($_POST['idCompra'], null, null, null);
            $compra->eliminar();
            header('Location: ../../../index.php?page=listado_compra&modulo=compras&submodulo=compra');
        }
    }

    public function registrarMetodoPago() {}
}