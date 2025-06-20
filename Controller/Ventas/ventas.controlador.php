<?php
session_start();
include_once '../../Model/Ventas/ventas.php';
include_once '../../Model/Ventas/detalleventas.php';
include_once '../../config/conexion.php';




// // Leer el cuerpo de la solicitud
// $json = file_get_contents('php://input');

// // Decodificar el JSON recibido
// $data = json_decode($json, true); // true para convertir en array asociativo

// $metodopago = $data['idmetodopago'];
// $carrito = $data['carrito'];
// echo json_encode([
//     'success' => true,
//     'message' => $metodopago,
//     'clienteId' => 1,
//     'nombreapellido' => 'Manu',
//     'carrito' => $carrito,
//     'data' => $data
// ]);


class VentasControlador
{

    public function __construct()
    {
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        if (isset($action)) {
            switch ($action) {
                case 'ventas':
                    $this->registrarVenta();
                    break;
                case 'buscar':
                    $this->listadoVentas();
                    break;
            }
        }
    }

    public function registrarVenta()
    {
        $json = file_get_contents('php://input');

        // Decodificar el JSON recibido
        $data = json_decode($json, true); // true para convertir en array asociativo

        $errores = $this->validar($data);

        if (empty($errores)) {
            $venta = $this->crearObjetoVenta($data);
            $idVenta = $venta->guardarVenta();
            foreach ($data as $clave => $valor) {
                if ($clave === 'carrito') {
                    foreach ($valor as $producto) {
                        $detalleVenta = $this->crearObjetoDetalleVenta($producto, $idVenta);
                        $detalleVenta->guardarDetalleVenta();
                    }
                }
            }


            echo json_encode(
                [
                    'success' => true,
                    'message' => 'Venta registrada correctamente'
                ]
            );
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Hay algunos campos vacios'
                ]
            );
        }
    }

    public function listadoVentas()
    {
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

        $registro_por_pagina = 10;
        $inicio = ($pagina - 1) * $registro_por_pagina;

        $ventasObj = new Venta();
        $ventas = $ventasObj->buscarVentas($busqueda, $inicio, $registro_por_pagina);
        $total_paginas = Venta::totalPaginasBusqueda($busqueda, $registro_por_pagina);

        echo json_encode([
            'ventas' => $ventas,
            'total_paginas' => $total_paginas
        ]);
        exit();
    }

    public function validarPost()
    {
        //
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

        if (empty($_SESSION['idEmpleado'])) {
            $errores[] = 'Error: idempleado vacio';
        }

        if (empty($_SESSION['idCaja'])) {
            $errores[] = 'Error: idCaja vacio';
        }

        if (empty($data['idcliente'])) {
            $errores[] = 'Error: idcliente vacio';
        }

        return $errores;
    }

    public function crearObjetoVenta(array $data)
    {
        $venta = new Venta();
        $venta->setTotalVenta($data['total']);
        $venta->setMetodoPago_idmetodoPago($data['idmetodopago']);
        $venta->setEmpleado_idEmpleado($_SESSION['idEmpleado']);
        $venta->setClientes_idClientes($data['idcliente']);
        $venta->setIdCaja($_SESSION['idCaja']);
        return $venta;
    }

    public function crearObjetoDetalleVenta(array $data, $idVenta)
    {
        $detalleVenta = new DetalleVenta();
        $detalleVenta->setPrecioActual($data['precio']);
        $detalleVenta->setIdProducto($data['idProducto']);
        $detalleVenta->setCantidad($data['cantidad']);
        $detalleVenta->setIdVenta($idVenta);
        return $detalleVenta;
    }
}
new VentasControlador();
// $this->precioActual, $this->cantidad, $idVenta, $this->idProducto