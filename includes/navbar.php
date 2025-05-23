<?php

require_once 'model/usuario/modulos.php';
function generarMenu($modulos)
{
    $menu = [
        'usuarios' => [
            'icon' => 'bi bi-people-fill',
            'label' => 'Usuarios',
            'submenus' => [
                'Registrar Usuario' => '?page=registro&modulo=usuarios',
                'Lista de Usuarios' => '?page=listado_usuarios&modulo=usuarios',
                'Registrar Perfil' => '?page=alta_perfiles&modulo=usuarios&submodulo=perfiles',
                'Lista de Perfiles' => '?page=listado_perfiles&modulo=usuarios&submodulo=perfiles',
                'Registrar Modulos' => '?page=alta_modulos&modulo=usuarios&submodulo=modulos',
                'Lista de Modulos' => '?page=listado_modulos&modulo=usuarios&submodulo=modulos',
            ]
        ],
        'ventas' => [
            'icon' => 'bi bi-cart-fill',
            'label' => 'Ventas',
            'submenus' => [
                'Registrar Ventas' => '?page=alta_venta&modulo=ventas',
                'Listar Ventas' => '?page=listado_venta&modulo=ventas',
                'Agregar Metodo de Pago' => '?page=alta_metodopago&modulo=ventas&submodulo=metodopago',
                'Ver Metodos de Pago' => '?page=listado_metodopago&modulo=ventas&submodulo=metodopago',
                'Tipo de Descuento' => '?page=tipo_descuento&modulo=ventas',
                'Alta de Combo' => '?page=alta_combo&modulo=ventas&submodulo=combo',
                'Ver Combos' => '?page=listado_combo&modulo=ventas&submodulo=combo',
            ]
        ],
        'productos' => [
            'icon' => 'bi bi-bag',
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
            'icon' => 'bi bi-truck',
            'label' => 'Compras',
            'submenus' => [
                'Registrar Compras' => '?page=alta_compra&modulo=compras',
                'Listar Compras' => '?page=listado_compra&modulo=compras',
            ]
        ],
        'personas' => [
            'icon' => 'bi bi-file-earmark-person',
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
        'caja' => [
            'icon' => 'bi bi-cash-coin',
            'label' => 'Caja',
            'submenus' => [
                'Ver Cajas' => '?page=listado_caja&modulo=caja',
                'Ver Movimientos Caja' => '?page=movimientos_caja&modulo=caja',
            ]
        ],
        'auditoria' => [
            'label' => 'Auditoria',
            'submenus' => []
        ],
        'configuracion' => [
            'label' => 'Configuracion',
            'submenus' => []
        ],
        'estadistica' => [
            'label' => 'Estadistica',
            'submenus' => []
        ],
        'combos' => [
            'label' => 'Combos',
            'submenus' => []
        ]
    ];

    // Generar el HTML para los módulos habilitados
    foreach ($modulos as $modulo) {
        if (array_key_exists($modulo['nombre'], $menu)) {
            $icon = $menu[$modulo['nombre']];
            // Si necesito agregar íconos a los módulos colocar esto arriba: 
            // $icon = $menu[$modulo['nombre']]['icon'];
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
            echo $menu[$modulo['nombre']]['label'] . '</a>';
            echo '<ul class="dropdown-menu dropdown-menu">'; 
            // Para un menú Dark/oscuro poner:
            // class="dropdown-menu dropdown-menu-dark"

            // Separar en grupos de submenús
            $contador = 0;
            foreach ($menu[$modulo['nombre']]['submenus'] as $submenu_label => $submenu_link) {
                if ($contador > 0 && $contador % 3 == 0) { // Dividir después de cada 3 submenús
                    echo '<div class="dropdown-divider"></div>';
                }
                echo '<li><a class="dropdown-item" href="' . $submenu_link . '">' . $submenu_label . '</a></li>';
                $contador++;
            }
            echo '</ul>';
            echo '</li>';
        }
    }
}



?>

<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">


        <a class="navbar-brand" href="index.php">
            <img src="Assets/img/sgd-sinfondo.png" alt="logo sgd" width="32" height="24">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">


            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a href="index.php" class="nav-link">Inicio</a>
                </li>

                <?php
                if (isset($_SESSION['idPerfil'])) {
                    $modulo = new Modulos();
                    $modulos = $modulo->obtenerModulosPorPerfil($_SESSION['idPerfil']);
                    generarMenu($modulos); // Generar el menú con la función
                }
                ?>
                <li class="nav-item">

                    <a href="?page=configuracion&modulo=usuarios" class="nav-link ">
                        @<?php echo $_SESSION['nombre_usuario']; ?></a>

                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link link-danger" href="?page=salida&modulo=usuarios"></a>
                </li>
                <a href="?page=salida&modulo=usuarios"><button class="btn btn-sm btn-outline-danger" type="button"><i class="bi bi-x-lg"> </i> Cerrar Sesión </button></a>
                
            </ul>

        </div>
</nav>