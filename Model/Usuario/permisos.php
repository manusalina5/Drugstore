<?php

require_once 'config/conexion.php';

class Permisos{
    private $idpermisos;
    private $nombre;

    public function __construct($idpermisos = '', $nombre = ''){
        $this->idpermisos = $idpermisos;
        $this->nombre = $nombre;
    }
    

}
