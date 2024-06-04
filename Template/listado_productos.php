<?php
include_once 'model/conexion.php';
$db = new Conexion();

$where = "";

if (isset($_GET['enviar'])) {
    $busqueda = $_GET['busqueda'];

    if (!empty($busqueda)) {
        $where = "WHERE nombre_producto LIKE '%" . $busqueda . "%'";
    }
}

$result = $db->consultar("SELECT productos.*, marcas.nombre AS nombre_marca FROM productos INNER JOIN marcas ON productos.id_marcas = marcas.id_marcas $where");

?>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-4 mx-auto text-center">
                <form class="form-inline" action="" method="get">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control form-control-lg" placeholder="Buscar productos" name="busqueda">
                        <button class="btn btn-primary btn-lg ms-2" type="submit" name="enviar"><b>Buscar</b></button>
                    </div>
                </form>
                <div class="d-flex justify-content-center">
                    <a href="/Drugstore/registro_productos.php" class="btn btn-success btn-lg me-2"><b>Agregar</b></a>
                    <a href="/Drugstore/inc/exportar_excel.php" class="btn btn-primary btn-lg">
                        <b>Exportar a Excel</b>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-6 p-4 text-center container">
    <table class="table">
        <h3 class="text-center text-secondary p-2">Lista de productos</h3>
        <thead class="table-info">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio Costo</th>
                <th scope="col">Precio Venta</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Cantidad Min</th>
                <th scope="col">Marca</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Mostrar la tabla con los productos
                while ($datos = $result->fetch_object()) { ?>
                    <tr class="">
                        <td><?= $datos->id_producto ?></td>
                        <td><?= $datos->nombre_producto ?></td>
                        <td><?= $datos->precio_costo ?></td>
                        <td><?= $datos->precio_venta ?></td>
                        <td><?= $datos->cantidad ?></td>
                        <td><?= $datos->cantidad_min ?></td>
                        <td><?= $datos->nombre_marca ?></td>
                        <td>
                            <a href="modificar_producto.php?id=<?= $datos->id_producto ?> " class="btn btn-small btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg></a>
                        </td>
                        <td>
                            <a onclick="return eliminar()" href="listado_productos.php?id=<?= $datos->id_producto ?>" class="btn btn-small btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
            <?php }
            } else {
                // Mostrar un mensaje cuando no hay productos
                echo '<div class="alert alert-danger py-2 text-center">No hay productos registrados</div>';
            }
            ?>
        </tbody>
    </table>
</div>

</div>