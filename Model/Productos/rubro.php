<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Rubro
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
        $query = "INSERT INTO Rubro(nombre) VALUES ('$this->nombre')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE Rubro SET nombre = '$this->nombre' WHERE idRubros = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerRubros()
    {
        $conexion = new Conexion();
        $query = "SELECT idRubros, nombre FROM rubro WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $rubros = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rubros[] = $row;
            }
        }else{
            $rubros = false;
        }
        return $rubros;
    }

    public function obtenerRubrosPorId()
    {
        $conexion = new Conexion();
        $query = "SELECT idRubros, nombre FROM rubro WHERE idRubros = '$this->id'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    function buscarRubro($busqueda, $inicio, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT * FROM rubro WHERE estado = 1 AND (nombre LIKE '%$busqueda%') LIMIT $inicio, $registro_por_pagina";
        $resultado = $conexion->consultar($query);
        $rubros = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $rubros[] = $row;
            }
            return $rubros;
        }
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) FROM rubro WHERE estado = 1 AND (nombre LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
        return $total_paginas;
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE Rubro SET estado = 0 WHERE idRubros = '$this->id'";
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
