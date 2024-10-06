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

class Cliente extends Persona
{
    private $idCliente;
    private $observaciones;
    private $idPersona;

    public function __construct($idCliente = "", $observaciones = "", $idPersona = "", $nombre = "", $apellido = "")
    {
        parent::__construct($idPersona, $nombre, $apellido);
        $this->idCliente = $idCliente;
        $this->observaciones = $observaciones;
    }

    public function guardar()
    {
        $this->idPersona = parent::guardar();

        $conexion = new Conexion;
        $query = "INSERT INTO clientes(fechaAlta, observaciones,Persona_idPersona) VALUES (NOW(),'$this->observaciones','$this->idPersona')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        parent::actualizar();

        $conexion = new Conexion;
        $query = "UPDATE clientes SET observaciones = '$this->observaciones' WHERE idClientes = '$this->idCliente'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        parent::eliminar();

        $conexion = new Conexion;
        $query = "UPDATE clientes SET estado = 0 WHERE idClientes = '$this->idCliente'";
        return $conexion->actualizar($query);
    }

    public function obtenerClientes($busqueda)
    {
        $conexion = new Conexion();
        $query = "SELECT cli.idClientes AS idClientes,
                    cli.fechaAlta AS fechaAlta,
                    cli.observaciones AS observaciones,
                    p.idPersona AS idPersona, 
                    p.nombre AS nombre, 
                    p.apellido AS apellido,
                    d.valor AS documento,
                    td.valor AS tipodocumento,
                    c.valor AS contacto,
                    tc.valor AS tipocontacto
                    FROM persona p
                    INNER JOIN clientes cli ON p.idPersona = cli.Persona_idPersona
                    INNER JOIN contacto c ON c.Persona_idPersona = p.idPersona
                    INNER JOIN tipocontacto tc ON tc.idtipoContacto = c.tipoContacto_idtipoContacto
                    INNER JOIN documento d ON d.Persona_idPersona = p.idPersona
                    INNER JOIN tipodocumentos td ON td.idtipoDocumentos = d.tipoDocumentos_idtipoDocumentos
                    WHERE cli.estado = 1 AND (p.nombre LIKE '%$busqueda%' OR
                    p.apellido LIKE '%$busqueda%' OR 
                    cli.observaciones LIKE '%$busqueda%' OR
                    cli.fechaAlta LIKE '%$busqueda%' OR
                    d.valor LIKE '%$busqueda%' OR
                    c.valor LIKE '%$busqueda%' OR
                    tc.valor LIKE '%$busqueda%' OR
                    td.valor LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $clientes = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $clientes[] = $row;
            }
            return $clientes;
        }
    }

    public function buscarClientes($busqueda, $inicio, $registro_por_pagina)
    {

        $conexion = new Conexion();
        $query = "SELECT cli.idClientes AS idClientes,
                    cli.fechaAlta AS fechaAlta,
                    cli.observaciones AS observaciones,
                    p.idPersona AS idPersona, 
                    p.nombre AS nombre, 
                    p.apellido AS apellido,
                    d.valor AS documento,
                    td.valor AS tipodocumento,
                    c.valor AS contacto,
                    tc.valor AS tipocontacto
                    FROM persona p
                    INNER JOIN clientes cli ON p.idPersona = cli.Persona_idPersona
                    INNER JOIN contacto c ON c.Persona_idPersona = p.idPersona
                    INNER JOIN tipocontacto tc ON tc.idtipoContacto = c.tipoContacto_idtipoContacto
                    INNER JOIN documento d ON d.Persona_idPersona = p.idPersona
                    INNER JOIN tipodocumentos td ON td.idtipoDocumentos = d.tipoDocumentos_idtipoDocumentos
                    WHERE cli.estado = 1
                    AND p.estado = 1
                    AND (p.nombre LIKE '%$busqueda%' OR
                    p.apellido LIKE '%$busqueda%' OR 
                    cli.observaciones LIKE '%$busqueda%' OR
                    cli.fechaAlta LIKE '%$busqueda%' OR
                    d.valor LIKE '%$busqueda%' OR
                    c.valor LIKE '%$busqueda%' OR
                    tc.valor LIKE '%$busqueda%' OR
                    td.valor LIKE '%$busqueda%')
                LIMIT $inicio, $registro_por_pagina
";
        $resultado = $conexion->consultar($query);
        $clientes = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $clientes[] = $row;
            }
            return $clientes;
        }
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT count(*)
                    FROM persona p
                    INNER JOIN clientes cli ON p.idPersona = cli.Persona_idPersona
                    INNER JOIN contacto c ON c.Persona_idPersona = p.idPersona
                    INNER JOIN tipocontacto tc ON tc.idtipoContacto = c.tipoContacto_idtipoContacto
                    INNER JOIN documento d ON d.Persona_idPersona = p.idPersona
                    INNER JOIN tipodocumentos td ON td.idtipoDocumentos = d.tipoDocumentos_idtipoDocumentos
                    WHERE cli.estado = 1 
                    AND (p.nombre LIKE '%$busqueda%' OR
                    p.apellido LIKE '%$busqueda%' OR 
                    cli.observaciones LIKE '%$busqueda%' OR
                    cli.fechaAlta LIKE '%$busqueda%' OR
                    d.valor LIKE '%$busqueda%' OR
                    c.valor LIKE '%$busqueda%' OR
                    tc.valor LIKE '%$busqueda%' OR
                    td.valor LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
        return $total_paginas;
    }

    public function obtenerClientesPorId()
    {
        $conexion = new Conexion;
        $query = "SELECT cli.idClientes as idClientes,
                    cli.fechaAlta as fechaAlta,
                    cli.observaciones as observaciones,
                    p.idPersona as idPersona, 
                    p.nombre as nombre, 
                    p.apellido as apellido
                    FROM persona p
                    INNER JOIN clientes cli ON p.idPersona = cli.Persona_idPersona 
                    WHERE cli.estado = 1
                    AND cli.idClientes = '$this->idCliente'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function getIdCliente()
    {
        return $this->idCliente;
    }


    public function setIdCliente($idCliente)
    {
        $this->idCliente = $idCliente;

        return $this;
    }


    public function getObservaciones()
    {
        return $this->observaciones;
    }


    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

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
