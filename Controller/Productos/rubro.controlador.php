<?php

include_once '../../Model/Productos/rubro.php';
include_once '../../config/conexion.php';

if (isset($_GET['action']) && $_GET['action'] == 'buscar') {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $registro_por_pagina = 10;
    $inicio = ($pagina - 1) * $registro_por_pagina;

    $rubroObj = new Rubro();
    $rubros = $rubroObj->buscarRubro($busqueda, $inicio, $registro_por_pagina);
    $total_paginas = Rubro::totalPaginasBusqueda($busqueda, $registro_por_pagina);

    echo json_encode([
        'rubros' => $rubros,
        'total_paginas' => $total_paginas
    ]);
    exit();
}

if (isset($_POST['action'])) {
    $rubro_controller = new RubroControlador();
    if ($_POST['action'] == 'registro') {
        $rubro_controller->registrarRubro();
    } else if ($_POST['action'] == 'modificar') {
        $rubro_controller->modificarRubro();
    } else if ($_POST['action'] == 'eliminar') {
        $rubro_controller->eliminarRubro();
    }
}


class RubroControlador
{
    public function registrarRubro()
    {

        if (!empty($_POST['nombreRubro'])) {
            $rubro = new Rubro();
            $rubro->setNombre($_POST['nombreRubro']);
            $rubro->guardar();
            header('Location: ../../index.php?page=listado_rubro&modulo=productos');
        }

    }

    public function modificarRubro()
    {
        if (empty($_POST['nombreRubro']) || empty($_POST['id'])) {
            header('Location: ../index.php?page=modificar&id=' . $_POST['id'] . 'message=Por favor, completa todos los campos');
        } else {
            $rubro = new Rubro($_POST['id'], $_POST['nombreRubro']);
            $rubro->actualizar();
            header('Location: ../../index.php?page=listado_rubro&modulo=productos');
        }
    }

    public function eliminarRubro()
    {
        if (!empty($_POST['id'])) {
            $rubro = new Rubro($_POST['id'], null);
            $rubro->eliminar();
            header('Location: ../../index.php?page=listado_rubro&modulo=productos');

        }
    }

}

