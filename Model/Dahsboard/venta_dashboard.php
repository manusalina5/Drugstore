<?php


$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class VentaModel
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new Conexion();
    }

    public function count()
    {
        $query = "SELECT COUNT(*) AS total FROM venta";
        $resultado = $this->conexion->consultar($query);
        if ($resultado && $fila = $resultado->fetch_assoc()) {
            return $fila['total'];
        }
        return 0;
    }
}