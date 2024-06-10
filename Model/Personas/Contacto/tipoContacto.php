<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class TipoContacto
{
    private $id;
    private $valor;

    public function __construct($id = "", $valor = "")
    {
        $this->id = $id;
        $this->valor = $valor;
    }

    public function guardar()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO tipocontacto(valor) VALUES ('$this->valor')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE tipocontacto SET valor = '$this->valor' WHERE idtipoContacto = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE tipocontacto SET estado = 0 WHERE idtipoContacto = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerTipoContacto()
    {
        $conexion = new Conexion();
        $query = "SELECT idtipoContacto, valor FROM tipocontacto WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $tipocontacto = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $tipocontacto[] = $row;
            }
        }
        return $tipocontacto;
    }


    public function obtenerTipoContactoPorId()
    {
        $conexion = new Conexion();
        $query = "SELECT idtipoContacto, valor FROM tipocontacto WHERE idtipoContacto = '$this->id'";
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
}