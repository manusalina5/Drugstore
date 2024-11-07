<?php
session_start();
include_once '../../Model/Compras/compras.php';
include_once '../../Model/Compras/detallecompra.php';
include_once '../../Model/Productos/producto.php';

class CompraControlador{

    public function __construct()
    {
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        if (isset($action)) {
            switch ($action) {
                case 'compras':
                    $this->registrarCompra();
                    break;
                case 'buscar':
                    $this->listadoCompras();
                    break;
            }
        }
    }
    public function registrarCompra(){
        $json = file_get_contents('php://input');

        // Decodificar el JSON recibido
        $data = json_decode($json, true); 
        $data['idempleado'] = $_SESSION['idEmpleado'];
        $errores = $this->validar($data);

        if (empty($errores)) {
            $compra = $this->crearObjetoCompra($data);
            $idCompra = $compra->guardarCompra();
            foreach ($data as $clave => $valor) {
                if ($clave === 'carrito') {
                    foreach ($valor as $producto) {
                        $detalleCompra = $this->crearObjetoDetalleCompra($producto, $idCompra);
                        $detalleCompra->guardarDetalleCompra();
                    }
                }
            }


            echo json_encode(
                [
                    'success' => true,
                    'message' => 'Compra registrada correctamente'
                ]
            );
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Hay algunos campos vacios',
                    'data' => $data
                ]
            );
        }
    }

    public function listadoCompras(){
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

        $registro_por_pagina = 10;
        $inicio = ($pagina - 1) * $registro_por_pagina;

        $compraObj = new Compra();
        $compras = $compraObj->buscarCompras($busqueda, $inicio, $registro_por_pagina);
        $total_paginas = Compra::totalPaginasBusqueda($busqueda, $registro_por_pagina);

        echo json_encode([
            'compras' => $compras,
            'total_paginas' => $total_paginas
        ]);
        exit();
    }

    public function validar($data)
    {
        $errores = array();

        if (empty($data['carrito'])) {
            $errores[] = 'Error: Carrito vacio';
        }

        if (empty($data['total'])) {
            $errores[] = 'Error: total vacio';
        }

        if (empty($data['idmetodopago'])) {
            $errores[] = 'Error: idmetodopago vacio';
        }

        if (empty($data['idempleado'])) {
            $errores[] = 'Error: idempleado vacio';
        }

        if (empty($data['idProveedor'])) {
            $errores[] = 'Error: idProveedor vacio';
        }

        return $errores;
    }

    public function crearObjetoCompra($data){
        $compra = new Compra();
        $compra->setTotalcompra($data['total']);
        $compra->setMetodoPago_idmetodoPago( $data['idmetodopago'] );
        $compra->setEmpleadoId($data['idempleado']);
        $compra->setProveedorId($data['idProveedor']);
        return $compra;
    }

    public function crearObjetoDetalleCompra($data, $idCompra){
        $detalleCompra = new DetalleCompra();
        $actualizarProducto = new Producto();
        if($data['precio'] !== $data['precioNuevo']){
            $actualizarProducto->actualizarCostoRecalcularPrecio($data['precioNuevo'],$data['idProducto']);
            $detalleCompra->setPrecioActual($data['precioNuevo']);
        }else{
            $detalleCompra->setPrecioActual($data['precio']);
        }
        $actualizarProducto->actualizarCantidad('compra', $data['cantidad'],$data['idProducto']);
        
        $detalleCompra->setIdProducto($data['idProducto']);
        $detalleCompra->setCantidad($data['cantidad']);
        $detalleCompra->setIdCompra($idCompra);
        return $detalleCompra;
    }


}

new CompraControlador();