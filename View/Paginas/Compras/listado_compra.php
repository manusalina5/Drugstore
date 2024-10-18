<h1 class="text-center">Compras</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once 'Model/Compras/compras.php';
        $compraObj = new Compra();
        $compras = $compraObj->obtenerCompra();
        if (!empty($compras)) {
            foreach ($compras as $compra) {
                echo "<tr>";
                echo "<td scope='row'>{$compra['fechaCompra']}</td>";
                echo "<td scope='row'>{$compra['horaCompra']}</td>";
                echo "<td scope='row'>{$compra['totalCompra']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_compra&modulo=compras&submodulo=compra&id={$compra['idCompra']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_compra'>
                    <input type='hidden' name='modulo' value='compras'>
                    <input type='hidden' name='submodulo' value='compra'>
                    <input type='hidden' name='idCompra' value='{$compra['idCompra']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Compras/Compra/compra.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idCompra' value='{$compra['idCompra']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta Compra?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center alert alert-danger'>No hay compras registradas.</div>";
        }

        ?>
    </tbody>
</table>