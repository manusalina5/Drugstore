<h1 class="text-center">Clientes</h1>
<link rel="stylesheet" href="../../../../Assets/css/">
<div class=" boton-agregar">
    <a href="index.php?page=alta_cliente&modulo=personas&submodulo=cliente" class="btn btn-success">Agregar Cliente</a>
</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar cliente">
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Observaciones</th>
            <th scope="col">Tipo Documento</th>
            <th scope="col">Documento</th>
            <th scope="col">Tipo Contacto</th>
            <th scope="col">Contacto</th>
            <th scope="col">Fecha Alta</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaClientes">

        <!-- se carga la tabla con Javascript -->

    </tbody>

</table>


<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de clientes -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_cliente.js"></script>