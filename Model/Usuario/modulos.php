<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Modulos
{
    private $id;
    private $nombre;

    public function __construct($id = '', $nombre = '')
    {
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function obtenerModulosPorPerfil($idPerfiles)
    {
        $conexion = new Conexion();
        $query = "SELECT * FROM modulos INNER JOIN
perfiles_has_modulos ON perfiles_has_modulos.modulos_idmodulos = modulos.idmodulos
WHERE perfiles_has_modulos.estado = 1 AND perfiles_has_modulos.perfiles_idperfiles=" . $idPerfiles;
        return $conexion->consultar($query);
    }

    public function obtenerModulos()
    {
        $conexion = new Conexion();
        $query = "SELECT * FROM modulos WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $modulo = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $modulo[] = $row;
            }
        }
        return $modulo;
    }

    public function obtenerModulosPorId($idModulo)
    {
        $conexion = new Conexion();
        $query = "SELECT * FROM modulos WHERE idmodulos = '$idModulo'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function eliminarModulo()
    {
        $conexion = new Conexion();
        $query = "UPDATE modulos SET estado = 0 WHERE idmodulos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO modulos (nombre) VALUES ('$this->nombre')";
        return $conexion->insertar($query);
    }

    public function actualizar(){
        $conexion = new Conexion();
        $query = "UPDATE modulos SET nombre = '$this->nombre' WHERE idmodulos = '$this->id'";
        return $conexion->actualizar($query);
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
