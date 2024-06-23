<h1 class="text-center">Lista de usuarios</h1>
<div class=" boton-agregar">
    <a href="index.php?page=registro&modulo=usuarios" class="btn btn-success">Agregar nuevo usuario</a>

</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre de Usuario</th>
            <th scope="col">Perfil</th>
            <th scope="col">Fecha Alta</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Usuario/usuarios.php');
        $usuarioObj = new Usuario();
        $usuarios = $usuarioObj->obtenerUsuarios();
        if (!empty($usuarios)) {
            foreach ($usuarios as $usuario) {
                echo "<tr>";
                echo "<td scope='row'>{$usuario['idusuario']}</td>";
                echo "<td scope='row'>{$usuario['username']}</td>";
                echo "<td scope='row'>{$usuario['nombre']}</td>";
                echo "<td scope='row'>{$usuario['fechaalta']}</td>";

                echo "<td scope='row'>";

                // Reestablecer contraseña
                echo "<form action='Controller/Usuario/usuario.controlador.php' method='POST' style='display:inline-block; margin-right: 10px;'>";
                echo "<input type='hidden' name='action' value='reestrablecerPass'>";
                echo "<input type='hidden' name='idUsuario' value='{$usuario['idusuario']}'>";
                echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas reestablecer la contraseña?\");'>";
                echo "<i class='fi fi-rr-refresh'> Reestablecer Contraseña</i>";
                echo "</button>";
                echo "</form>";

                // Eliminar usuario
                echo "<form action='Controller/Usuario/usuario.controlador.php' method='POST' style='display:inline-block;'>";
                echo "<input type='hidden' name='action' value='eliminar'>";
                echo "<input type='hidden' name='idUsuario' value='{$usuario['idusuario']}'>";
                echo "<input type='hidden' name='username' value='{$usuario['username']}'>";
                echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar el usuario?\");'>";
                echo "<i class='fi fi-rr-trash'></i>";
                echo "</button>";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No hay usuarios registrados</td></tr>";
        }
        ?>

    </tbody>
</table>