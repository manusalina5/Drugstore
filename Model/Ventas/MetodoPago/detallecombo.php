<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class detalleCombo
{
    private $idComboProductos;
    private $cantidad;
    private $idProducto;
    private $idCombo;

    public function guardarDetalleCombo(){
        $conexion = new Conexion();
        $query = "INSERT INTO comboproductos(cantidad, producto_idProductos,combos_idcombos) VALUES (
        $this->cantidad,$this->idProducto,$this->idCombo)";
        return $conexion->insertar($query);
    }


    public function getIdComboProductos()
    {
        return $this->idComboProductos;
    }


    public function setIdComboProductos($idComboProductos)
    {
        $this->idComboProductos = $idComboProductos;

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


    public function getIdCombo()
    {
        return $this->idCombo;
    }


    public function setIdCombo($idCombo)
    {
        $this->idCombo = $idCombo;

        return $this;
    }
}