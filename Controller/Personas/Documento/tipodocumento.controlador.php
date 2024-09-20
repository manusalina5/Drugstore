<?php

include_once '../../../Model/Personas/Documento/tipoDocumento.php';
include_once '../../../config/conexion.php';

if (isset($_GET['action']) && $_GET['action'] == 'buscar') {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $registro_por_pagina = 10;
    $inicio = ($pagina - 1) * $registro_por_pagina;

    $tipoDocumentosObj = new TipoDocumento();
    $tipoDocumentos = $tipoDocumentosObj->buscarTipoDocumentos($busqueda, $inicio, $registro_por_pagina);
    $total_paginas = TipoDocumento::totalPaginasBusqueda($busqueda, $registro_por_pagina);

    echo json_encode([
        'tipoDocumentos' => $tipoDocumentos,
        'total_paginas' => $total_paginas
    ]);
    exit();
}


if(isset($_POST['action'])){
    $tipodocumento = new TipoDocumentoControlador();
    if($_POST['action'] == 'registro'){
        $tipodocumento->registrarTipoDocumento();
    }else if($_POST['action'] == 'modificar'){
        $tipodocumento->modificarTipoDocumento();
    }else if($_POST['action'] == 'eliminar'){
        $tipodocumento->eliminarTipoDocumento();
    }
}

class TipoDocumentoControlador
{
    public function registrarTipoDocumento()
    {
        if (empty($_POST['valortipodedocumento'])) {
            header('Location: ../../index.php?page=registro&=Por favor, completa todos los campos');
        }

        if (!empty($_POST['valortipodedocumento'])) {
            $tipodocumento = new TipoDocumento(null, $_POST['valortipodedocumento']);
            $tipodocumento->guardar();
            header('Location: ../../../index.php?page=listado_tipodocumento&modulo=personas&submodulo=documento');
        } else {
            echo "El campo esta vacio";
        }
    }


    public function modificarTipoDocumento()
    {
        if (empty($_POST['valortipodocumento']) || empty($_POST['idtipodocumento'])) {
            header('Localation: ../../index.php?page=modificar&message=Por favor, completa todos los campos');
        } else {
            $tipodocumento = new TipoDocumento($_POST['idtipodocumento'], $_POST['valortipodocumento']);
            $tipodocumento->actualizar();
            header('Location: ../../../index.php?page=listado_tipodocumento&modulo=personas&submodulo=documento');
        }
    }


    public function eliminarTipoDocumento()
    {
        if (!empty($_POST['idtipodocumento'])) {
            $tipodocumento = new TipoDocumento($_POST['idtipodocumento'], null);
            $tipodocumento->eliminar();
            header('Location: ../../../index.php?page=listado_tipodocumento&modulo=personas&submodulo=documento');
        }
    }
}
