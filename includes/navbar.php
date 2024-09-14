<?php

require_once 'model/usuario/modulos.php';

function generarMenu($modulos) {
    $menu = [
        'usuarios' => [
            'label' => 'Usuarios',
            'submenus' => [
                'Registrar Usuarios' => '?page=registro&modulo=usuarios',
                'Listar Usuarios' => '?page=listado_usuarios&modulo=usuarios',
                'Agregar Perfiles' => '?page=alta_perfiles&modulo=usuarios&submodulo=perfiles',
                'Listar Perfiles' => '?page=listado_perfiles&modulo=usuarios&submodulo=perfiles',
                'Agregar Modulos' => '?page=alta_modulos&modulo=usuarios&submodulo=modulos',
                'Listar Modulos' => '?page=listado_modulos&modulo=usuarios&submodulo=modulos',
            ]
        ],
        'ventas' => [
            'label' => 'Ventas',
            'submenus' => [
                'Registrar Ventas' => '?page=alta_venta&modulo=ventas',
                'Listar Ventas' => '?page=listado_venta&modulo=ventas',
            ]
        ],
        'productos' => [
            'label' => 'Productos',
            'submenus' => [
                'Agregar Productos' => '?page=alta_producto&modulo=productos',
                'Ver Productos' => '?page=listado_producto&modulo=productos',
                'Agregar Marca' => '?page=alta_marca&modulo=productos',
                'Ver Marcas' => '?page=listado_marca&modulo=productos',
                'Agregar Rubro' => '?page=alta_rubro&modulo=productos',
                'Ver Rubros' => '?page=listado_rubro&modulo=productos',
            ]
        ],
        'compras' => [
            'label' => 'Compras',
            'submenus' => [
                'Registrar Compras' => '?page=alta_compra&modulo=compras',
                'Listar Compras' => '?page=listado_compra&modulo=compras',
            ]
        ],
        'personas' => [
            'label' => 'Personas',
            'submenus' => [
                'Agregar Persona' => '?page=alta_persona&modulo=personas',
                'Ver Personas' => '?page=listado_persona&modulo=personas',
                'Agregar Cliente' => '?page=alta_cliente&modulo=personas&submodulo=cliente',
                'Ver Clientes' => '?page=listado_cliente&modulo=personas&submodulo=cliente',
                'Agregar Empleado' => '?page=alta_empleado&modulo=personas&submodulo=empleado',
                'Ver Empleados' => '?page=listado_empleado&modulo=personas&submodulo=empleado',
                'Agregar Proveedor' => '?page=alta_proveedor&modulo=personas&submodulo=proveedor',
                'Ver Proveedores' => '?page=listado_proveedor&modulo=personas&submodulo=proveedor',
                'Agregar Tipo Documento' => '?page=alta_tipodocumento&modulo=personas&submodulo=documento',
                'Ver Tipo Documentos' => '?page=listado_tipodocumento&modulo=personas&submodulo=documento',
                'Agregar Tipo Contacto' => '?page=alta_tipocontacto&modulo=personas&submodulo=contacto',
                'Ver Tipo Contactos' => '?page=listado_tipocontacto&modulo=personas&submodulo=contacto',
            ]
        ],
        'egresos' => [
            'label' => 'Egresos',
            'submenus' => [
                'Agregar Tipo Egreso' => '?page=alta_tipoegreso&modulo=caja&submodulo=egreso',
                'Ver Tipo Egreso' => '?page=listado_tipoegreso&modulo=caja&submodulo=egreso',
            ]
        ]
    ];

    // Generar el HTML para los módulos habilitados
    foreach ($modulos as $modulo) {
        if (array_key_exists($modulo['nombre'], $menu)) {
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $menu[$modulo['nombre']]['label'] . '</a>';
            echo '<ul class="dropdown-menu">';
            foreach ($menu[$modulo['nombre']]['submenus'] as $submenu_label => $submenu_link) {
                echo '<li><a class="dropdown-item" href="' . $submenu_link . '">' . $submenu_label . '</a></li>';
            }
            echo '</ul>';
            echo '</li>';
        }
    }
}

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="Assets/img/avatar.png" alt="Bootstrap" width="24" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">

                <?php
                if (isset($_SESSION['idPerfil'])) {
                    $modulo = new Modulos();
                    $modulos = $modulo->obtenerModulosPorPerfil($_SESSION['idPerfil']);
                    generarMenu($modulos); // Generar el menú con la función
                }
                ?>

                <li class="nav-item">
                    <strong>
                        <a href="?page=configuracion&modulo=usuarios" class="nav-link"><i class='fi fi-rr-user-pen'> </i>Editar Datos</a>
                    </strong>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-danger" href="?page=salida&modulo=usuarios"><strong>Cerrar Sesion</strong></a>
                </li>
                <li class="nav-item">
                    <p class="nav-link d-flex align-items-center ml-auto">@<?php echo $_SESSION['nombre_usuario']; ?></p>
                </li>

            </ul>
        </div>
    </div>
</nav>
