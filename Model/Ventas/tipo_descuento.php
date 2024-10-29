<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class TipoDescuento{
    private $idTipoDescuento;
    private $nombre;
    private $descripcion;

    public function guardarTipoDescuento(){
        $conexion = new Conexion();
        $query = "INSERT INTO tipodescuento(nombre, descripcion) VALUES('$this->nombre', '$this->descripcion')";
        return $conexion->insertar($query);
    }

    public function editarTipoDescuento(){
        $conexion = new Conexion();
        $query = "UPDATE tipodescuento SET nombre = '$this->nombre', descripcion = '$this->descripcion' WHERE idtipoDescuento = $this->idTipoDescuento";
        return $conexion->actualizar($query);
    }

    public function eliminarTipoDescuento(){
        $conexion = new Conexion();
        $query = "UPDATE tipodescuento SET estado = 0 WHERE idtipoDescuento = $this->idTipoDescuento";
        return $conexion->actualizar($query);
    }

    public static function listarTipoDescuento(){
        $conexion = new Conexion();
        $query = "SELECT * FROM tipodescuento WHERE estado = 1";
        $resultado  = $conexion->consultar($query);
        $tipodescuento = [];
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $tipodescuento[] = $row;
            }
            return $tipodescuento;
        }
        return $tipodescuento;
    }
    
    public function getIdTipoDescuento()
    {
        return $this->idTipoDescuento;
    }

    public function setIdTipoDescuento($idTipoDescuento)
    {
        $this->idTipoDescuento = $idTipoDescuento;

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


    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}