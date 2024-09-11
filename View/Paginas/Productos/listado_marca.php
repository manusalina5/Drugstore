<h1 class="text-center">Lista de marcas</h1>
<div class=" boton-agregar">
    <a href="index.php?page=alta_marca&modulo=productos" class="btn btn-success">Agregar Marca</a>
</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar marca">
</div>


<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaMarcas">
        <!-- Aquí se cargarán las marcas desde el script de JavasCript -->
    </tbody>
</table>


<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de productos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_marca.js"></script>