<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Caja
{
    private $idCaja;
    private $fechaApertura;
    private $fechaCierre;
    private $montoInicial;
    private $montoFinal;
    private $estado;
    private $empleadoId;


    public function abriCaja()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO caja (fechaApertura,montoInicial,Empleado_idEmpleado) VALUES (NOW(),'$this->montoInicial','$this->empleadoId')";
        return $conexion->insertar($query);
    }

    public function cerrarCaja()
    {
        $conexion = new Conexion();
        $query = "UPDATE caja SET fechaCierre = NOW(),montoFinal = '$this->montoFinal', estado = -1 WHERE idCajas = $this->idCaja";
        return $conexion->actualizar($query);
    }

    public function obtenerEstadoCaja()
    {
        $conexion = new Conexion();
        $query = "SELECT estado
                    FROM caja
                    WHERE Empleado_idEmpleado = '$this->empleadoId' AND estado = 1";
        $resultado = $conexion->consultar($query);
        if ($resultado->num_rows > 0) {
            $estado = $resultado->fetch_array()[0];
        } else {
            $estado = false;
        }

        return $estado;
    }

    public function obtenerInfoCaja()
    {
        $conexion = new Conexion();
        $query = "SELECT *
                    FROM caja
                    WHERE Empleado_idEmpleado = '$this->empleadoId' AND estado = 1";
        $resultado = $conexion->consultar($query);
        $caja = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $caja[] = $row;
            }
        } else {
            $caja = false;
        }
        return $caja;
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

    public function getFechaApertura()
    {
        return $this->fechaApertura;
    }


    public function setFechaApertura($fechaApertura)
    {
        $this->fechaApertura = $fechaApertura;

        return $this;
    }


    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }


    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;

        return $this;
    }


    public function getMontoInicial()
    {
        return $this->montoInicial;
    }


    public function setMontoInicial($montoInicial)
    {
        $this->montoInicial = $montoInicial;

        return $this;
    }


    public function getMontoFinal()
    {
        return $this->montoFinal;
    }


    public function setMontoFinal($montoFinal)
    {
        $this->montoFinal = $montoFinal;

        return $this;
    }

    /**
     * Get the value of estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of empleadoId
     */
    public function getEmpleadoId()
    {
        return $this->empleadoId;
    }

    /**
     * Set the value of empleadoId
     *
     * @return  self
     */
    public function setEmpleadoId($empleadoId)
    {
        $this->empleadoId = $empleadoId;

        return $this;
    }
}
