<h1 class="text-center">Lista de usuarios</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include_once('Model/usuarios.php');
            $usuarioObj = new Usuario();
            $usuarios = $usuarioObj->obtenerUsuarios();
            if(!empty($usuarios)){
                foreach($usuarios as $usuario){
                    echo "<tr>";
                    echo "<td scope='row'>{$usuario['id']}</td>";
                    echo "<td scope='row'>{$usuario['username']}</td>";
                    echo "<td scope='row'>{$usuario['email']}</td>";
                    echo "</tr>";
                }
            }else{
                echo "<tr><td colspan='3' class='text-center'>No hay usuarios registrados</td></tr>";
            }

        ?>
    </tbody>
</table>