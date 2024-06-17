<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . "/Drugstore/config/conexion.php";

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class TipoEgreso 
{
    private $id;
    private $descripcion;

    public function __construct($id = "", $descripcion = ""){
        $this->id = $id;
        $this->descripcion = $descripcion;
    }


    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO tipoegresos(descripcion)
        VALUES ('$this->descripcion')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE tipoegresos SET descripcion = '$this->descripcion' WHERE idtipoEgresos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE tipoegresos SET estado = 0 WHERE idtipoEgresos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerTipoEgreso()
    {
        $conexion = new Conexion();
        $query = "SELECT idtipoEgresos, descripcion FROM tipoegresos WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $tipoegreso = array();
        if ($resultado->num_rows > 0){
            while ($row = $resultado->fetch_assoc()){
                $tipoegreso[] = $row;
            }
        }
        return $tipoegreso;
    }
    

    public function obtenerTipoEgresoPorId(){
        $conexion = new Conexion();
        $query = "SELECT idtipoEgresos, descripcion FROM tipoegresos WHERE idtipoEgresos = '$this->id'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

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