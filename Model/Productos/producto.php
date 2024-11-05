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
    private $utilidad;

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
        $this->calcularUtilidad();
        $query = "INSERT INTO `producto`
            (`nombre`,
            `codBarras`,
            `cantidad`,
            `cantidadMin`,
            `precioCosto`,
            `precioVenta`,
            `Marca_idMarca`,
            `Rubro_idRubros`,
            `utilidad`)
            VALUES
            ('$this->nombre',
            '$this->codBarras',
            '$this->cantidad',
            '$this->cantidadMin',
            '$this->precioCosto',
            '$this->precioVenta',
            '$this->marcaId',
            '$this->rubroId',
            '$this->utilidad')";
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

    public function calcularUtilidad()
    {
        if ($this->precioCosto > 0) {
            $this->utilidad = (($this->precioVenta - $this->precioCosto) / $this->precioCosto) * 100;
        } else {
            $this->utilidad = 0;
        }
    }

    public function eliminar()
    {
        $conexion = new Conexion;
        $query = "UPDATE producto SET estado = 0 WHERE idProductos = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function obtenerProductoPorCodBarras($codBarras)
    {
        $conexion = new Conexion;
        $query = "SELECT *,
        CASE 
            WHEN cantidad < cantidadMin THEN 'Bajo'
            WHEN cantidad >= cantidadMin AND cantidad <= cantidadMin * 2 THEN 'Medio'
            ELSE 'Alto'
            END AS nivel_stock
        FROM producto
        WHERE estado = 1 AND codBarras = $codBarras";
        $resultado = $conexion->consultar($query);
        $productos = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $productos[] = $row;
            }
        } else {
            $productos = false;
        }
        return $productos;
    }

    public function obtenerProductos($busqueda)
    {
        $conexion = new Conexion;
        $query = "SELECT *,
        CASE 
                    WHEN cantidad < cantidadMin THEN 'Bajo'
                    WHEN cantidad >= cantidadMin AND cantidad <= cantidadMin * 2 THEN 'Medio'
                    ELSE 'Alto'
                    END AS nivel_stock
        FROM producto
        WHERE estado = 1 AND (nombre LIKE '%$busqueda%' OR codBarras LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $productos = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        return $productos;
    }

    public static function totalPaginas($registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT COUNT(*),  FROM producto WHERE estado = 1";
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

    function buscarProductos($busqueda, $inicio, $registro_por_pagina, $ordenarPor = 'nombre', $tipoOrden = 'ASC')
    {
        $conexion = new Conexion();
        
        // Validar los parámetros de ordenación para evitar inyecciones de SQL
        $camposOrdenables = ['nombre', 'marca', 'rubro', 'cantidad', 'precioCosto', 'precioVenta'];
        $ordenarPor = in_array($ordenarPor, $camposOrdenables) ? $ordenarPor : 'nombre';
        $tipoOrden = ($tipoOrden === 'DESC') ? 'DESC' : 'ASC';
    
        $query = "SELECT idProductos, utilidad, producto.nombre, codBarras, cantidad, cantidadMin, precioCosto, precioVenta, 
                    m.nombre AS marca, r.nombre AS rubro,
                    CASE 
                        WHEN cantidad < cantidadMin THEN 'Bajo'
                        WHEN cantidad >= cantidadMin AND cantidad <= cantidadMin * 2 THEN 'Medio'
                        ELSE 'Alto'
                    END AS nivel_stock
                FROM producto
                INNER JOIN marca m ON m.idMarca = producto.Marca_idMarca
                INNER JOIN rubro r ON r.idRubros = producto.Rubro_idRubros
                WHERE producto.estado = 1 AND
                (producto.nombre LIKE '%$busqueda%' OR 
                    m.nombre LIKE '%$busqueda%' OR
                    r.nombre LIKE '%$busqueda%' OR
                    codBarras LIKE '%$busqueda%' OR
                    utilidad LIKE '%$busqueda%')
                ORDER BY $ordenarPor $tipoOrden
                LIMIT $inicio, $registro_por_pagina";
    
        $resultado = $conexion->consultar($query);
        $productos = array();
        
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $productos[] = $row;
            }
        }
        
        return $productos;
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

    public function actualizarPrecio($tipoAumento, $priceOption, $tipoMonto, $montoActualizar, $idSeleccionado)
    {
        $conexion = new Conexion;
        if ($tipoAumento == 'rubro') {
            $campoFiltro = 'Rubro_idRubros';
        } elseif ($tipoAumento == 'marca') {
            $campoFiltro = 'Marca_idMarca';
        } else {
            return false;
        }

        $query = "UPDATE producto SET ";
        switch ($priceOption) {
            case 'costo-utilidad':
                $query .= $this->actualizarCostoManteniendoUtilidad($tipoMonto, $montoActualizar);
                break;
            case 'costo-precio':
                $query .= $this->actualizarCostoManteniendoPrecio($tipoMonto, $montoActualizar);
                break;
            case 'precioventa':
                $query .= $this->actualizarPrecioVenta($tipoMonto, $montoActualizar);
                break;
            case 'utilidad':
                $query .= $this->actualizarUtilidad($tipoMonto, $montoActualizar);
                break;
            default:
                return false;
        }

        $query .= " WHERE $campoFiltro = $idSeleccionado";

        return $conexion->consultar($query);
        //return $query;
    }

    public function actualizarPrecioPorId($priceOption, $tipoMonto, $montoActualizar, $idProducto)
    {
        $conexion = new Conexion;

        $query = "UPDATE producto SET ";
        switch ($priceOption) {
            case 'costo-utilidad':
                $query .= $this->actualizarCostoManteniendoUtilidad($tipoMonto, $montoActualizar);
                break;
            case 'costo-precio':
                $query .= $this->actualizarCostoManteniendoPrecio($tipoMonto, $montoActualizar);
                break;
            case 'precioventa':
                $query .= $this->actualizarPrecioVenta($tipoMonto, $montoActualizar);
                break;
            case 'utilidad':
                $query .= $this->actualizarUtilidad($tipoMonto, $montoActualizar);
                break;
            default:
                return false;
        }

        $query .= " WHERE idProductos = $idProducto";

        return $conexion->consultar($query);
    }

    public function actualizarCostoRecalcularPrecio($nuevoPrecioCosto, $idProducto)
    {
        // Conexión a la base de datos
        $conexion = new Conexion;
    
        // Consultar la utilidad actual del producto
        $queryUtilidad = "SELECT utilidad FROM producto WHERE idProductos = $idProducto";
        $resultado = $conexion->consultar($queryUtilidad);
    
        if ($resultado) {
            // Obtener el valor de la utilidad
            $utilidad = $resultado->fetch_array()[0];
    
            // Calcular el nuevo precio de venta en función del precio de costo y la utilidad
            $nuevoPrecioVenta = $nuevoPrecioCosto * (1 + ($utilidad / 100));
    
            // Actualizar el precio de costo y el precio de venta en la base de datos
            $queryUpdate = "UPDATE producto 
                            SET precioCosto = $nuevoPrecioCosto, 
                                precioVenta = $nuevoPrecioVenta 
                            WHERE idProductos = $idProducto";
    
            // Ejecutar la consulta
            if ($conexion->consultar($queryUpdate)) {
                return true; // Actualización exitosa
            } else {
                return false; // Actualización fallida
            }
        } else {
            // 
        }
    }
    



    // Función para actualizar el costo manteniendo la utilidad
    private function actualizarCostoManteniendoUtilidad($tipoMonto, $montoActualizar)
    {
        if ($tipoMonto == 'fijo') {
            return "precioCosto = precioCosto + $montoActualizar, 
                precioVenta = (precioCosto) * (1 + (utilidad / 100))";
        } else {
            return "precioCosto = precioCosto * (1 + $montoActualizar / 100), 
                precioVenta = (precioCosto) * (1 + (utilidad / 100))";
        }
    }

    // Función para actualizar el costo manteniendo el precio de venta
    private function actualizarCostoManteniendoPrecio($tipoMonto, $montoActualizar)
    {
        if ($tipoMonto == 'fijo') {
            return "precioCosto = precioCosto + $montoActualizar, 
                utilidad = ((precioVenta - (precioCosto) / (precioCosto)) * 100";
        } else {
            return "precioCosto = precioCosto * (1 + $montoActualizar / 100), 
                utilidad = ((precioVenta - precioCosto) / precioCosto) * 100";
        }
    }

    // Función para actualizar el precio de venta y recalcular la utilidad
    private function actualizarPrecioVenta($tipoMonto, $montoActualizar)
    {
        if ($tipoMonto == 'fijo') {
            return "precioVenta = precioVenta + $montoActualizar, 
                utilidad = ((precioVenta - precioCosto) / precioCosto) * 100";
        } else {
            return "precioVenta = precioVenta * (1 + $montoActualizar / 100), 
                utilidad = ((precioVenta) - precioCosto) / precioCosto) * 100";
        }
    }

    // Función para actualizar la utilidad y recalcular el precio de venta
    private function actualizarUtilidad($tipoMonto, $montoActualizar)
    {
        // Si se pasa un monto fijo, interpretamos que es el nuevo valor de utilidad deseado
        if ($tipoMonto == 'fijo') {
            return "utilidad = $montoActualizar, 
                precioVenta = precioCosto * (1 + ($montoActualizar / 100))";
        } else {
            // Si es un porcentaje, se trata de un ajuste porcentual sobre el valor actual
            return "utilidad = $montoActualizar, 
                precioVenta = precioCosto * (1 + ($montoActualizar / 100))";
        }
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
