<h2 class="text-center">Lista de Tipo de Documentos</h2>
<div class=" boton-agregar">
    <a href="index.php?page=alta_tipodocumento&modulo=personas&submodulo=documento" class="btn btn-success">Agregar Tipo Documento</a>
</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar tipo de documento">
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Valor</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaTipoDocumentos">
        <?php
        include_once('Model/Personas/Documento/tipodocumento.php');
        $tipodocumentoObj = new TipoDocumento();
        $tipodocumentos = $tipodocumentoObj->obtenerTipoDocumentos();
        if (!empty($tipodocumentos)) {
            foreach ($tipodocumentos as $tipodocumento) {
                echo "<tr>";
                echo "<td scope='row'>{$tipodocumento['idtipoDocumentos']}</td>";
                echo "<td scope='row'>{$tipodocumento['valor']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_tipodocumento&modulo=personas&submodulo=documento&id={$tipodocumento['idtipoDocumentos']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_tipodocumento'>
                    <input type='hidden' name='modulo' value='Personas'>
                    <input type='hidden' name='submodulo' value='Documento'>
                    <input type='hidden' name='id' value='{$tipodocumento['idtipoDocumentos']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Personas/Documento/tipodocumento.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idtipodocumento' value='{$tipodocumento['idtipoDocumentos']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este tipo de documento?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center alert alert-warning'>No hay tipos de documentos registrados</div>";
        }

        ?>
    </tbody>
</table>

<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de tipo de documentos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_tipodocumento.js"></script>