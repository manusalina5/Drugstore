<?php


include_once '../../Model/Productos/producto.php';
include_once '../../config/conexion.php';

class ProductoControlador
{
    public function __construct()
    {
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        if ($action) {
            switch ($action) {
                case 'registro':
                    $this->registrarProducto();
                    break;
                case 'modificar':
                    $this->modificarProducto();
                    break;
                case 'eliminar':
                    $this->eliminarProducto();
                    break;
                case 'buscar':
                    $this->listadoProductos();
                    break;
                case 'buscarventa':
                    $this->listadoProductosVenta();
                    break;
                case 'buscarcodBarras':
                    $this->buscarProductoPorCodBarras();
                    break;
            }
        }
    }

    private function validarDatos(array $datos)
    {
        $errores = array();

        if (empty($datos['nombre'])) {
            $errores['nombre'] = 'El nombre del producto es obligatorio';
        }

        if (empty($datos['codBarras'])) {
            $errores['codBarras'] = 'El código de barras es obligatorio';
        }

        if (!preg_match('/^[a-zA-Z0-9\s]+$/', $datos['nombre'])) {
            $errores['nombre'] = 'El nombre solo puede contener letras, números y espacios';
        }

        if (!preg_match('/^[0-9]+$/', $datos['codBarras'])) {
            $errores['codBarras'] = 'El código de barras debe ser numérico';
        }

        if (!is_numeric($datos['cantidad']) || $datos['cantidad'] < 0) {
            $errores['cantidad'] = 'La cantidad debe ser un número positivo';
        }

        if (!is_numeric($datos['precioCosto']) || $datos['precioCosto'] < 0) {
            $errores['precioCosto'] = 'El precio de costo debe ser un número positivo';
        }


        return $errores;
    }

    public function crearObjetoProducto(array $datos)
    {
        $producto = new Producto();
        $producto->setNombre($datos['nombre']);
        $producto->setCodBarras($datos['codBarras']);
        $producto->setCantidad($datos['cantidad']);
        $producto->setCantidadMin($datos['cantidadMin']);
        $producto->setPrecioCosto($datos['precioCosto']);
        $producto->setPrecioVenta($datos['precioVenta']);
        $producto->setMarcaId($datos['marcaId']);
        $producto->setRubroId($datos['rubroId']);

        return $producto;
    }

    public function registrarProducto()
    {
        try {
            // Obtener los datos del formulario
            $datos = $_POST;

            // Validar los datos ingresados
            $errores = $this->validarDatos($datos);

            // Si hay errores, redirigir de nuevo al formulario y mostrar los errores
            if (!empty($errores)) {
                setcookie('errores', serialize($errores), time() + 3600, '/');
                header('Location: ../../index.php?page=alta_producto&modulo=productos&status=danger');
                exit();
            }

            // Si no hay errores, crear el producto y guardarlo
            $producto = $this->crearObjetoProducto($datos);
            $producto->guardar();

            // Redirigir al listado de productos con un mensaje de éxito
            setcookie('mensaje', 'El producto se ha guardado correctamente', time() + 3600, '/');
            header('Location: ../../index.php?page=listado_producto&modulo=productos&status=success');
            exit();
        } catch (Exception $e) {
            // Si ocurre una excepción, capturarla y redirigir con un mensaje de error
            setcookie('errores', 'Ocurrió un error al guardar el producto: ' . $e->getMessage(), time() + 3600, '/');
            header('Location: ../../index.php?page=alta_producto&modulo=productos&status=danger');
            exit();
        }
    }


    public function modificarProducto()
    {
        try {
            $datos = $_POST;

            $errores = $this->validarDatos($datos);

            if (!empty($errores)) {
                setcookie('errores', serialize($errores), time() + 3600, '/');
                header('Location: ../../index.php?page=editar_producto&modulo=productos&idProductos=' . $_POST['idProductos'] . '&status=danger');
                exit();
            }

            $producto = $this->crearObjetoProducto($datos);
            $producto->actualizar();
            setcookie('mensaje', 'El producto se ha modificado correctamente', time() + 3600, '/');
            header('Location: ../../index.php?page=listado_producto&modulo=productos&status=success');
            exit();
        } catch (\Exception $e) {
            setcookie('errores', 'Ocurrió un error al guardar el producto: ' . $e->getMessage(), time() + 3600, '/');
            header('Location: ../../index.php?page=editar_producto&modulo=productos&idProductos=' . $_POST['idProductos'] . '&status=danger');
            exit();
        }
    }

    public function eliminarProducto()
    {
        if (!empty($_POST['idProductos'])) {
            $producto = new Producto();
            $producto->setId($_POST['idProductos']);
            $producto->eliminar();
            header('Location: ../../index.php?page=listado_producto&modulo=productos');
            exit();
        }
    }


    public function listadoProductos()
    {
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

        $registro_por_pagina = 10;
        $inicio = ($pagina - 1) * $registro_por_pagina;

        $productoObj = new Producto();
        $productos = $productoObj->buscarProductos($busqueda, $inicio, $registro_por_pagina);
        $total_paginas = Producto::totalPaginasBusqueda($busqueda, $registro_por_pagina);

        echo json_encode([
            'productos' => $productos,
            'total_paginas' => $total_paginas
        ]);
        exit();
    }

    public function listadoProductosVenta()
    {
        if (isset($_GET['q'])) {
            $query = $_GET['q'];

            $productoModel = new Producto();
            $productos = $productoModel->obtenerProductos($query);

            // Devolver los resultados en formato JSON
            echo json_encode($productos);
        }
        exit();
    }

    public function buscarProductoPorCodBarras(){
        if(isset($_GET['codBarras'])){
            $codBarras = $_GET['codBarras'];

            $productoModel = new Producto();
            $producto = $productoModel->obtenerProductoPorCodBarras($codBarras);

            if(isset($producto)){
                echo json_encode($producto);
            }else{
                echo json_encode(false);
            }
        }
        exit();
    }
}
new ProductoControlador();
