<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class MetodoPago{
    private $idmetodoPago;
    private $nombre;
    private $descripcion;

    public function __construct($idmetodoPago = "", $nombre = "", $descripcion = ""){
        $this->idmetodoPago = $idmetodoPago;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO metodoPago(nombre, descripcion) VALUES ('$this->nombre','$this->descripcion')";
        return $conexion->insertar($query);
    }


    public function actualizar(){
        $conexion = new Conexion();
        $query = "UPDATE metodoPago SET nombre  = '$this->nombre', descripcion = '$this->descripcion' WHERE idmetodoPago = '$this->idmetodoPago'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        $conexion = new Conexion();
        $query = "UPDATE metodoPago SET estado = 0 WHERE idmetodoPago = '$this->idmetodoPago'";
        return $conexion->actualizar($query);
    }

    public function obtenerMetodoPago(){
        $conexion = new Conexion();
        $query = "SELECT idmetodoPago, nombre, descripcion FROM metodoPago WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $metodopago = array();
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $metodopago[] = $row;
            }
        }return $metodopago;
    }

    public function obtenerMetodoPagoId(){
        $conexion = new Conexion();
        $query = "SELECT idmetodoPago, nombre, descripcion FROM metodoPago WHERE estado = 1 AND idmetodoPago = '$this->idmetodoPago'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function getIdmetodoPago()
    {
        return $this->idmetodoPago;
    }

    
    public function setIdmetodoPago($idmetodoPago)
    {
        $this->idmetodoPago = $idmetodoPago;

        return $this;
    }


    public function getNombre()
    {
        return $this->nombre;
    }

 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }


    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}

