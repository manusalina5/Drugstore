<h1 class="text-center">Lista de rubros</h1>
<div class=" boton-agregar">
    <a href="index.php?page=alta_rubro&modulo=productos" class="btn btn-success">Agregar Rubro</a>
</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar rubro">
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaRubros">
        
    </tbody>
</table>

<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de productos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_rubro.js"></script>