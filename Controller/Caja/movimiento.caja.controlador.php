<?php
session_start();

include_once '../../Model/Caja/movimientocaja.php';
include_once '../../config/conexion.php';



class MovimientoCajaControlador
{
    function __construct()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'guardarMovimiento':
                    $this->guardarMovimiento();
                    break;
                case 'obtenerMovimientos':
                    $movimientos = MovimientoCaja::listarMovimientosCaja();
                    echo json_encode($movimientos);
                    exit();
            }
        }
    }

    public function guardarMovimiento()
    {
        // Leer el cuerpo de la solicitud
        $json = file_get_contents('php://input');

        // Decodificar el JSON recibido
        $data = json_decode($json, true); // true para convertir en array asociativo
        //echo json_encode
        $tipoMovimiento  = $data['tipoMovimiento'];
        $monto = $data['monto'];
        $descripcion = $data['descripcion'];
        $metodoPago = $data['metodoPago'];
        if (isset($tipoMovimiento) && isset($monto) && isset($metodoPago) && isset($_SESSION['idCaja'])) {
            $movimientoCaja = new MovimientoCaja();
            $movimientoCaja->setTipoMovimiento($tipoMovimiento);
            $movimientoCaja->setMonto($monto);
            $movimientoCaja->setDescripcion($descripcion);
            $movimientoCaja->setIdmetodopago($metodoPago);
            $movimientoCaja->setIdCaja($_SESSION['idCaja']);
            $movimientoCaja->guardarMovimientoCaja();
            echo json_encode([
                'success' => true,
                'message' => 'Se registró correctamente el movimiento de caja'

            ]);
        }else{
            echo json_encode([
                'success' => false,
                'message' => 'Faltan campos por completar',
                'data' => $data
            ]);
        }

    }
}
new MovimientoCajaControlador();
