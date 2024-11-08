<?php

require_once 'model/usuario/modulos.php';
function generarMenu($modulos)
{
    $menu = [
        'usuarios' => [
            'icon' => 'bi bi-people-fill',
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
    ];

    // Generar el HTML para los módulos habilitados
    foreach ($modulos as $modulo) {
        if (array_key_exists($modulo['nombre'], $menu)) {
            $icon = $menu[$modulo['nombre']]['icon'];
            echo '<li class="nav-item dropdown">';
            echo '<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
            echo '<i class="fas fs-3 ' . $icon . ' me-2"></i>'; // Agrega el ícono antes del nombre del módulo            
            echo $menu[$modulo['nombre']]['label'] . '</a>';
            echo '<ul class="dropdown-menu dropdown-menu-dark">';

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

<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar"
            aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a class="navbar-brand mx-auto" href="index.php">
            <img src="Assets/img/sgd-sinfondo-invertido.png" alt="sgd" width="32" height="32"
                class="d-inline-block align-text-top">
            Sistema de Gestión de Drugstore
        </a>


        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
            aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Sistema de Gestión de Drugstore</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li>
                        <a href="index.php" class="nav-link"><i class="fas fs-3 bi bi-house me-2"></i><strong>Inicio</strong></a>
                    </li>
                    <?php
                    if (isset($_SESSION['idPerfil'])) {
                        $modulo = new Modulos();
                        $modulos = $modulo->obtenerModulosPorPerfil($_SESSION['idPerfil']);
                        generarMenu($modulos); // Generar el menú con la función
                    }
                    ?>
                    <li class="nav-item">
                        <strong>
                            <a href="?page=configuracion&modulo=usuarios" class="nav-link ">
                                <i class="fas fs-3 bi bi-person-fill-gear me-2"></i>Editar usuario
                                (@<?php echo $_SESSION['nombre_usuario']; ?>)</a>
                        </strong>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link link-danger" href="?page=salida&modulo=usuarios"><strong>Cerrar
                                Sesión</strong></a>
                    </li>
                </ul>
            </div>
        </div>
</nav>