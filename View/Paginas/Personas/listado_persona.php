<h2 class="text-center">Lista de Personas</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Personas/persona.php');
        $personaObj = new Persona();
        $personas = $personaObj->obtenerPersonas();
        if (!empty($personas)) {
            foreach ($personas as $persona) {
                echo "<tr>";
                echo "<td scope='row'>{$persona['idPersona']}</td>";
                echo "<td scope='row'>{$persona['nombre']}</td>";
                echo "<td scope='row'>{$persona['apellido']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_persona&modulo=personas&id={$persona['idPersona']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_persona'>
                    <input type='hidden' name='modulo' value='Personas'>
                    <input type='hidden' name='idPersona' value='{$persona['idPersona']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Personas/persona.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idPersona' value='{$persona['idPersona']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta persona?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center alert alert-warning'>No hay personas registradas</div>";
        }

        ?>
    </tbody>
</table>