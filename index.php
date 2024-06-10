<?php

require_once('Model/Usuarios/usuarios.php');
require_once('Controller/plantilla.controlador.php');
// require_once('Controller/Productos/marca.controlador.php');
// require_once('Controller/Productos/rubro.controlador.php');
// require_once('Model/Productos/marca.php');
// require_once('Model/Productos/rubro.php');



$plantilla = new PlantillaControlador();

$plantilla->traerPlantilla();