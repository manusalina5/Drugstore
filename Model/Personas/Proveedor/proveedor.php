<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

$rutaAbsolutaPersona = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/Model/Personas/persona.php';
if (file_exists($rutaAbsolutaPersona)) {
    include_once $rutaAbsolutaPersona;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsolutaPersona;
}

class Proveedor extends Persona
{
    private $idProveedor;
    private $razonSocial;
    private $idPersona;

    public function __construct($idProveedor = "", $razonSocial = "", $idPersona = "", $nombre = "", $apellido = "")
    {
        parent::__construct($idPersona, $nombre, $apellido);
        $this->idProveedor = $idProveedor;
        $this->razonSocial = $razonSocial;
    }

    public function guardar()
    {
        $this->idPersona = parent::guardar();

        $conexion = new Conexion;
        $query = "INSERT INTO proveedor(razonSocial, fechaAlta,Persona_idPersona)
                    VALUES ('$this->razonSocial',NOW(),$this->idPersona)";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        parent::actualizar();

        $conexion = new Conexion;
        $query = "UPDATE proveedor SET razonSocial = '$this->razonSocial' WHERE idProveedor = '$this->idProveedor'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        parent:: eliminar();

        $conexion = new Conexion;
        $query = "UPDATE proveedor SET estado = 0 idProveedor = '$this->idProveedor'";
        return $conexion->actualizar($query);
    }

    public function obtenerProveedores()
    {
        $conexion = new Conexion;
        $query = "SELECT pro.idProveedor as idProveedor,
                pro.fechaAlta as fechaAlta,
                    pro.razonSocial as razonSocial,
                    p.idPersona as idPersona, 
                    p.nombre as nombre, 
                    p.apellido as apellido
                    FROM persona p
                    INNER JOIN proveedor pro ON p.idPersona = pro.Persona_idPersona WHERE pro.estado = 1";
        $resultado = $conexion->consultar($query);
        $proveedor = array();
        if($resultado->num_rows>0){
            while($row = $resultado->fetch_assoc()) {
                $proveedor[] = $row;
        }
    }
    return $proveedor;
}

    public function obtenerProveedoresPorId(){
        $conexion = new Conexion;
        $query = "SELECT pro.idProveedor as idProveedor,
                pro.fechaAlta as fechaAlta,
                    pro.razonSocial as razonSocial,
                    p.idPersona as idPersona, 
                    p.nombre as nombre, 
                    p.apellido as apellido
                    FROM persona p
                    INNER JOIN proveedor pro ON p.idPersona = pro.Persona_idPersona 
                    WHERE pro.estado = 1 AND pro.idProveedor = '$this->idProveedor'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }


    public function getIdProveedor()
    {
        return $this->idProveedor;
    }


    public function setIdProveedor($idProveedor)
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }


    public function getRazonSocial()
    {
        return $this->razonSocial;
    }


    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }


    public function getIdPersona()
    {
        return $this->idPersona;
    }


    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;

        return $this;
    }
}