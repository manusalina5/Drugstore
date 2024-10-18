<h1 class="text-center fs-1 ">Sistema de gestión de Drugstore</h1>

<?php
if(!empty($_SESSION['nombre_usuario'])){
    $username = $_SESSION['nombre_usuario'];
    echo "<h2 class='text-center fs-3'>Bienvenido<strong class='textusername'> "."@".$username. "!</strong></h2>";
}

?>



<div class="text-center">
    <img src="Assets/img/sgd-sinfondo.png" class="img-fluid" alt="...">
</div>