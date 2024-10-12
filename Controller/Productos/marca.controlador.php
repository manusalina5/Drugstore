<?php

include_once '../../Model/Productos/marca.php';
include_once '../../config/conexion.php';

if (isset($_GET['action'])){
    $marcaControlador = new MarcaControlador();
    switch ($_GET['action']){
        case 'buscar':
            $marcaControlador->buscadorPaginado();
            break;
        case 'buscarselect':
            $marcaControlador->buscarSelected();
            break;
    }
}


if (isset($_POST['action'])){
    $marcaControlador = new MarcaControlador(); 
    if($_POST['action'] == 'registro'){
        $marcaControlador->registrarMarca();
    }else if($_POST['action'] == 'modificar'){
        $marcaControlador->modificarMarca();
    }else if($_POST['action'] == 'eliminar'){
        $marcaControlador->eliminarMarca();
    }
}


class MarcaControlador
{
    public function registrarMarca(){
        if(empty($_POST['nombremarca'])){
            header('Location: ../../index.php?page=registro&=Por favor, completa todos los campos');
        }

        if(!empty($_POST['nombremarca'])){            
            $marca = new Marca(null, $_POST['nombremarca']);
            $marca->guardar();
            header('Location: ../../index.php?page=listado_marca&modulo=productos');
        }else{
            echo 'El campo esta vacio';
        }
    }

    public function modificarMarca() {
        if (empty($_POST['nombremarca']) || empty($_POST['id'])) {
            header('Location: ../index.php?page=modificar&id='.$_POST['id'].'&message=Por favor, completa todos los campos');
        } else {
            $marca = new Marca($_POST['id'], $_POST['nombremarca']);
            $marca->actualizar();
            header('Location: ../../index.php?page=listado_marca&modulo=productos');
        }
    }

    public function eliminarMarca() {
        if (!empty($_POST['id'])){
            $marca = new Marca($_POST['id'], null);
            $marca->eliminar();
            header('Location: ../../index.php?page=listado_marca&modulo=productos');
        }else{
            echo "<div>Error: formulario con campos vacios</>";
        }
    }

    public function buscadorPaginado() {
        $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
    
        $registro_por_pagina = 10;
        $inicio = ($pagina - 1) * $registro_por_pagina;
    
        $marcaObj = new Marca();
        $marcas = $marcaObj->buscarMarca($busqueda, $inicio, $registro_por_pagina);
        $total_paginas = Marca::totalPaginasBusqueda($busqueda, $registro_por_pagina);
    
        echo json_encode([
            'marcas' => $marcas,
            'total_paginas' => $total_paginas
        ]);
        exit();
    }

    public function buscarSelected(){
        $marca = new Marca();
        $resultado = $marca->obtenerMarcas();
        echo json_encode($resultado);
        exit();
    }
}
