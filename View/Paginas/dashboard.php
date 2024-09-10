<?php
if(!empty($_SESSION['nombre_usuario'])){
    $username = $_SESSION['nombre_usuario'];
    echo "<h1 class='text-center'>Bienvenido<strong class='textusername'> ". $username. "!</strong></h1>";
}

?>

<h2 class="text-center">Sistema de gestión de Drugstore</h2>

<div class="text-center">
    <img src="Assets/img/sgd.png" class="img-fluid" alt="...">
</div>