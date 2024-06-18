<?php

require_once('Model/Usuario/usuarios.php');
require_once('Controller/plantilla.controlador.php');
// require_once('Controller/Productos/marca.controlador.php');
// require_once('Controller/Productos/rubro.controlador.php');
// require_once('Model/Productos/marca.php');
// require_once('Model/Productos/rubro.php');




$plantilla = new PlantillaControlador();

$plantilla->traerPlantilla();

if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
}