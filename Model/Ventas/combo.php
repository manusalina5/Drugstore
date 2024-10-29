<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

//idcombos, nombre, valorDescuento, descripcion, estado, tipoDescuento_idtipoDescuento, fechaVencimiento
class Combo
{
    private $idCombo;
    private $nombreCombo;
    private $valorDescuento;
    private $descripcion;
    private $idTipoDescuento;
    private $fechaVencimiento;

    public function guardarCombo()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO combos(nombre, valorDescuento, descripcion, tipoDescuento_idtipoDescuento, fechaVencimiento) 
                    VALUES('$this->nombreCombo','$this->valorDescuento','$this->descripcion',$this->idTipoDescuento,'$this->fechaVencimiento')";
        return $conexion->insertar($query);
    }

    public function editarCombo()
    {
        $conexion = new Conexion();
        $query = "UPDATE combos SET nombre = '$this->nombreCombo', valorDescuento = '$this->valorDescuento',descripcion = '$this->descripcion',
                        tipoDescuento_idtipoDescuento = '$this->idTipoDescuento',fechaVencimiento = '$this->fechaVencimiento' 
                        WHERE idcombos = $this->idCombo";
        return $conexion->actualizar($query);
    }

    public function eliminarCombo()
    {
        $conexion = new Conexion();
        $query = "UPDATE combos SET estado = 0 WHERE idcombos = $this->idCombo";
        return $conexion->actualizar($query);
    }

    public static function listarCombo(){
        $conexion = new Conexion();
        $query = "SELECT * FROM combos WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $combo = array();
        if($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                $combo[] = $row;
            }
            return $combo;
        }
        return $combo;
    }

    public function setIdCombo($id) {
        $this->idCombo = $id;
    }

    public function setNombreCombo($nombre) {
        $this->nombreCombo = $nombre;
    }

    public function setValorDescuento($valor) {
        $this->valorDescuento = $valor;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setIdTipoDescuento($idTipo) {
        $this->idTipoDescuento = $idTipo;
    }

    public function setFechaVencimiento($fecha) {
        $this->fechaVencimiento = $fecha;
    }

}