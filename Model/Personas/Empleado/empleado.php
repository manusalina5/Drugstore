<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    // Manejar error de archivo no encontrado
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

$rutaAbsolutaPersona = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/Model/Personas/persona.php';
if (file_exists($rutaAbsolutaPersona)) {
    include_once $rutaAbsolutaPersona;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsolutaPersona;
}


class Empleado extends Persona
{
    private $idEmpleado;
    private $legajo;
    private $idPersona;

    public function __construct($idEmpleado = "", $legajo = "", $idPersona = "", $nombre = "", $apellido = "")
    {
        parent::__construct($idPersona, $nombre, $apellido);
        $this->idEmpleado = $idEmpleado;
        $this->legajo = $legajo;
    }

    public function guardar()
    {
        // Se guarda la persona
        $this->idPersona = parent::guardar();

        // Se guarda el empleado
        $conexion = new Conexion;
        $query = "INSERT INTO empleado(fechaAlta, legajo,Persona_idPersona) VALUES (NOW(),'$this->legajo','$this->idPersona')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        // Se actualiza la persona
        parent::actualizar();

        // Se actualiza el empleado
        $conexion = new Conexion;
        $query = "UPDATE empleado SET legajo = '$this->legajo' WHERE idEmpleado = '$this->idEmpleado'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        // Se elimina la persona
        parent::eliminar();

        // Se elimina el empleado
        $conexion = new Conexion;
        $query = "UPDATE empleado SET estado = 0 WHERE idEmpleado = '$this->idEmpleado'";
        return $conexion->actualizar($query);
    }

    public function obtenerEmpleados()
    {
        $conexion = new Conexion;
        $query = "SELECT e.idEmpleado as idEmpleado,
                    e.fechaAlta as fechaAlta,
                    e.legajo as legajo,
                    p.idPersona as idPersona, 
                    p.nombre as nombre, 
                    p.apellido as apellido
                    FROM persona p
                    INNER JOIN empleado e ON p.idPersona = e.Persona_idPersona WHERE e.estado = 1";
        $resultado = $conexion->consultar($query);
        $empleado = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $empleado[] = $row;
            }
        }
        return $empleado;
    }

    public function obtenerEmpleadosSinUsuario()
    {
        $conexion = new Conexion;
        $query = "SELECT e.idEmpleado AS idEmpleado,
                        e.fechaAlta AS fechaAlta,
                        e.legajo AS legajo,
                        p.idPersona AS idPersona,
                        p.nombre AS nombre,
                        p.apellido AS apellido
                    FROM persona p
                    INNER JOIN empleado e ON p.idPersona = e.Persona_idPersona
                    LEFT JOIN usuario u ON u.Empleado_idEmpleado = e.idEmpleado
                    WHERE e.estado = 1
                    AND u.Empleado_idEmpleado IS NULL";
        $resultado = $conexion->consultar($query);
        $empleado = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $empleado[] = $row;
            }
        }
        return $empleado;
    }

    public function obtenerEmpleadosPorId()
    {
        $conexion = new Conexion;
        $query = "SELECT e.idEmpleado as idEmpleado,
                    e.fechaAlta as fechaAlta,
                    e.legajo as legajo,
                    p.idPersona as idPersona, 
                    p.nombre as nombre, 
                    p.apellido as apellido
                    FROM persona p
                    INNER JOIN empleado e ON p.idPersona = e.Persona_idPersona 
                    WHERE e.estado = 1 AND e.idEmpleado = '$this->idEmpleado';";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }


    public function setIdEmpleado($idEmpleado)
    {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }


    public function getLegajo()
    {
        return $this->legajo;
    }


    public function setLegajo($legajo)
    {
        $this->legajo = $legajo;

        return $this;
    }



    public function getIdPersona()
    {
        return $this->idPersona;
    }


    public function setIdPersona($idPersona)
    {
        $this->idPersona = $idPersona;

        return $this;
    }
}
