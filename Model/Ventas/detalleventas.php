<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class DetalleVenta
{
    private $idDetalle_Venta;
    private $precioActual;
    private $cantidad;
    private $idVenta;
    private $idProducto;

    public function guardarDetalleVenta()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO detalle_venta (precioActual, cantidad, Venta_idVenta, Producto_idProductos) VALUES ($this->precioActual, $this->cantidad, $this->idVenta, $this->idProducto)";
        return $conexion->insertar($query);
    }

    public function getIdDetalle_Venta()
    {
        return $this->idDetalle_Venta;
    }

    public function setIdDetalle_Venta($idDetalle_Venta)
    {
        $this->idDetalle_Venta = $idDetalle_Venta;

        return $this;
    }

    public function getPrecioActual()
    {
        return $this->precioActual;
    }


    public function setPrecioActual($precioActual)
    {
        $this->precioActual = $precioActual;

        return $this;
    }


    public function getCantidad()
    {
        return $this->cantidad;
    }


    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
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


    public function getIdProducto()
    {
        return $this->idProducto;
    }


    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }
}

// idDetalle_Venta, precioActual, cantidad, Venta_idVenta, Producto_idProductos, estado