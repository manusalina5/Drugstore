<h2 class="text-center">Empleados</h2>
<div class=" boton-agregar">
    <a href="index.php?page=alta_empleado&modulo=personas&submodulo=empleado" class="btn btn-success">Agregar Empleado</a>
</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar empleado">
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
    <tbody id="tablaEmpleados">

        <!-- se carga la tabla con Javascript -->

    </tbody>

</table>


<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de empleados -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_empleado.js"></script>