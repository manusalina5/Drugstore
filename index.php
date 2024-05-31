<?php

require_once('Model/usuarios.php');
require_once('Controller/plantilla.controlador.php');
# require_once('Controller/login.controlador.php');


$plantilla = new PlantillaControlador();

$plantilla->traerPlantilla();