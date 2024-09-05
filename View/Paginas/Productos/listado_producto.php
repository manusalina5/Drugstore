<h1 class="text-center">Lista de productos</h1>
<div class=" boton-agregar">
    <a href="index.php?page=alta_producto&modulo=productos" class="btn btn-success">Agregar nuevo Producto</a>

</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar producto">
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Codigo de Barras</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Cantidad Min</th>
            <th scope="col">Precio Costo</th>
            <th scope="col">Precio Venta</th>
            <th scope="col">Marca</th>
            <th scope="col">Rubro</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaProductos">
        <!-- Aquí se cargarán las personas desde el script de JavasCript -->
    </tbody>
</table>


<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de productos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_producto.js"></script>