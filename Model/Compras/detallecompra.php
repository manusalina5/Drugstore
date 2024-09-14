<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class DetalleCompra{
    private $iddetallecompra;
    private $precioactual;
    private $cantidad;
    private $producto_idproducto;
    private $compra_idcompra;

    public function __construct
    ($iddetallecompra = "",
    $precioactual = "",
    $cantidad = "",
    $producto_idproducto = "",
    $compra_idcompra = "")
    {
        $this->iddetallecompra = $iddetallecompra;
        $this->precioactual = $precioactual;
        $this->cantidad = $cantidad;
        $this->producto_idproducto;
        $this->compra_idcompra;
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
}