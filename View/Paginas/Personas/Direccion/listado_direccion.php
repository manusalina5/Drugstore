<h2 class="text-center">Lista de Direcciones</h2>
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
        include_once('Model/Personas/Direccion/direccion.php');
        $direccionObj = new Direccion();
        $direcciones = $direccionObj->obtenerDireccion();
        if (!empty($direccion)) {
            foreach ($direcciones as $direccion) {
                echo "<tr>";
                echo "<td scope='row'>{$direccion['iddireccion']}</td>";
                echo "<td scope='row'>{$direccion['descripcion']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_tipocontacto&modulo=personas&submodulo=contacto&id={$direccion['iddireccion']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_direccion'>
                    <input type='hidden' name='modulo' value='Personas'>
                    <input type='hidden' name='submodulo' value='direccion'>
                    <input type='hidden' name='iddireccion' value='{$direccion['iddireccion']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Personas/direccion/direccion.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idtipocontacto' value='{$direccion['iddireccion']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este tipo de contacto?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center alert alert-warning'>No hay direcciones registradas</div>";
        }

        ?>
    </tbody>
</table>