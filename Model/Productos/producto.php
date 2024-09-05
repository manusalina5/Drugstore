<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class Producto
{
    private $id;
    private $nombre;
    private $codBarras;
    private $cantidad;
    private $cantidadMin;
    private $precioCosto;
    private $precioVenta;
    private $marcaId;
    private $rubroId;

    public function __construct(
        $id = "",
        $nombre = "",
        $codBarras = "",
        $cantidad = "",
        $cantidadMin = "",
        $precioCosto = "",
        $precioVenta = "",
        $marcaId = "",
        $rubroId = ""
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
        $this->codBarras = $codBarras;
        $this->cantidadMin = $cantidadMin;
        $this->precioCosto = $precioCosto;
        $this->precioVenta = $precioVenta;
        $this->marcaId = $marcaId;
        $this->rubroId = $rubroId;
    }

    public function guardar()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO `producto`
                    (`nombre`,
                    `codBarras`,
                    `cantidad`,
                    `cantidadMin`,
                    `precioCosto`,
                    `precioVenta`,
                    `Marca_idMarca`,
                    `Rubro_idRubros`)
                    VALUES
                    ('$this->nombre',
                    '$this->codBarras',
                    '$this->cantidad',
                    '$this->cantidadMin',
                    '$this->precioCosto',
                    '$this->precioVenta',
                    '$this->marcaId',
                    '$this->rubroId')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE `producto` SET nombre = '$this->nombre', 
        codBarras = '$this->codBarras', 
        cantidad = '$this->cantidad',
        cantidadMin = '$this->cantidadMin',
        precioCosto = '$this->precioCosto',
        precioVenta = '$this->precioVenta',
        Marca_idMarca = '$this->marcaId',
        Rubro_idRubros = '$this->rubroId'
        WHERE idProductos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion  = new Conexion;
        $query = "UPDATE producto SET estado = 0 WHERE idProductos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerProductos($inicio, $registro_por_pagina)
    {
        $conexion = new Conexion;
        $query = "SELECT `producto`.`idProductos`,
        `producto`.`nombre`,
        `producto`.`codBarras`,
        `producto`.`cantidad`,
        `producto`.`cantidadMin`,
        `producto`.`precioCosto`,
        `producto`.`precioVenta`,
        `producto`.`estado`,
        `producto`.`Marca_idMarca`,
        `producto`.`Rubro_idRubros`
        FROM `producto`
        WHERE estado = 1 LIMIT $inicio, $registro_por_pagina ";
        $resultado = $conexion->consultar($query);
        $productos = array();
        if ($resultado->num_rows > 0){
            while ($row = $resultado->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;

    }

    public static function totalPaginas($registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) FROM producto WHERE estado = 1";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];

        $total_paginas = ceil($total_registros / $registro_por_pagina);

        return $total_paginas;
    }

    
    public function obtenerProductosPorId()
    {
        $conexion = new Conexion;
        $query = "SELECT `producto`.`idProductos`,
        `producto`.`nombre`,
        `producto`.`codBarras`,
        `producto`.`cantidad`,
        `producto`.`cantidadMin`,
        `producto`.`precioCosto`,
        `producto`.`precioVenta`,
        `producto`.`estado`,
        `producto`.`Marca_idMarca`,
        `producto`.`Rubro_idRubros`
        FROM `producto`
        WHERE idProductos = '$this->id'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
        
    }

    function buscarProductos($busqueda, $inicio, $registro_por_pagina){
        $conexion = new Conexion();
        $query = "SELECT idProductos, producto.nombre, codBarras, cantidad, cantidadMin, precioCosto, precioVenta, m.nombre as marca, r.nombre as rubro
                    FROM producto
                    INNER JOIN marca m ON m.idMarca = producto.Marca_idMarca
                    INNER JOIN rubro r ON r.idRubros = producto.Rubro_idRubros
                    WHERE producto.estado = 1 AND
                    (producto.nombre LIKE '%$busqueda%' OR 
                    m.nombre LIKE '%$busqueda%' OR
                    r.nombre LIKE '%$busqueda%')
                    LIMIT $inicio, $registro_por_pagina";
        $resultado = $conexion->consultar($query);
        $productos = array();
        if($resultado->num_rows > 0){
            while($row = $resultado->fetch_assoc()){
                $productos[] = $row;
            }
            return $productos;
        }
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT COUNT(*) 
                    FROM producto 
                    INNER JOIN marca m ON m.idMarca = producto.Marca_idMarca
                    INNER JOIN rubro r ON r.idRubros = producto.Rubro_idRubros
                    WHERE producto.estado = 1 AND
                    (producto.nombre LIKE '%$busqueda%' OR 
                    m.nombre LIKE '%$busqueda%' OR
                    r.nombre LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
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


    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }


    public function getCodBarras()
    {
        return $this->codBarras;
    }


    public function setCodBarras($codBarras)
    {
        $this->codBarras = $codBarras;

        return $this;
    }


    public function getCantidad()
    {
        return $this->cantidad;
    }


    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }


    public function getCantidadMin()
    {
        return $this->cantidadMin;
    }


    public function setCantidadMin($cantidadMin)
    {
        $this->cantidadMin = $cantidadMin;

        return $this;
    }


    public function getPrecioCosto()
    {
        return $this->precioCosto;
    }


    public function setPrecioCosto($precioCosto)
    {
        $this->precioCosto = $precioCosto;

        return $this;
    }


    public function getPrecioVenta()
    {
        return $this->precioVenta;
    }


    public function setPrecioVenta($precioVenta)
    {
        $this->precioVenta = $precioVenta;

        return $this;
    }


    public function getMarcaId()
    {
        return $this->marcaId;
    }


    public function setMarcaId($marcaId)
    {
        $this->marcaId = $marcaId;

        return $this;
    }


    public function getRubroId()
    {
        return $this->rubroId;
    }

    public function setRubroId($rubroId)
    {
        $this->rubroId = $rubroId;

        return $this;
    }
}
