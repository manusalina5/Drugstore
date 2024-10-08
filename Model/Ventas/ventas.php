<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Venta
{

    private $idVenta;
    private $totalVenta;
    private $metodoPago_idmetodoPago;
    private $empleado_idEmpleado;
    private $clientes_idClientes;

    public function __construct(
        $idVenta = "",
        $totalVenta = "",
        $metodoPago_idmetodoPago = "",
        $empleado_idEmpleado = "",
        $clientes_idClientes = ""
    ) {
        $this->idVenta = $idVenta;
        $this->totalVenta = $totalVenta;
        $this->metodoPago_idmetodoPago = $metodoPago_idmetodoPago;
        $this->empleado_idEmpleado = $empleado_idEmpleado;
        $this->clientes_idClientes = $clientes_idClientes;
    }

    public function guardarVenta()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO `mydb`.`venta`
                        (`fechaVenta`,
                        `horaVenta`,
                        `totalVenta`,
                        `metodoPago_idmetodoPago`,
                        `Empleado_idEmpleado`,
                        `Clientes_idClientes`)
                        VALUES (current_date(),
                        current_time(),
                        $this->totalVenta,
                        $this->metodoPago_idmetodoPago,
                        $this->empleado_idEmpleado,
                        $this->clientes_idClientes) 
                    ";
        return $conexion->insertar($query);

    }


    public function getIdVenta()
    {
        return $this->idVenta;
    }


    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;

        return $this;
    }


    public function getTotalVenta()
    {
        return $this->totalVenta;
    }


    public function setTotalVenta($totalVenta)
    {
        $this->totalVenta = $totalVenta;

        return $this;
    }


    public function getMetodoPago_idmetodoPago()
    {
        return $this->metodoPago_idmetodoPago;
    }

    public function setMetodoPago_idmetodoPago($metodoPago_idmetodoPago)
    {
        $this->metodoPago_idmetodoPago = $metodoPago_idmetodoPago;

        return $this;
    }

    public function getEmpleado_idEmpleado()
    {
        return $this->empleado_idEmpleado;
    }


    public function setEmpleado_idEmpleado($empleado_idEmpleado)
    {
        $this->empleado_idEmpleado = $empleado_idEmpleado;

        return $this;
    }


    public function getClientes_idClientes()
    {
        return $this->clientes_idClientes;
    }


    public function setClientes_idClientes($clientes_idClientes)
    {
        $this->clientes_idClientes = $clientes_idClientes;

        return $this;
    }
}


// idVenta, fechaVenta, horaVenta, totalVenta, estado, metodoPago_idmetodoPago, Empleado_idEmpleado, Clientes_idClientes