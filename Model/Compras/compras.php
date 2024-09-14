<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Compra{
    private $idcompra;
    private $fechacompra;
    private $horacompra;
    private $totalcompra;

    public function __construct
    ($idcompra = "", 
    $fechacompra = "", 
    $horacompra = "",
    $totalcompra = "")
    {
        $this->idcompra = $idcompra;
        $this->fechacompra = $fechacompra;
        $this->horacompra = $horacompra;
        $this->totalcompra = $totalcompra;
    }

    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO Compra(fechaCompra, horaCompra, totalCompra)
        VALUES ('$this->fechacompra','$this->horacompra','$this->totalcompra')";
        return $conexion->insertar($query);
    }

    public function actualizar(){
        $conexion = new Conexion();
        $query = "UPDATE Compra 
        SET nombre = '$this->fechacompra', '$this->horacompra', '$this->totalcompra'
        WHERE idCompra = '$this->idcompra'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        $conexion = new Conexion();
        $query = "UPDATE Compra SET estado = 0 WHERE idCompra = '$this->idcompra'";
        return $conexion->actualizar($query);
    }

    public function obtenerCompra(){
        $conexion = new Conexion();
        $query = "SELECT idCompra, fechaCompra, horaCompra, totalCompra
        FROM Compra WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $compra = array();
        if ($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $compra[] = $row;
            }
        } return $compra;
    }


    public function obtenerCompraId(){
        $conexion = new Conexion();
        $query = "SELECT idCompra, fechaCompra, horaCompra, totalCompra
        FROM Compra WHERE estado = 1 AND idCompra = '$this->idcompra'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
        }

    public function getIdcompra()
    {
        return $this->idcompra;
    }

    public function setIdcompra($idcompra)
    {
        $this->idcompra = $idcompra;

        return $this;
    }

    public function getFechacompra()
    {
        return $this->fechacompra;
    }

    public function setFechacompra($fechacompra)
    {
        $this->fechacompra = $fechacompra;

        return $this;
    }

    public function getHoracompra()
    {
        return $this->horacompra;
    }

    public function setHoracompra($horacompra)
    {
        $this->horacompra = $horacompra;

        return $this;
    }

    public function getTotalcompra()
    {
        return $this->totalcompra;
    }

    public function setTotalcompra($totalcompra)
    {
        $this->totalcompra = $totalcompra;

        return $this;
    }
}