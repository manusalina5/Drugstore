<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else{
    echo "Error: Archivo de configuración no encontrado en: ". $rutaAbsoluta;
}

class Contacto{
    private $id;
    private $valor;
    private $tipoContacto_idtipoContacto;
    private $Persona_idPersona;


    public function __construct($id='',$valor='', $tipoContacto_idtipoContacto='', $Persona_idPersona=''){
        $this->id = $id;
        $this->valor = $valor;
        $this->tipoContacto_idtipoContacto = $tipoContacto_idtipoContacto;
        $this->Persona_idPersona = $Persona_idPersona;
    }

    public function guardar(){
        $conexion = new Conexion;
        $query = "INSERT INTO contacto(valor, tipoContacto_idtipoContacto, Persona_idPersona) 
        VALUES ('$this->id', '$this->valor','$this->tipoContacto_idtipoContacto', '$this->Persona_idPersona')";
        return $conexion->insertar($query); 
    }

    public function actualizar(){
        $conexion = new Conexion;
        $query = "UPDATE contacto 
        SET valor = '$this->valor' WHERE idcontacto = '$this->id'";
        return $conexion->actualizar($query);
    }


    public function eliminar(){
        $conexion = new Conexion;
        $query = "UPDATE contacto SET 
        estado = 0 WHERE idcontacto = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerContacto(){
        $conexion = new Conexion;
        $query = "SELECT idcontacto, valor, tipoContacto_idtipoContacto, Persona_idPersona 
        FROM contacto WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $contacto[] = $row;
        }
    }
    return $contacto;
}

public function obtenerContactoPorId(){
    $conexion = new Conexion;
    $query = "SELECT idcontacto, valor, tipoContacto_idtipoContacto, Persona_idPersona 
    FROM contacto WHERE estado = 1 AND idcontacto = '$this->id'";
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


    public function getValor()
    {
        return $this->valor;
    }


    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    public function getTipoContacto_idtipoContacto()
    {
        return $this->tipoContacto_idtipoContacto;
    }

    public function setTipoContacto_idtipoContacto($tipoContacto_idtipoContacto)
    {
        $this->tipoContacto_idtipoContacto = $tipoContacto_idtipoContacto;

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