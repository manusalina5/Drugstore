<?php

include_once '../../../Model/Personas/Contacto/tipoContacto.php';
include_once '../../../config/conexion.php';

if (isset($_GET['action']) && $_GET['action'] == 'buscar') {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $registro_por_pagina = 10;
    $inicio = ($pagina - 1) * $registro_por_pagina;

    $tipoContactoObj = new TipoContacto();
    $tipoContactos = $tipoContactoObj->buscarTipoContacto($busqueda, $inicio, $registro_por_pagina);
    $total_paginas = TipoContacto::totalPaginasBusqueda($busqueda, $registro_por_pagina);

    echo json_encode([
        'tipoContactos' => $tipoContactos,
        'total_paginas' => $total_paginas
    ]);
    exit();
}


if (isset($_POST['action'])) {
    $tipocontacto = new TipoContactoControlador();
    if ($_POST['action'] == 'registro') {
        $tipocontacto->registrarTipoContacto();
    } else if ($_POST['action'] == 'modificar') {
        $tipocontacto->modificarTipoContacto();
    } else if ($_POST['action'] == 'eliminar') {
        $tipocontacto->eliminarTipoContacto();
    }
}

class TipoContactoControlador
{
    public function registrarTipoContacto(){
        if (empty($_POST['valortipocontacto'])) {
            header('Location: ../../index.php?page=registro&=Por favor, completa todos los campos');
        }

        if (!empty($_POST['valortipocontacto'])) {
            $tipodocumento = new TipoContacto(null, $_POST['valortipocontacto']);
            $tipodocumento->guardar();
            header('Location: ../../../index.php?page=listado_tipocontacto&modulo=personas&submodulo=contacto');
        } else {
            echo "el campo está vacío";
        }
    }

    public function modificarTipoContacto(){
        if (empty($_POST['valortipocontacto']) || empty($_POST['idtipocontacto'])){
            header('Location: ../../index.php?page=modificar&message=Por favor, complete todos los campos');
        } else {
            $tipocontacto = new TipoContacto($_POST['idtipocontacto'], $_POST['valortipocontacto']);
            $tipocontacto->actualizar();
            header('Location: ../../../index.php?page=listado_tipocontacto&modulo=personas&submodulo=contacto');
        }
    }

    public function eliminarTipoContacto(){
        if (!empty($_POST['idtipocontacto'])) {
            $tipocontacto = new TipoContacto($_POST['idtipocontacto'], null);
            $tipocontacto->eliminar();
            header('Location: ../../../index.php?page=listado_tipocontacto&modulo=personas&submodulo=contacto');
        }
    }
}