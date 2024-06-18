<?php
ob_start();
session_start();


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <!-- Latest compiled and minified CSS -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    if (!empty($_SESSION)) {
        switch ($_SESSION['nombre_perfil']) {
            case 'Administrador':
                include_once('includes/admin.navbar.php');
                break;
            case 'Vendedor':
                include_once('includes/vendedor.navbar.php');
                break;
            case 'Gerente':
                include_once('includes/gerente.navbar.php');
                break;
            case 'CambioPass':
                #
                break;
            default:
                include_once('View/Paginas/Usuarios/salida.php');
                break;
        }
    } else {
    }

    ?>

    <?php
    if (isset($_GET['mensaje'])) {
        $mensaje = $_GET['mensaje'];

        if (isset($_GET['status'])) {
            echo '<div class="alert alert-' . $_GET['status'] . ' text-center" role="alert">' . $_GET['mensaje'] . '</div>';
        } else {
            echo '<div class="alert alert-info text-center" role="alert">' . $_GET['mensaje'] . '</div>';
        }
    }
    ?>
    <div class="container">
        <?php
        if (!isset($_SESSION['nombre_usuario'])) {
            // Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
            include_once('View/Paginas/Usuarios/login.php');
            exit(); // Terminar el script para evitar que el resto del código se ejecute
        }

        $pagesValidas = array('login', 'listado_usuarios', 'registro', 'salida','actualizar_pass');
        $pages = array('marca', 'rubro', 'tipodocumento', 'persona', 'tipocontacto', 'producto', 'direccion', 'empleado', 'proveedor', 'tipoegreso', 'metodopago', 'perfiles','pass','compra');
        foreach ($pages as $page) {
            $pagesValidas[] = 'listado_' . $page;
            $pagesValidas[] = 'alta_' . $page;
            $pagesValidas[] = 'editar_' . $page;
            $pagesValidas[] = 'actualizar_' . $page;
        }

        $modulosValidos = ['Usuarios', 'Productos', 'Personas', 'Caja','Compras'];
        $submodulosValidos = ['Documento', 'Contacto', 'Egreso', 'Empleado', 'Proveedor', 'Perfiles','Compra'];

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