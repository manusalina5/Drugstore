<h2 class="text-center">Lista de Tipo de contactos</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Valor</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Personas/Contacto/tipocontacto.php');
        $tipocontactoObj = new TipoContacto();
        $tipocontactos = $tipocontactoObj->obtenerTipoContacto();
        if (!empty($tipocontactos)) {
            foreach ($tipocontactos as $tipocontacto) {
                echo "<tr>";
                echo "<td scope='row'>{$tipocontacto['idtipoContacto']}</td>";
                echo "<td scope='row'>{$tipocontacto['valor']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_tipocontacto&modulo=personas&submodulo=contacto&id={$tipocontacto['idtipoContacto']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_tipocontacto'>
                    <input type='hidden' name='modulo' value='Personas'>
                    <input type='hidden' name='submodulo' value='contacto'>
                    <input type='hidden' name='idtipocontacto' value='{$tipocontacto['idtipoContacto']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Personas/contacto/tipocontacto.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idtipocontacto' value='{$tipocontacto['idtipoContacto']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este tipo de contacto?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center alert alert-warning'>No hay tipos de contactos registrados</div>";
        }

        ?>
    </tbody>
</table>