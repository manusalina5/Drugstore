<?php
include_once '../../Model/Ventas/tipo_descuento.php';
include_once '../../config/conexion.php';


class TipoDescuentoControlador
{

    public function __construct()
    {
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        if (isset($action)) {
            switch ($action) {
                case 'registro':
                    $this->guardarTipoDescuento();
                    break;
                case 'editar':
                    $this->editarTipoDescuento();
                    break;
                case 'eliminar':
                    $this->eliminarTipoDescuento();
                    break;
            }
        }
    }

    public function guardarTipoDescuento()
    {
        if (isset($_POST['nombre']) && isset($_POST['descripcion'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $tipoDescuento = new TipoDescuento();
            $tipoDescuento->setNombre($nombre);
            $tipoDescuento->setDescripcion($descripcion);
            $tipoDescuento->guardarTipoDescuento();
            header('Location: ../../index.php?page=tipo_descuento&modulo=ventas&status=success&mensaje=Tipo de descuento guardado correctamente');
        }
    }

    public function editarTipoDescuento()
    {
        if (isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['id'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $id = $_POST['id'];
            $tipoDescuento = new TipoDescuento();
            $tipoDescuento->setNombre($nombre);
            $tipoDescuento->setDescripcion($descripcion);
            $tipoDescuento->setIdTipoDescuento($id);
            $tipoDescuento->editarTipoDescuento();
            header('Location: ../../index.php?page=tipo_descuento&modulo=ventas&status=warning&mensaje=Tipo de descuento editado correctamente');
        }

    }

    public function eliminarTipoDescuento(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $tipoDescuento = new TipoDescuento();
            $tipoDescuento->setIdTipoDescuento($id);
            $tipoDescuento->eliminarTipoDescuento();
            header('Location: ../../index.php?page=tipo_descuento&modulo=ventas&status=danger&mensaje=Tipo de descuento eliminado correctamente');
        }
    }
}

new TipoDescuentoControlador();