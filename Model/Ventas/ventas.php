<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Venta
{

    private $idVenta;
    private $totalVenta;
    private $metodoPago_idmetodoPago;
    private $empleado_idEmpleado;
    private $clientes_idClientes;
    private $idCaja;

    public function __construct(
        $idVenta = "",
        $totalVenta = "",
        $metodoPago_idmetodoPago = "",
        $empleado_idEmpleado = "",
        $clientes_idClientes = ""
    ) {
        $this->idVenta = $idVenta;
        $this->totalVenta = $totalVenta;
        $this->metodoPago_idmetodoPago = $metodoPago_idmetodoPago;
        $this->empleado_idEmpleado = $empleado_idEmpleado;
        $this->clientes_idClientes = $clientes_idClientes;
    }

    public function guardarVenta()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO `mydb`.`venta`
                        (`fechaVenta`,
                        `horaVenta`,
                        `totalVenta`,
                        `metodoPago_idmetodoPago`,
                        `Empleado_idEmpleado`,
                        `Clientes_idClientes`,
                        `caja_idCajas`)
                        VALUES (current_date(),
                        current_time(),
                        $this->totalVenta,
                        $this->metodoPago_idmetodoPago,
                        $this->empleado_idEmpleado,
                        $this->clientes_idClientes,
                        $this->idCaja)
                    ";
        return $conexion->insertar($query);
    }

    public function buscarVentas($busqueda, $inicio, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT v.idVenta,v.fechaVenta, 
                horaVenta, 
                totalVenta, 
                mp.nombre AS metodoPago, 
                CONCAT(p.nombre, ' ', p.apellido) AS Empleado, 
                CONCAT(pc.nombre, ' ', pc.apellido) AS Cliente
            FROM venta v
            INNER JOIN metodopago mp ON mp.idmetodoPago = v.metodoPago_idmetodoPago
            INNER JOIN empleado e ON e.idEmpleado = v.Empleado_idEmpleado 
            INNER JOIN persona p ON p.idPersona = e.Persona_idPersona
            INNER JOIN clientes c ON c.idClientes = v.Clientes_idClientes
            INNER JOIN persona pc ON c.Persona_idPersona = pc.idPersona
            WHERE v.estado = 1 AND (
            v.fechaVenta LIKE '%$busqueda%' OR 
            v.horaVenta LIKE '%$busqueda%' OR
            mp.nombre LIKE '%$busqueda%' OR
            p.nombre LIKE '%$busqueda%' OR 
            pc.nombre LIKE '%$busqueda%')
            LIMIT $inicio, $registro_por_pagina";
        $resultado = $conexion->consultar($query);
        $ventas = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $ventas[] = $row;
            }
            return $ventas;
        }
    }

    public static function totalPaginas($registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT COUNT(*), FROM ventas WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];

        $total_paginas = ceil($total_registros / $registro_por_pagina);

        return $total_paginas;
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT COUNT(*)
            FROM venta v
            INNER JOIN metodopago mp ON mp.idmetodoPago = v.metodoPago_idmetodoPago
            INNER JOIN empleado e ON e.idEmpleado = v.Empleado_idEmpleado 
            INNER JOIN persona p ON p.idPersona = e.Persona_idPersona
            INNER JOIN clientes c ON c.idClientes = v.Clientes_idClientes
            INNER JOIN persona pc ON c.Persona_idPersona = pc.idPersona
            WHERE v.estado = 1 AND
            v.fechaVenta LIKE '%$busqueda%' OR 
            v.horaVenta LIKE '%$busqueda%' OR
            mp.nombre LIKE '%$busqueda%' OR
            p.nombre LIKE '%$busqueda%' OR 
            pc.nombre LIKE '%$busqueda%';";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
        return $total_paginas;
    }

    // public function listarVentas()
    // {
    //     $conexion = new Conexion();
    //     $query = "SELECT v.fechaVenta, horaVenta, totalVenta,mp.nombre 
    //     AS metodoPago, 
    //     CONCAT(p.nombre, ' ', p.apellido) AS Empleado, 
    //     CONCAT(pc.nombre, ' ', pc.apellido) AS Cliente
    //     FROM venta v
    //     INNER JOIN metodopago mp ON mp.idmetodoPago = v.metodoPago_idmetodoPago
    //     INNER JOIN empleado e ON e.idEmpleado = v.Empleado_idEmpleado 
    //     INNER JOIN persona p ON p.idPersona = e.Persona_idPersona
    //     INNER JOIN clientes c ON c.idClientes = v.Clientes_idClientes
    //     INNER JOIN persona pc ON c.Persona_idPersona = pc.idPersona;";
    //     $resultado = $conexion->consultar($query);
    //     $total_registros = $resultado->fetch_array()[0];
    //     return $total_registros;
    // }

    public function getIdVenta()
    {
        return $this->idVenta;
    }


    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;

        return $this;
    }


    public function getTotalVenta()
    {
        return $this->totalVenta;
    }


    public function setTotalVenta($totalVenta)
    {
        $this->totalVenta = $totalVenta;

        return $this;
    }


    public function getMetodoPago_idmetodoPago()
    {
        return $this->metodoPago_idmetodoPago;
    }

    public function setMetodoPago_idmetodoPago($metodoPago_idmetodoPago)
    {
        $this->metodoPago_idmetodoPago = $metodoPago_idmetodoPago;

        return $this;
    }

    public function getEmpleado_idEmpleado()
    {
        return $this->empleado_idEmpleado;
    }


    public function setEmpleado_idEmpleado($empleado_idEmpleado)
    {
        $this->empleado_idEmpleado = $empleado_idEmpleado;

        return $this;
    }


    public function getClientes_idClientes()
    {
        return $this->clientes_idClientes;
    }


    public function setClientes_idClientes($clientes_idClientes)
    {
        $this->clientes_idClientes = $clientes_idClientes;

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
}


// idVenta, fechaVenta, horaVenta, totalVenta, estado, metodoPago_idmetodoPago, Empleado_idEmpleado, Clientes_idClientes