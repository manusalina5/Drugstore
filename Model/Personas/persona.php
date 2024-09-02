<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Persona
{
    private $idPersona;
    private $nombre;
    private $apellido;

    public function __construct($idPersona="", $nombre="", $apellido="")
    {
        $this->idPersona = $idPersona;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function guardar()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO persona(nombre, apellido) VALUES ('$this->nombre','$this->apellido')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE persona SET nombre = '$this->nombre', apellido = '$this->apellido' WHERE idPersona = '$this->idPersona'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE persona SET estado = 0 WHERE idPersona = '$this->idPersona'";
        return $conexion->actualizar($query);
    }

    public function obtenerPersonas($inicio,$registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT idPersona, nombre, apellido FROM persona WHERE estado = 1 LIMIT $inicio, $registro_por_pagina ";
        $resultado = $conexion->consultar($query);
        $persona = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $persona[] = $row;
            }
        }
        return $persona;
    }

    public static function totalPaginas($registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) FROM persona WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];

        $total_paginas = ceil($total_registros / $registro_por_pagina);

        return $total_paginas;
    }

    public function obtenerPersonasPorId()
    {
        $conexion = new Conexion();
        $query = "SELECT idPersona, nombre, apellido FROM persona WHERE idPersona = '$this->idPersona'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }


    public function getId()
    {
        return $this->idPersona;
    }


    public function setId($idPersona)
    {
        $this->idPersona = $idPersona;

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

