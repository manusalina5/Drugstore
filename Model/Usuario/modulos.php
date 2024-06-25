<?php

require_once 'config/conexion.php';

class Modulos{
    private $id;
    private $nombre;

    public function __construct($id = '', $nombre = ''){
        $this->id = $id;
        $this->nombre = $nombre;
    }
    
    public function obtenerModulosPorPerfil($idPerfiles){
        $conexion = new Conexion();
        $query = "SELECT * FROM modulos INNER JOIN
perfiles_has_modulos ON perfiles_has_modulos.modulos_idmodulos = modulos.idmodulos
WHERE perfiles_has_modulos.perfiles_idperfiles=".$idPerfiles;
        return $conexion->consultar($query);
    }



}
