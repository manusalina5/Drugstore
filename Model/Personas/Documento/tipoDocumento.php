<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class TipoDocumento
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
        $query = "INSERT INTO tipodocumentos(valor) VALUES ('$this->valor')";
        return $conexion->insertar($query);
    }

    public function actualizar(){
        $conexion = new Conexion();
        $query = "UPDATE tipodocumentos SET valor = '$this->valor' WHERE idtipodocumentos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        $conexion = new Conexion();
        $query = "UPDATE tipodocumentos SET estado = 0 WHERE idtipodocumentos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerTipoDocumentos(){
        $conexion = new Conexion();
        $query = "SELECT idtipoDocumentos, valor FROM tipodocumentos WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $tipodocumentos = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()){
                $tipodocumentos[] = $row;
            }
        }
        return $tipodocumentos;
    }
    

    public function obtenerTipoDocumentosPorId(){
        $conexion = new Conexion();
        $query = "SELECT idtipodocumentos, valor FROM tipodocumentos WHERE idtipodocumentos = '$this->id'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function buscarTipoDocumentos($busqueda, $inicio, $paginas){
        $conexion = new Conexion();
        $query = "SELECT * FROM tipodocumentos WHERE estado = 1 AND (valor LIKE '%$busqueda%') LIMIT $inicio, $paginas";
        $resultado = $conexion->consultar($query);
        $tipoDocumentos = array();
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()) {
                $tipoDocumentos[] = $row;
            }
            return $tipoDocumentos;
        }
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_paginas){
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) FROM tipodocumentos WHERE estado = 1 AND (valor LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_paginas);
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
