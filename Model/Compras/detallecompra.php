<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class DetalleCompra
{
    private $idDetalleCompra;
    private $precioActual;
    private $cantidad;
    private $idProducto;
    private $idCompra;

    public function guardarDetalleCompra()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO detallecompra(precioActual, cantidad, Producto_idProductos, Compra_idCompra)
        VALUES ($this->precioActual, $this->cantidad, $this->idProducto, $this->idCompra)";
        return $conexion->insertar($query);
    }

    public function getIddetalleCompra()
    {
        return $this->idDetalleCompra;
    }

    public function setIddetalleCompra($idDetalleCompra)
    {
        $this->idDetalleCompra = $idDetalleCompra;

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

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    public function getIdCompra()
    {
        return $this->idCompra;
    }

    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;

        return $this;
    }
}
