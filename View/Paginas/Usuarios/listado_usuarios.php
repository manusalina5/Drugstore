<div class=" boton-agregar">
    <a href="index.php?page=registro&modulo=usuarios" class="btn btn-success">Agregar nuevo usuario</a>

</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar usuario">
</div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Nombre de Usuario</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Perfil</th>
            <th scope="col">Fecha Alta</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="tablaUsuarios">
        

    </tbody>
</table>

<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de productos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_usuarios.js"></script>