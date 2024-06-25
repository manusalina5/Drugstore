<?php

    require_once 'model/usuario/modulos.php';

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
                
                if (isset($_SESSION['idPerfil'])){
                    $modulo = new Modulos();
                    $modulos = $modulo->obtenerModulosPorPerfil($_SESSION['idPerfil']);
                    while($row = $modulos->fetch_assoc()){
                        if ($row['nombre'] == 'productos'){
                        echo'
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><strong>Inicio</strong></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=alta_producto&modulo=productos">Agregar Productos</a></li>
                        <li><a class="dropdown-item" href="?page=listado_producto&modulo=productos">Ver Productos</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="?page=alta_marca&modulo=productos">Agregar marca</a></li>
                        <li><a class="dropdown-item" href="?page=listado_marca&modulo=productos">Ver de Marcas</a></li>
                        <hr class="dropdown-divider">
                        <li><a class="dropdown-item" href="?page=alta_rubro&modulo=productos">Agregar rubro</a></li>
                        <li><a class="dropdown-item" href="?page=listado_rubro&modulo=productos">Ver de rubros</a></li>
                    </ul>
                </li>';
                        }
                    }

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tipo Egreso
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?page=alta_tipoegreso&modulo=caja&submodulo=egreso">Agregar Tipo Egreso</a></li>
                        <li><a class="dropdown-item" href="?page=listado_tipoegreso&modulo=caja&submodulo=egreso">Ver Tipo Egreso</a></li>
                        <li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link link-danger" href="?page=salida&modulo=usuarios"><b>Cerrar Sesion</b></a>
                </li>';
                    }
                }
            }
                ?>
            </ul>
        </div>
    </div>
</nav>