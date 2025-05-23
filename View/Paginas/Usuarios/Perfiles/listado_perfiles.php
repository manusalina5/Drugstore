<h1 class="text-center">Lista de perfiles</h1>
<div class="boton-agregar">
    <a href="index.php?page=alta_perfiles&modulo=usuarios&submodulo=perfiles" class="btn btn-success">Agregar Perfil</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Usuario/perfiles.php');
        $perfilesObj = new Perfil();
        $perfiles = $perfilesObj->obtenerPerfiles();
        if (!empty($perfiles)) {
            foreach ($perfiles as $perfil) {
                echo "<tr>";
                echo "<td scope='row'>{$perfil['idPerfiles']}</td>";
                echo "<td scope='row'>{$perfil['nombre']}</td>";
                echo "<td scope='row'>
                <form action='?page=accesos_perfiles&modulo=usuarios&idPerfiles={$perfil['idPerfiles']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='accesos_perfiles'>
                    <input type='hidden' name='modulo' value='usuarios'>
                    <input type='hidden' name='idPerfiles' value='{$perfil['idPerfiles']}'>
                    <button type='submit' class='btn btn-info btn-sm' title='Configurar Accesos'>
                        <i class='fi fi-rr-settings'></i>
                    </button>
                </form>
                <form action='?page=editar_perfiles&modulo=usuarios&idPerfiles={$perfil['idPerfiles']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_perfiles'>
                    <input type='hidden' name='modulo' value='usuarios'>
                    <input type='hidden' name='submodulo' value='perfiles'>
                    <input type='hidden' name='idPerfiles' value='{$perfil['idPerfiles']}'>
                    <button type='submit' class='btn btn-warning btn-sm' title='Editar Perfil'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Usuario/Perfiles/perfiles.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idPerfiles' value='{$perfil['idPerfiles']}'>
                    <button type='submit' class='btn btn-danger btn-sm' title='Eliminar Perfil' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este perfil?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center'>No hay perfiles registrados</div>";
        }
        ?>
    </tbody>
</table>
