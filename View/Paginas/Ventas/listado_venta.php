<h1 class="text-center">Lista de Ventas</h1>
<div class=" boton-agregar">
    <a href="index.php?page=alta_venta&modulo=ventas" class="btn btn-success">Agregar nueva Venta</a>

</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar venta">
</div>

<table class="table table-striped table-hover table-responsive">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Total</th>
            <th scope="col">Metodo de Pago</th>
            <th scope="col">Empleado</th>
            <th scope="col">Cliente</th>        
        </tr>
    </thead>
    <tbody id="tablaVentas">
        <!-- Aquí se cargarán los productos desde el script de JavasCript -->
    </tbody>
</table>


<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de productos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_venta.js"></script>