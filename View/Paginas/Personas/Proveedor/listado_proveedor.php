<h2 class="text-center">Proveedores</h2>
<div class=" boton-agregar">
    <a href="index.php?page=alta_proveedor&modulo=personas&submodulo=proveedor" class="btn btn-success">Agregar Proveedor</a>
</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar proveedor">
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
    <tbody id="tablaProveedores">
    
</tbody>
</table>

<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de proveedores -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_proveedor.js"></script>