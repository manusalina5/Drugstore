<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Persona{
    private $id = "";
    private $nombre = "";
    private $apellido = "";

    public function __construct($id,$nombre,$apellido)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO persona(nombre, apellido) VALUES ('$this->nombre','$this->apellido'";
        return $conexion->insertar($query);
    }

    public function actualizar(){
        $conexion = new Conexion();
        $query = "UPDATE persona SET nombre = '$this->nombre', apellido = '$this->apellido' WHERE idPersona = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        $conexion = new Conexion();
        $query = "UPDATE persona SET estado = 0 WHERE idPersona = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerPersonas(){
        $conexion = new Conexion();
        $query = "SELECT idPersona, nombre, apellido FROM persona WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $persona = array();
        if($resultado->num_rows > 0){
            while ($row = $resultado->fetch_assoc()){
                $persona[] = $row;
            }
        }return $persona;
    }

    public function obtenerPersonasPorId(){
        $conexion = new Conexion();
        $query = "SELECT idPersona, nombre, apellido FROM persona WHERE idPersona = '$this->id'";
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

    
    public function getNombre()
    {
        return $this->nombre;
    }

    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    
    public function getApellido()
    {
        return $this->apellido;
    }

     
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }
}