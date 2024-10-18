<h1 class="text-center">Lista de Personas</h1>

<!-- Campo de búsqueda -->
<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar por nombre o apellido">
</div>

<!-- Tabla -->
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaPersonas">
        <!-- Aquí se cargarán las personas desde el script de JavaScript -->
    </tbody>
</table>

<!-- Paginación -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- La paginación se generará dinámicamente -->
    </ul>
</nav>

<!-- Script de JavaScript -->
<script src="Assets/js/Buscadores/buscar_persona.js"></script>