<?php


include_once '../../Model/Productos/producto.php';
include_once '../../config/conexion.php';


class ProductoControlador
{
    public function __construct()
    {
        if (isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'registro':
                    $this->registrarProducto();
                    break;
                case 'modificar':
                    $this->modificarProducto();
                    break;
                case 'eliminar':
                    $this->eliminarProducto();
                    break;
            }
        }
    }

    public function registrarProducto()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['codBarras']) ||
            empty($_POST['cantidad']) ||
            empty($_POST['cantidadMin']) ||
            empty($_POST['precioCosto']) ||
            empty($_POST['precioVenta']) ||
            empty($_POST['marcaId']) ||
            empty($_POST['rubroId'])
        ) {
            header('Location: ../../index.php?page=alta_producto&modulo=productos?message=Por favor, completar todos los campos');
        } else {
            $producto = new Producto(null,
                $_POST['nombre'],
                $_POST['codBarras'],
                $_POST['cantidad'],
                $_POST['cantidadMin'],
                $_POST['precioCosto'],
                $_POST['precioVenta'],
                $_POST['marcaId'],
                $_POST['rubroId']
            );
            $producto->guardar();
            header('Location: ../../index.php?page=listado_producto&modulo=productos');
        }
    }

    public function modificarProducto()
    {
        if (
            empty($_POST['idProductos']) ||
            empty($_POST['nombre']) ||
            empty($_POST['codBarras']) ||
            empty($_POST['cantidad']) ||
            empty($_POST['cantidadMin']) ||
            empty($_POST['precioCosto']) ||
            empty($_POST['precioVenta']) ||
            empty($_POST['marcaId']) ||
            empty($_POST['rubroId'])
        ) {
            header('Location: ../../index.php?page=editar_producto&modulo=productos?message=Por favor, completar todos los campos');
        } else {
            $producto = new Producto(
                $_POST['idProductos'],
                $_POST['nombre'],
                $_POST['codBarras'],
                $_POST['cantidad'],
                $_POST['cantidadMin'],
                $_POST['precioCosto'],
                $_POST['precioVenta'],
                $_POST['marcaId'],
                $_POST['rubroId']
            );
            $producto->actualizar();
            header('Location: ../../index.php?page=listado_producto&modulo=productos');
        }
    }

    public function eliminarProducto()
    {
        if(!empty($_POST['idProductos'])){
            $producto = new Producto();
            $producto->setId($_POST['idProductos']);
            $producto->eliminar();
            header('Location: ../../index.php?page=listado_producto&modulo=productos');
        }
    }
}

new ProductoControlador();
