<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

$rutaAbsolutaPersona = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/Model/Personas/persona.php';
if (file_exists($rutaAbsolutaPersona)) {
    include_once $rutaAbsolutaPersona;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsolutaPersona;
}

class Proveedor extends Persona
{
    private $idProveedor;
    private $razonSocial;
    private $idPersona;

    public function __construct($idProveedor = "", $razonSocial = "", $idPersona = "", $nombre = "", $apellido = "")
    {
        parent::__construct($idPersona, $nombre, $apellido);
        $this->idProveedor = $idProveedor;
        $this->razonSocial = $razonSocial;
    }

    public function guardar()
    {
        $this->idPersona = parent::guardar();

        $conexion = new Conexion;
        $query = "INSERT INTO proveedor(razonSocial, fechaAlta,Persona_idPersona)
                    VALUES ('$this->razonSocial',NOW(),$this->idPersona)";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        parent::actualizar();

        $conexion = new Conexion;
        $query = "UPDATE proveedor SET razonSocial = '$this->razonSocial' WHERE idProveedor = '$this->idProveedor'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        parent::eliminar();

        $conexion = new Conexion;
        $query = "UPDATE proveedor SET estado = 0 WHERE idProveedor = '$this->idProveedor'";
        return $conexion->actualizar($query);
    }

    public function obtenerProveedores()
    {
        $conexion = new Conexion;
        $query = "SELECT pro.idProveedor as idProveedor,
                pro.fechaAlta as fechaAlta,
                    pro.razonSocial as razonSocial,
                    p.idPersona as idPersona, 
                    p.nombre as nombre, 
                    p.apellido as apellido
                    FROM persona p
                    INNER JOIN proveedor pro ON p.idPersona = pro.Persona_idPersona WHERE pro.estado = 1";
        $resultado = $conexion->consultar($query);
        $proveedor = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $proveedor[] = $row;
            }
        }
        return $proveedor;
    }

    public static function totalPaginas($registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) FROM proveedor WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];

        $total_paginas = ceil($total_registros / $registro_por_pagina);

        return $total_paginas;
    }

    function buscarProveedores($busqueda, $inicio, $registro_por_pagina)
{
    $conexion = new Conexion();
    $query = "SELECT pro.idProveedor, nombre, apellido, razonSocial, fechaAlta, idPersona,
                    d.valor as documento, td.valor as tipodocumento, c.valor as contacto, tc.valor as tipocontacto
                    FROM persona p
                    INNER JOIN proveedor pro ON pro.Persona_idPersona = p.idPersona
                    INNER JOIN documento d ON d.Persona_idPersona = p.idPersona
                    INNER JOIN tipodocumentos td ON td.idtipoDocumentos = d.tipoDocumentos_idtipoDocumentos
                    INNER JOIN contacto c ON c.Persona_idPersona = p.idPersona
                    INNER JOIN tipocontacto tc ON tc.idtipoContacto = c.tipoContacto_idtipoContacto 
                    WHERE pro.estado = 1 
                    AND (p.nombre LIKE '%$busqueda%' OR
                    p.apellido LIKE '%$busqueda%' OR
                    razonSocial LIKE '%$busqueda%' OR
                    fechaAlta LIKE '%$busqueda%' OR
                    d.valor LIKE '%$busqueda%' OR
                    c.valor LIKE '%$busqueda%' OR
                    td.valor LIKE '%$busqueda%' OR
                    tc.valor LIKE '%$busqueda%')
                    LIMIT $inicio, $registro_por_pagina";

    $resultado = $conexion->consultar($query);
    $proveedores = array();
    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $proveedores[] = $row;
        }
    }
    return $proveedores;
}

public static function totalPaginasBusqueda($busqueda, $registro_por_pagina)
{
    $conexion = new Conexion();
    $query = "SELECT COUNT(*)
                FROM persona p
                    INNER JOIN proveedor pro ON pro.Persona_idPersona = p.idPersona
                    INNER JOIN documento d ON d.Persona_idPersona = p.idPersona
                    INNER JOIN tipodocumentos td ON td.idtipoDocumentos = d.tipoDocumentos_idtipoDocumentos
                    INNER JOIN contacto c ON c.Persona_idPersona = p.idPersona
                    INNER JOIN tipocontacto tc ON tc.idtipoContacto = c.tipoContacto_idtipoContacto 
                    WHERE pro.estado = 1 AND (p.nombre LIKE '%$busqueda%' OR
                    p.apellido LIKE '%$busqueda%' OR
                    razonSocial LIKE '%$busqueda%' OR
                    fechaAlta LIKE '%$busqueda%' OR
                    d.valor LIKE '%$busqueda%' OR
                    c.valor LIKE '%$busqueda%' OR
                    td.valor LIKE '%$busqueda%' OR
                    tc.valor LIKE '%$busqueda%');
    $resultado = $conexion->consultar($query);
    $total_registros = $resultado->fetch_array()[0];
    $total_paginas = ceil($total_registros / $registro_por_pagina);
    return $total_paginas;
}


    public function obtenerProveedoresPorId()
    {
        $conexion = new Conexion;
        $query = "SELECT pro.idProveedor as idProveedor,
                pro.fechaAlta as fechaAlta,
                    pro.razonSocial as razonSocial,
                    p.idPersona as idPersona, 
                    p.nombre as nombre, 
                    p.apellido as apellido
                    FROM persona p
                    INNER JOIN proveedor pro ON p.idPersona = pro.Persona_idPersona 
                    WHERE pro.estado = 1 AND pro.idProveedor = '$this->idProveedor'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }


    public function getIdProveedor()
    {
        return $this->idProveedor;
    }


    public function setIdProveedor($idProveedor)
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }


    public function getRazonSocial()
    {
        return $this->razonSocial;
    }


    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

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