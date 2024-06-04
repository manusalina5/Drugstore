<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class Marca
{
    private $id;
    private $nombre;

    public function __construct($id = '', $nombre = '')
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }


    public function guardar()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO marca(nombre) VALUES ('$this->nombre')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE marca SET nombre = '$this->nombre' WHERE idMarca = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE marca SET estado = 0 WHERE id = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerMarcas()
    {
        $conexion = new Conexion();
        $query = "SELECT idmarca, nombre FROM marca WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $marcas = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $marcas[] = $row;
            }
        }
        return $marcas;
    }

    public function obtenerMarcaPorId() {
        $conexion = new Conexion();
        $query = "SELECT idmarca, nombre FROM marca WHERE idmarca = '$this->id'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function eliminarMarca() {
        $conexion = new Conexion();
        $query = "UPDATE marca SET estado = 0 WHERE idmarca = '$this->id'";
        $resultado = $conexion->actualizar($query);
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
}

