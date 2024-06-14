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
            echo "<td scope='row'>";
            
            // Formulario de edición
            echo "<form action='?page=editar_persona&modulo=personas&id={$persona['idPersona']}' method='GET' style='display:inline-block;'>";
            echo "<input type='hidden' name='page' value='editar_persona'>";
            echo "<input type='hidden' name='modulo' value='Personas'>";
            echo "<input type='hidden' name='idPersona' value='{$persona['idPersona']}'>";
            echo "<button type='submit' class='btn btn-warning btn-sm'>";
            echo "<i class='fi fi-rr-edit'></i>";
            echo "</button>";
            echo "</form>";

            // Formulario de eliminación
            echo " ";
            echo "<form action='Controller/Personas/persona.controlador.php' method='POST' style='display:inline-block;'>";
            echo "<input type='hidden' name='action' value='eliminar'>";
            echo "<input type='hidden' name='idPersona' value='{$persona['idPersona']}'>";
            echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta persona?\");'>";
            echo "<i class='fi fi-rr-trash'></i>";
            echo "</button>";
            echo "</form>";

            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4' class='text-center alert alert-warning'>No hay personas registradas</td></tr>";
    }
    ?>
</tbody>

</table>