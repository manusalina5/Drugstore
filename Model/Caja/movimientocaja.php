<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class MovimientoCaja
{
    // idmovimientoCaja, tipoMovimiento, monto, descripcion, fechaHora, caja_idCajas, metodopago_idmetodoPago
    private $idmovimientoCaja;
    private $tipoMovimiento;
    private $monto;
    private $descripcion;
    private $idCaja;
    private $idMetodoPago;

    public function __construct($idmovimientoCaja = "", $tipoMovimiento = "", $monto = "", $descripcion = "", $idCaja = "", $idmetodopago = "")
    {
        $this->idmovimientoCaja = $idmovimientoCaja;
        $this->tipoMovimiento = $tipoMovimiento;
        $this->monto = $monto;
        $this->descripcion = $descripcion;
        $this->idCaja = $idCaja;
        $this->idMetodoPago = $idmetodopago;
    }

    public function guardarMovimientoCaja()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO movimientocaja(
            `tipoMovimiento`, 
            `monto`, 
            `descripcion`, 
            `fechaHora`, 
            `caja_idCajas`, 
            `metodopago_idmetodoPago`) 
            VALUES ('$this->tipoMovimiento', '$this->monto', '$this->descripcion', NOW(), $this->idCaja, $this->idMetodoPago)";
        return $conexion->insertar($query);
    }
    // tipoMovimiento, monto, descripcion, fechaHora, metodopago
    public static function listarMovimientosCaja()
    {
        $conexion = new Conexion();
        $query  = "SELECT tipoMovimiento, monto, mc.descripcion, fechaHora,mp.nombre as metodopago
                    FROM movimientocaja mc
                    INNER JOIN caja c ON c.idCajas = mc.caja_idCajas
                    INNER JOIN metodopago mp ON mp.idmetodoPago = mc.metodopago_idmetodoPago
                    WHERE mc.estado = 1;";
        $resultado = $conexion->consultar($query);
        $movimientoCaja = array();
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $movimientoCaja[] = $row;
            }
        }else{
            $movimientoCaja = false;
        }
        return $movimientoCaja;
    }


    public function getIdmovimientoCaja()
    {
        return $this->idmovimientoCaja;
    }


    public function setIdmovimientoCaja($idmovimientoCaja)
    {
        $this->idmovimientoCaja = $idmovimientoCaja;

        return $this;
    }

    public function getTipoMovimiento()
    {
        return $this->tipoMovimiento;
    }


    public function setTipoMovimiento($tipoMovimiento)
    {
        $this->tipoMovimiento = $tipoMovimiento;

        return $this;
    }

    public function getMonto()
    {
        return $this->monto;
    }


    public function setMonto($monto)
    {
        $this->monto = $monto;

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

    public function getIdCaja()
    {
        return $this->idCaja;
    }

    public function setIdCaja($idCaja)
    {
        $this->idCaja = $idCaja;

        return $this;
    }

    public function getIdmetodopago()
    {
        return $this->idMetodoPago;
    }


    public function setIdmetodopago($idmetodopago)
    {
        $this->idMetodoPago = $idmetodopago;

        return $this;
    }
}
