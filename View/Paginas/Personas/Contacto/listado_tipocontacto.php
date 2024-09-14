<h2 class="text-center">Lista de Tipo de contactos</h2>
<div class=" boton-agregar">
    <a href="index.php?page=alta_tipocontacto&modulo=personas&submodulo=contacto" class="btn btn-success">Agregar Tipo Contacto</a>
</div>


<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar marca">
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Valor</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaTipoContactos">
        
    </tbody>
</table>

<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de productos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_tipocontacto.js"></script>