<?php
function generarBreadcrumb($modulo, $submodulo, $page)
{
    // Definir nombres personalizados
    $nombresPersonalizados = [
        'alta_venta' => 'Registrar Venta',
        'listado_usuarios' => 'Listado de Usuarios',
        'editar_producto' => 'Editar Producto',
        'listado_venta' => 'Listar Ventas',
        'alta_metodopago' => 'Registrar Método de Pago',
        // Agrega más submódulos personalizados aquí
    ];

    $breadcrumb = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';

    // Enlace a la página de inicio
    $breadcrumb .= '<li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house"></i> Inicio</a></li>';

    // Enlace del módulo
    if (!empty($modulo)) {
        $breadcrumb .= '<li class="breadcrumb-item"><a href="?modulo=' . strtolower($modulo) . '">' . ucfirst($modulo) . '</a></li>';
    }

    // Enlace del submódulo, si existe
    if (!empty($submodulo)) {
        $nombreSubmodulo = $nombresPersonalizados[$submodulo] ?? ucfirst(str_replace('_', ' ', $submodulo));
        $breadcrumb .= '<li class="breadcrumb-item"><a href="?modulo=' . strtolower($modulo) . '&submodulo=' . strtolower($submodulo) . '">' . $nombreSubmodulo . '</a></li>';
    }

    // Página actual
    if (!empty($page)) {
        $nombrePage = $nombresPersonalizados[$page] ?? ucfirst(str_replace('_', ' ', $page));
        $breadcrumb .= '<li class="breadcrumb-item active" aria-current="page">' . $nombrePage . '</li>';
    }

    $breadcrumb .= '</ol></nav>';
    return $breadcrumb;
}
