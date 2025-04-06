<?php

require_once('Model/Usuario/usuarios.php');
require_once('Controller/plantilla.controlador.php');

$plantilla = new PlantillaControlador();

$plantilla->traerPlantilla();

if (isset($_GET['error'])) {
    echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
}

echo "<link rel='stylesheet' href='Assets/css/style.css'>";