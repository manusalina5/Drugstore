<?php

include_once '../../../Model/Compras/Compra/compras.php';
include_once '../../../config/conexion/php';

class CompraControlador{

    public function __construct()
    {
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        if (isset($action)) {
            switch ($action) {
                case 'compras':
                    $this->registrarCompra();
                    break;
                case 'buscar':
                    $this->listadoCompras();
                    break;
            }
        }
    }
    public function registrarCompra(){
        
    }

    public function listadoCompras(){
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

        $registro_por_pagina = 10;
        $inicio = ($pagina - 1) * $registro_por_pagina;

        $compraObj = new Compra();
        $compras = $compraObj->buscarCompras($busqueda, $inicio, $registro_por_pagina);
        $total_paginas = Compra::totalPaginasBusqueda($busqueda, $registro_por_pagina);

        echo json_encode([
            'compras' => $compras,
            'total_paginas' => $total_paginas
        ]);
        exit();
    }

}