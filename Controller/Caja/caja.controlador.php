<?php
session_start();

include_once '../../Model/Caja/caja.php';
include_once '../../config/conexion.php';

// print_r($_POST);
// print_r($_SESSION);
// exit();

class CajaControlador
{
    function __construct()
    {
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'abrircaja':
                    $this->abrirCaja();
                    break;
                case 'obtenerestado':
                    $this->obtenerEstadoCaja();
                    break;
                case 'obtenerinfo':
                    $this->obtenerInfo();
                    break;
                case 'cerrarcaja':
                    $this->cerrarCaja();
                    break;
                case 'obtenerhistorial':
                    $this->historialMovimientos();
                    break;

            }
        }
    }

    public function abrirCaja()
    {

        if (isset($_POST['montoInicial']) && isset($_SESSION['idEmpleado'])) {
            $montoInicial = $_POST['montoInicial'];
            $idEmpleado = $_SESSION['idEmpleado'];
            $caja = new Caja;
            $caja->setMontoInicial($montoInicial);
            $caja->setEmpleadoId($idEmpleado);
            $_SESSION['idCaja'] = $caja->abriCaja();
            header('Location: ../../index.php?page=alta_venta&modulo=ventas');
        } else {
            header("Location: ../../index.php?status=danger&mensaje=Variables no declaras o nulas");
        }
    }

    public function cerrarCaja(){
        if (isset($_POST['montoFinal']) && isset($_SESSION['idCaja'])) {
            $montoFinal = $_POST['montoFinal'];
            $idCaja = $_SESSION['idCaja'];
            $caja = new Caja;
            $caja->setMontoFinal($montoFinal);
            $caja->setIdCaja($idCaja);
            $caja->cerrarCaja();
            header('Location: ../../index.php?page=alta_venta&modulo=ventas&status=success&mensaje=Caja cerrada correctamente');
        } else {
            header("Location: ../../index.php?status=danger&mensaje=Variables no declaras o nulas");
        }
    }

    public function obtenerEstadoCaja()
    {
        $caja = new Caja;
        $caja->setEmpleadoId($_SESSION['idEmpleado']);
        $resultado = $caja->obtenerEstadoCaja();
        echo json_encode($resultado);
        exit();
    }

    public function obtenerInfo()
    {
        $caja = new Caja;
        $caja->setEmpleadoId($_SESSION['idEmpleado']);
        $caja->setIdCaja($_SESSION['idCaja']);
        $totales = $caja->obtenerMontoFinal();
        $montoFinal = $totales[0]['total'];
        $montoFinalVenta = $totales[0]['totalVentas'];
        $resultado = $caja->obtenerInfoCaja();
        $resultado[0]['total'] = $montoFinal;
        $resultado[0]['totalVentas'] = $montoFinalVenta;
        echo json_encode($resultado);
        exit();
    }

    public function historialMovimientos(){
        $idCaja = $_GET['idCaja'];
        $movimientos = Caja::obtenerHistorialMovimientos($idCaja);
        if ($movimientos) {
            header('Content-Type: application/json');
            echo json_encode($movimientos);
        } else {
            echo json_encode([]);  // Devuelve un array vacío si no hay movimientos
        }
        exit;
    }


}

new CajaControlador;
