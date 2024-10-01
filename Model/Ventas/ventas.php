<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Venta{    
    
    public function registrarVenta($datosVenta){
        $conexion = new Conexion();
        $query = "INSERT INTO Venta (fechaVenta, horaVenta, totalVenta, metodoPago_idmetodoPago, Empleado_idEmpleado, Clientes_idClientes)
            ";
    }
}