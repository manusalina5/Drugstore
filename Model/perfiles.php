<?php

require_once ('config/conexion.php');

class Perfil{
    private $id;
    private $nombre;

    public function __construct($id, $nombre){
        $this->id = $id;
        $this->nombre = $nombre;
    }

    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO perfiles (nombre) VALUES ('$this->nombre')";
        return $conexion->insertar($query);
    }

}
