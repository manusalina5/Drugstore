<?php
session_start();

include_once '../../Model/Caja/caja.php';
include_once '../../config/conexion.php';

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
            $caja->abriCaja();
            header('Location: ../../index.php?page=alta_venta&modulo=ventas');
        }else{
            echo "index.php?status=danger&mensaje=Variables no declaras o nulas";
        }
    }

    public function obtenerEstadoCaja(){
        $caja = new Caja;
        $caja->setEmpleadoId($_SESSION['idEmpleado']);
        $resultado = $caja->obtenerEstadoCaja();
        echo json_encode($resultado);
        exit();
    }

    public function obtenerInfo(){
        $caja = new Caja;
        $caja->setEmpleadoId($_SESSION['idEmpleado']);
        $resultado = $caja->obtenerInfoCaja();
        echo json_encode($resultado);
        exit();
    }
}

new CajaControlador;
