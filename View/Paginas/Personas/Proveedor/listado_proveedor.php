<h2 class="text-center">Proveedores</h2>
<div class=" boton-agregar">
    <a href="index.php?page=alta_proveedor&modulo=personas&submodulo=proveedor" class="btn btn-success">Agregar Proveedor</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Razon Social</th>
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
    include_once('Model/Personas/Proveedor/proveedor.php');
    include_once('Model/Personas/Documento/documento.php');
    include_once('Model/Personas/Contacto/Contacto.php');

    $proveedorObj = new Proveedor();
    $proveedores = $proveedorObj->obtenerProveedores();
    $documento = new Documento();
    
    if(!empty($proveedores)){
        foreach ($proveedores as $proveedor) {
            $documento = new Documento();
            $documento->setPersonaId($proveedor['idPersona']);
            $documentoData = $documento->obtenerDocumentoPorId();
            $contacto = new Contacto();
            $contacto->setPersona_idPersona($proveedor['idPersona']);
            $contactoData = $contacto->obtenerContactoPorId();
            echo "<tr>";
            echo "<td scope='row'>{$proveedor['idProveedor']}</td>";
            echo "<td scope='row'>{$proveedor['nombre']}</td>";
            echo "<td scope='row'>{$proveedor['apellido']}</td>";
            echo "<td scope='row'>{$proveedor['razonSocial']}</td>";
            echo "<td scope='row'>{$documentoData['valorTipoDocumentos']}</td>";
            echo "<td scope='row'>{$documentoData['valorDocumento']}</td>";
            echo "<td scope='row'>{$contactoData['valorTipoContactos']}</td>";
            echo "<td scope='row'>{$contactoData['valorContacto']}</td>";
            echo "<td scope='row'>{$proveedor['fechaAlta']}</td>";
            echo "<td scope='row'>";
            
            // Formulario de edición
            echo "<form action='?page=editar_proveedor&modulo=personas&submodulo=proveedor&id={$proveedor['idProveedor']}' method='GET' style='display:inline-block;'>";
            echo "<input type='hidden' name='page' value='editar_proveedor'>";
            echo "<input type='hidden' name='modulo' value='Personas'>";
            echo "<input type='hidden' name='submodulo' value='proveedor'>";
            echo "<input type='hidden' name='idProveedor' value='{$proveedor['idProveedor']}'>";
            echo "<input type='hidden' name='idPersona' value='{$proveedor['idPersona']}'>";
            echo "<button type='submit' class='btn btn-warning btn-sm'>";
            echo "<i class='fi fi-rr-edit'></i>";
            echo "</button>";
            echo "</form>";

            // Formulario de eliminación
            echo " ";
            echo "<form action='Controller/Personas/Proveedor/proveedor.controlador.php' method='POST' style='display:inline-block;'>";
            echo "<input type='hidden' name='action' value='eliminar'>";
            echo "<input type='hidden' name='idProveedor' value='{$proveedor['idProveedor']}'>";
            echo "<input type='hidden' name='idPersona' value='{$proveedor['idPersona']}'>";
            echo "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este proveedor?\");'>";
            echo "<i class='fi fi-rr-trash'></i>";
            echo "</button>";
            echo "</form>";

            echo "</td>";
            echo "</tr>";
        }}
    else {
        echo "<div colspan='8' class='text-center alert alert-warning'>No hay proveedores registrados</div>";
    }
    ?>
</tbody>

</table>