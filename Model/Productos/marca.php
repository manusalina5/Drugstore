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
        $query = "UPDATE marca SET estado = 0 WHERE idMarca = '$this->id'";
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

    function buscarMarca($busqueda, $inicio, $registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT * FROM marca where estado = 1 AND (nombre LIKE '%$busqueda%') LIMIT $inicio, $registro_por_pagina";
        $resultado = $conexion->consultar($query);
        $marcas = array();
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $marcas[] = $row;
            }
            return $marcas;
        }
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) FROM marca WHERE estado = 1 AND (nombre LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
        return $total_paginas;
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

