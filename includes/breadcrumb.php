<?php
function generarBreadcrumb($modulo, $submodulo, $page)
{
    // Definir nombres personalizados
    $nombresPersonalizados = [
        'alta_venta' => 'Registrar Venta',
        'listado_usuarios' => 'Lista de Usuarios',
        'editar_producto' => 'Editar Producto',
        'listado_venta' => 'Listar Ventas',
        'alta_metodopago' => 'Registrar Método de Pago',
        'alta_perfiles' => 'Agregar perfiles'
        // Agrega más submódulos personalizados aquí
    ];

    $breadcrumb = '<nav aria-label="breadcrumb" ><ol class="breadcrumb">';

     // Página de inicio (texto puro)
        $breadcrumb .= '<li class="breadcrumb-item">Inicio</li>';


    // Texto del módulo
    if (!empty($modulo)) {
        $breadcrumb .= '<li class="breadcrumb-item">'  . ucfirst($modulo) . '</li>';
    }

    // Texto del submódulo
    if (!empty($submódulo)) {
        $nombreSubmodulo = $nombresPersonalizados[$submodulo] ?? ucfirst(str_replace('_', ' ', $submodulo));
        $breadcrumb .= '<li class="breadcrumb-item">' . $nombreSubmodulo . '</li>';
    }

    // Texto de la página actual
    if (!empty($page)) {
        $nombrePage = $nombresPersonalizados[$page] ?? ucfirst(str_replace('_', ' ', $page));
        $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page">' . $nombrePage . '</li>';
    }


    $breadcrumb .= '</ol></nav>';
    return $breadcrumb;
}
