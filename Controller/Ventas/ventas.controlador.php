<?php

include_once '../../Model/Ventas/ventas.php';
include_once '../../Model/Ventas/detalleventas.php';
include_once '../../config/conexion.php';


if (isset($_GET['action']) && $_GET['action'] == 'ventas') {
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

    $ventasControlador = new VentasControlador();
    $ventasControlador->registrarVenta();
}


class VentasControlador
{

    public function registrarVenta()
    {
        $json = file_get_contents('php://input');

        // Decodificar el JSON recibido
        $data = json_decode($json, true); // true para convertir en array asociativo

        $errores = $this->validar($data);

        if (empty($errores)) {
            $venta = $this->crearObjetoVenta($data);
            $venta->guardarVenta();

            echo json_encode(
                [
                    'success' => true,
                    'message' => 'Venta registrada correctamente'
                ]
            );
        }else{
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Hay algunos campos vacios'
                ]
            );
        }
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

        if (empty($data['idempleado'])) {
            $errores[] = 'Error: idempleado vacio';
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
        $venta->setEmpleado_idEmpleado($data['idempleado']);
        $venta->setClientes_idClientes($data['idcliente']);
        return $venta;
    }
}
