<?php
// Inicia el buffer de salida para manejar redirecciones correctamente
ob_start();

// Inicia la sesión para acceder a las variables de sesión
session_start();

// Verifica que el empleado esté logueado y tenga un ID válido
if (!isset($_SESSION['idEmpleado'])) {
    // Redirige al usuario a la página de login si no hay un empleado en sesión
    include_once('View/Paginas/Usuarios/login.php');
    exit;
}

// Incluye el archivo del modelo de Caja
include_once("Model/Caja/caja.php");

// Obtiene el ID del empleado de la sesión, asegurando que sea un entero
$idEmpleado = intval($_SESSION['idEmpleado']);

// Crea una instancia de la clase Caja y asigna el ID del empleado
$cajaInicio = new Caja();
$cajaInicio->setEmpleadoId($idEmpleado);

// Obtiene la información de la caja para el empleado
$resultadosCaja = $cajaInicio->obtenerInfoCaja();

// Verifica si se obtuvo un resultado válido de la caja
if (!empty($resultadosCaja) && isset($resultadosCaja[0]['idCajas'])) {
    // Si hay una caja abierta, guarda su ID en la sesión
    $idCaja = $resultadosCaja[0]['idCajas'];
    $_SESSION['idCaja'] = $idCaja;
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <?php include_once('includes/head.php'); ?>
</head>

<body>
    <?php
    // Verificar si la página actual es actualizar_pass
    $pagina_actual = isset($_GET['page']) ? $_GET['page'] : '';
    if ($pagina_actual !== 'actualizar_pass') {
        if (!empty($_SESSION)) {
            include('includes/navbar.php');
        }
    }
    ?>
    <?php
    // Mostrar errores
    if (isset($_COOKIE['errores'])) {
        $errores = unserialize($_COOKIE['errores']);
        foreach ($errores as $mensaje) {
            echo '<div class="alert alert-danger text-center" role="alert">' . $mensaje . '</div>';
        }
        setcookie('errores', '', time() - 3600, '/'); // Borrar cookie después de usarla
    }

    // Mostrar mensajes
    if (isset($_COOKIE['mensaje'])) {
        $mensaje = $_COOKIE['mensaje'];
        $status = isset($_GET['status']) ? $_GET['status'] : 'info';
        echo '<div class="alert alert-' . $status . ' text-center" role="alert">' . $mensaje . '</div>';
        setcookie('mensaje', '', time() - 3600, '/'); // Borrar cookie después de usarla
    }
    ?>

<?php
if (isset($_GET['mensaje'])) {
    $mensaje = $_GET['mensaje'];
    $status = isset($_GET['status']) ? $_GET['status'] : 'info'; // Establecer 'info' como estado por defecto

    // Añadir un script para mostrar el mensaje con Toastr
    echo "<script>
        $(document).ready(function() {
            toastr.$status('$mensaje');
        });
    </script>";
}
?>

    <div class="container">
        <?php
        if (!isset($_SESSION['nombre_usuario']) && $pagina_actual !== 'actualizar_pass') {
            // Si el usuario no ha iniciado sesión y no está en la página de actualizar contraseña, redirigir a la página de inicio de sesión
            include_once('View/Paginas/Usuarios/login.php');
            exit(); // Terminar el script para evitar que el resto del código se ejecute
        }

        $pagesValidas = array('login', 'listado_usuarios', 'registro', 'salida', 'actualizar_pass', 'configuracion', 'accesos_perfiles', 'apertura_caja', 'cierre_caja', 'movimientos_caja');
        $pages = array('marca', 'rubro', 'tipodocumento', 'persona', 'tipocontacto', 'producto', 'direccion', 'empleado', 'proveedor', 'metodopago', 'perfiles', 'pass', 'compra', 'modulos', 'moduloperfil', 'venta', 'cliente', 'caja');
        foreach ($pages as $page) {
            $pagesValidas[] = 'listado_' . $page;
            $pagesValidas[] = 'alta_' . $page;
            $pagesValidas[] = 'editar_' . $page;
            $pagesValidas[] = 'actualizar_' . $page;
        }

        $modulosValidos = ['Usuarios', 'Productos', 'Personas', 'Caja', 'Compras', 'Ventas', 'Clientes'];
        $submodulosValidos = ['Documento', 'Contacto', 'Empleado', 'Proveedor', 'Perfiles', 'Compra', 'Modulos', 'Moduloperfil', 'Venta', 'Cliente', 'Metodopago'];

        if (!empty($_GET['modulo']) && $_GET['page']) {
            $page = $_GET['page'];
            $modulo = ucfirst($_GET['modulo']);
            // ucfirst convierte la primer letra del string en Mayuscula
            if (!empty(($_GET['submodulo']))) {
                $submodulo = ucfirst(($_GET['submodulo']));
                if (in_array($page, $pagesValidas) && in_array($modulo, $modulosValidos) && in_array($submodulo, $submodulosValidos)) {
                    include('View/Paginas/' . $modulo . '/' . $submodulo . '/' . $page . '.php');
                } else {
                    include('View/Paginas/404.php');
                }
            } else {
                if (in_array($page, $pagesValidas) && in_array($modulo, $modulosValidos)) {
                    include('View/Paginas/' . $modulo . '/' . $page . '.php');
                } else {
                    include('View/Paginas/404.php');
                }
            }
        } else {
            if (isset($_SESSION['nombre_usuario'])) {
                include('View/Paginas/dashboard.php');
            } else {
                include_once('View/Paginas/Usuarios/login.php');
            }
        }
        ?>
    </div>
</body>

</html>

<?php
// Envia la salida y finaliza el buffering de salida
ob_end_flush();
?>