<h2 class="text-center">Empleados</h2>
<div class=" boton-agregar">
    <a href="index.php?page=alta_empleado&modulo=personas&submodulo=empleado" class="btn btn-success">Agregar Empleado</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Legajo</th>
            <th scope="col">Tipo Documento</th>
            <th scope="col">Documento</th>
            <th scope="col">Tipo Contacto</th>
            <th scope="col">Contacto</th>
            <th scope="col">Fecha Alta</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php
    include_once('Model/Personas/Empleado/empleado.php');
    include_once('Model/Personas/Documento/documento.php');
    include_once('Model/Personas/Contacto/Contacto.php');

    $empleadoObj = new Empleado();
    $empleados = $empleadoObj->obtenerEmpleados();
    $documento = new Documento();
    
    if(!empty($empleados)){
        foreach ($empleados as $empleado) {
            $documento = new Documento();
            $documento->setPersonaId($empleado['idPersona']);
            $documentoData = $documento->obtenerDocumentoPorId();
            $contacto = new Contacto();
            $contacto->setPersona_idPersona($empleado['idPersona']);
            $contactoData = $contacto->obtenerContactoPorId();
            echo "<tr>";
            echo "<td scope='row'>{$empleado['idEmpleado']}</td>";
            echo "<td scope='row'>{$empleado['nombre']}</td>";
            echo "<td scope='row'>{$empleado['apellido']}</td>";
            echo "<td scope='row'>{$empleado['legajo']}</td>";
            echo "<td scope='row'>{$documentoData['valorTipoDocumentos']}</td>";
            echo "<td scope='row'>{$documentoData['valorDocumento']}</td>";
            echo "<td scope='row'>{$contactoData['valorTipoContactos']}</td>";
            echo "<td scope='row'>{$contactoData['valorContacto']}</td>";
            echo "<td scope='row'>{$empleado['fechaAlta']}</td>";
            echo "<td scope='row'>";
            
            // Formulario de edición
            echo "<form action='?page=editar_empleado&modulo=personas&submodulo=empleado&id={$empleado['idEmpleado']}' method='GET' style='display:inline-block;'>";
            echo "<input type='hidden' name='page' value='editar_empleado'>";
            echo "<input type='hidden' name='modulo' value='Personas'>";
            echo "<input type='hidden' name='submodulo' value='Empleado'>";
            echo "<input type='hidden' name='idEmpleado' value='{$empleado['idEmpleado']}'>";
            echo "<input type='hidden' name='idPersona' value='{$empleado['idPersona']}'>";
            echo "<button type='submit' class='btn btn-warning btn-sm'>";
            echo "<i class='fi fi-rr-edit'></i>";
            echo "</button>";
            echo "</form>";

            // Formulario de eliminación
            echo " ";
            echo "<form action='Controller/Personas/Empleado/empleado.controlador.php' method='POST' style='display:inline-block;'>";
            echo "<input type='hidden' name='action' value='eliminar'>";
            echo "<input type='hidden' name='idEmpleado' value='{$empleado['idEmpleado']}'>";
            echo "<input type='hidden' name='idPersona' value='{$empleado['idPersona']}'>";
            echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este empleado?\");'>";
            echo "<i class='fi fi-rr-trash'></i>";
            echo "</button>";
            echo "</form>";

            echo "</td>";
            echo "</tr>";
        }}
    else {
        echo "<tr><td colspan='4' class='text-center alert alert-warning'>No hay empleados registradas</td></tr>";
    }
    ?>
</tbody>

</table>