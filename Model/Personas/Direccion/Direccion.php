<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'].'/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: ". $rutaAbsoluta;
}

class Direccion{
    private $id;
    private $descripcion;
    private $Persona_idPersona;


    public function __construct($id='', $descripcion='', $Persona_idPersona=''){
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->Persona_idPersona = $Persona_idPersona;
    }

    public function guardar(){
        $conexion = new Conexion;
        $query = "INSERT INTO Direccion(descripcion, Persona_idPersona) 
        VALUES ('$this->descripcion','$this->Persona_idPersona')";
        return $conexion->insertar($query);
    }

    public function actualizar(){
        $conexion = new Conexion;
        $query = "UPDATE Direccion SET descripcion = '$this->descripcion' 
        WHERE Persona_idPersona = '$this->Persona_idPersona'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        $conexion = new Conexion;
        $query = "UPDATE Direccion SET estado = 0 WHERE idDireccion = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerDireccion(){
        $conexion = new Conexion;
        $query = "SELECT idDireccion, descripcion FROM Direccion WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $direccion = array();
        if ($resultado-> num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $direccion[] = $row;
            }
        }
        return $direccion;
    }

    public function obtenerDireccionPorId(){
        $conexion = new Conexion;
        $query = "SELECT d.descripcion as descripcion
                    FROM persona p
                    RIGHT JOIN direccion d ON d.Persona_idPersona = p.idPersona
                    WHERE p.estado = 1 and p.idPersona = '$this->Persona_idPersona'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function existeDireccion(){
        $conexion = new Conexion;
        $query = "SELECT * FROM direccion WHERE Persona_idPersona  = '$this->Persona_idPersona'";
        $resultado = $conexion->consultar($query);
        $num_rows = $resultado->num_rows;
        return $num_rows > 0;
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

    public function getPersona_idPersona()
    {
        return $this->Persona_idPersona;
    }


    public function setPersona_idPersona($Persona_idPersona)
    {
        $this->Persona_idPersona = $Persona_idPersona;

        return $this;
    }
}