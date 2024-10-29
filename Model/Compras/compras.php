<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Compra
{
    private $idcompra;
    private $totalcompra;
    private $metodoPago_idmetodoPago;
    private $caja_idCajas;

    public function __construct(
        $idcompra = "",
        $totalcompra = "",
        $metodoPago_idmetodoPago = "",
        $caja_idCajas = ""
    ) {
        $this->idcompra = $idcompra;
        $this->totalcompra = $totalcompra;
        $this->metodoPago_idmetodoPago = $metodoPago_idmetodoPago;
        $this->caja_idCajas = $caja_idCajas;
    }

    public function guardarCompra()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO compra (fechaCompra, 
                        horaCompra, 
                        totalCompra, 
                        metodoPago_idmetodoPago, 
                        caja_idCajas)
                        VALUES (CURRENT_DATE(), CURRENT_TIME(), 
                        $this->totalcompra, 
                        $this->metodoPago_idmetodoPago, 
                        $this->caja_idCajas)";
        return $conexion->insertar($query);
    }

    public function buscarCompras($busqueda, $inicio, $registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT c.idCompra, CONCAT(c.fechaCompra,' ', c.horaCompra) AS fechaHora, mp.nombre AS metodoPago  
                FROM compra c 
                INNER JOIN metodopago mp ON mp.idmetodoPago = c.metodoPago_idmetodoPago
                INNER JOIN caja ca ON ca.idCajas = c.caja_idCajas
                WHERE c.estado = 1 AND 
                (c.fechaCompra LIKE '%$busqueda' OR
                c.horaCompra LIKE '%$busqueda' OR
                mp.nombre LIKE '%$busqueda')
                LIMIT $inicio, $registro_por_pagina";
        $resultado = $conexion->consultar($query);
        $compras = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $compras[] = $row;
            }
            return $compras;
        }
    }

    public function obtenerCompra(){
        $conexion = new Conexion();
        $query = "SELECT idCompra, fechaCompra, horaCompra, totalCompra
        FROM Compra WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $compra = array();
        if ($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $compra[] = $row;
            }
        } return $compra;
    }

    public static function totalPaginas($registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) FROM compras WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
        return $total_paginas;
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT COUNT(*)
                FROM compra c 
                INNER JOIN metodopago mp ON mp.idmetodoPago = c.metodoPago_idmetodoPago
                INNER JOIN caja ca ON ca.idCajas = c.caja_idCajas
                WHERE c.estado = 1 AND 
                (c.fechaCompra LIKE '%$busqueda' OR
                c.horaCompra LIKE '%$busqueda' OR
                mp.nombre LIKE '%$busqueda';";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
        return $total_paginas;
        
    }

    public function getIdcompra()
    {
        return $this->idcompra;
    }

    public function setIdcompra($idcompra)
    {
        $this->idcompra = $idcompra;

        return $this;
    }

    public function getTotalcompra()
    {
        return $this->totalcompra;
    }

    public function setTotalcompra($totalcompra)
    {
        $this->totalcompra = $totalcompra;

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

    public function getCaja_idCajas()
    {
        return $this->caja_idCajas;
    }

    public function setCaja_idCajas($caja_idCajas)
    {
        $this->caja_idCajas = $caja_idCajas;

        return $this;
    }
}