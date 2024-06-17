<h2 class="text-center">Lista de Tipo de Egresos</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Descripcion</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Caja/Egreso/tipoegreso.php');
        $tipoegresoObj = new TipoEgreso();
        $tipoegresos = $tipoegresoObj->obtenerTipoEgreso();
        if (!empty($tipoegresos)) {
            foreach ($tipoegresos as $tipoegreso) {
                echo "<tr>";
                echo "<td scope='row'>{$tipoegreso['idtipoEgresos']}</td>";
                echo "<td scope='row'>{$tipoegreso['descripcion']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_tipoegreso&modulo=caja&submodulo=egreso&id={$tipoegreso['idtipoEgresos']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_tipoegreso'>
                    <input type='hidden' name='modulo' value='caja'>
                    <input type='hidden' name='submodulo' value='egreso'>
                    <input type='hidden' name='idtipoEgresos' value='{$tipoegreso['idtipoEgresos']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Caja/Egreso/tipoegreso.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idtipoEgresos' value='{$tipoegreso['idtipoEgresos']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este tipo de Egreso?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center alert alert-danger'>No hay tipos de egreso registrados.</div>";
        }

        ?>
    </tbody>
</table>