<?php

include_once '../../Model/Usuario/perfilModulo.php';
include_once '../../config/conexion.php';

// var_dump($_POST['perfil']);

// exit();

$perfil_modulo = new PerfilModulo();

$perfil_id = $_POST['perfil'];
$modulos = $_POST['modulos'];

$perfil_modulo->guardarModulosPorPerfil($perfil_id, $modulos);

header('Location: ../../index.php?page=accesos_perfiles&modulo=usuarios&mensaje=Accesos modificados correctamente&status=success');
