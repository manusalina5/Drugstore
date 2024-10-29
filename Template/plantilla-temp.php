<?php
ob_start();
session_start();

// Funciones auxiliares
function mostrarErrores() {
    if (isset($_COOKIE['errores'])) {
        $errores = unserialize($_COOKIE['errores']);
        foreach ($errores as $mensaje) {
            echo '<div class="alert alert-danger text-center" role="alert">' . $mensaje . '</div>';
        }
        setcookie('errores', '', time() - 3600, '/');
    }
}

function mostrarMensajes() {
    if (isset($_COOKIE['mensaje'])) {
        $mensaje = $_COOKIE['mensaje'];
        $status = $_GET['status'] ?? 'info';
        echo '<div class="alert alert-' . $status . ' text-center" role="alert">' . $mensaje . '</div>';
        setcookie('mensaje', '', time() - 3600, '/');
    }

    if (isset($_GET['mensaje'])) {
        $mensaje = $_GET['mensaje'];
        $status = $_GET['status'] ?? 'info';
        echo "<script>
            $(document).ready(function() {
                toastr.$status('$mensaje');
            });
        </script>";
    }
}

function cargarPagina($pagina, $modulo = '', $submodulo = '') {
    $rutaBase = 'View/Paginas/';
    $rutaCompleta = $rutaBase . ($modulo ? $modulo . '/' : '') . ($submodulo ? $submodulo . '/' : '') . $pagina . '.php';
    
    if (file_exists($rutaCompleta)) {
        include($rutaCompleta);
    } else {
        include($rutaBase . '404.php');
    }
}

// Configuración
$pagesValidas = ['login', 'listado_usuarios', 'registro', 'salida', 'actualizar_pass', 'configuracion', 'accesos_perfiles', 'apertura_caja', 'cierre_caja', 'movimientos_caja'];
$pages = ['marca', 'rubro', 'tipodocumento', 'persona', 'tipocontacto', 'producto', 'direccion', 'empleado', 'proveedor', 'tipoegreso', 'metodopago', 'perfiles', 'pass', 'compra', 'modulos', 'moduloperfil', 'venta', 'cliente', 'caja'];
foreach ($pages as $page) {
    $pagesValidas[] = 'listado_' . $page;
    $pagesValidas[] = 'alta_' . $page;
    $pagesValidas[] = 'editar_' . $page;
    $pagesValidas[] = 'actualizar_' . $page;
}

$modulosValidos = ['Usuarios', 'Productos', 'Personas', 'Caja', 'Compras', 'Ventas', 'Clientes'];
$submodulosValidos = ['Documento', 'Contacto', 'Egreso', 'Empleado', 'Proveedor', 'Perfiles', 'Compra', 'Modulos', 'Moduloperfil', 'Venta', 'Cliente', 'Metodopago'];

// Lógica principal
$paginaActual = $_GET['page'] ?? '';
$modulo = ucfirst($_GET['modulo'] ?? '');
$submodulo = ucfirst($_GET['submodulo'] ?? '');

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once('includes/head.php') ?>
</head>
<body>
    <?php
    if ($paginaActual !== 'actualizar_pass' && !empty($_SESSION)) {
        include('includes/navbar.php');
    }
    
    mostrarErrores();
    mostrarMensajes();
    ?>

    <div class="container">
        <?php
        if (!isset($_SESSION['nombre_usuario']) && $paginaActual !== 'actualizar_pass') {
            cargarPagina('login', 'Usuarios');
        } elseif (!empty($_GET['modulo']) && !empty($_GET['page'])) {
            if (in_array($paginaActual, $pagesValidas) && in_array($modulo, $modulosValidos)) {
                if (!empty($submodulo) && in_array($submodulo, $submodulosValidos)) {
                    cargarPagina($paginaActual, $modulo, $submodulo);
                } else {
                    cargarPagina($paginaActual, $modulo);
                }
            } else {
                cargarPagina('404');
            }
        } else {
            cargarPagina(isset($_SESSION['nombre_usuario']) ? 'dashboard' : 'login', 'Usuarios');
        }
        ?>
    </div>
</body>
</html>

<?php ob_end_flush(); ?>
