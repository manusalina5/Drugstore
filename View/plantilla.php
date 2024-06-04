<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="Assets/css/style.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.4.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=login&modulo=usuarios">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=registro&modulo=usuarios">Registrar Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=listado_usuarios&modulo=usuarios">Listar Usuarios</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Productos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Marcas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=alta_marca&modulo=productos">Agregar</a></li>
                            <li><a class="dropdown-item" href="?page=listado_marca&modulo=productos">Listo de Marcas</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Rubros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="?page=alta_rubro&modulo=productos">Agregar</a></li>
                            <li><a class="dropdown-item" href="?page=listado_rubro&modulo=productos">Listado de rubros</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=salida&modulo=usuarios">Cerra Sesion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    if (isset($_GET['mensaje'])) {
        $mensaje = $_GET['mensaje'];
        echo '<div class="alert alert-danger text-center" role="alert">' . $_GET['mensaje'] . '</div>';
    }
    ?>
    <div class="container">
        <?php
        if (!empty($_GET['modulo']) && $_GET['page']) {
            // ucfirst convierte la primer letra del string en Mayuscula
            $page = $_GET['page'];
            $modulo = ucfirst($_GET['modulo']);
        } else {
            $page = "";
            $modulo = "";
        }

        $pagesValidas = ['login', 'listado_usuarios', 'salida', 'registro', 'alta_marca', 'alta_rubro', 'editar_marca', 'editarRubro', 'listado_marca', 'listado_rubro'];
        $modulosValidos = ['Usuarios', 'Productos'];

        if (in_array($page, $pagesValidas) && in_array($modulo, $modulosValidos)) {
            include('View/Paginas/' . $modulo . '/' . $page . '.php');
        } else {
            include('View/Paginas/404.php');
        }

        ?>
    </div>
</body>

</html>