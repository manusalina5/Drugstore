<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}
class Perfil{
    private $idPerfiles;
    private $nombre;

    public function __construct($idPerfiles ="", $nombre=""){
        $this->idPerfiles = $idPerfiles;
        $this->nombre = $nombre;
    }

    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO perfiles (nombre) VALUES ('$this->nombre')";
        return $conexion->insertar($query);
    }

    public function actualizar(){
        $conexion = new Conexion();
        $query = "UPDATE perfiles SET nombre = '$this->nombre' WHERE idPerfiles = '$this->idPerfiles'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        $conexion = new Conexion();
        $query = "UPDATE perfiles SET estado = 0 WHERE idPerfiles = '$this->idPerfiles'";
        return $conexion->actualizar($query);
    }


    public function obtenerPerfiles() {
        $conexion = new Conexion();
        $query = "SELECT idPerfiles, nombre FROM perfiles WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $perfiles = array();
        if($resultado->num_rows>0){
            while($row = $resultado->fetch_assoc()) {
                $perfiles[] = $row;
            }
        }
        return $perfiles;
    }


    public function obtenerPerfilesPorId($idPerfil){
        $conexion = new Conexion();
        $query = "SELECT idPerfiles, nombre FROM perfiles WHERE idPerfiles = $idPerfil AND estado = 1";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

}
