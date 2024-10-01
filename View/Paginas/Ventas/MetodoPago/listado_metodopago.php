<h2 class="text-center">Métodos de Pago</h2>
<div class=" boton-agregar">
    <a href="index.php?page=alta_metodopago&modulo=ventas&submodulo=metodopago" class="btn btn-success">Agregar Metodo de Pago</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Ventas/MetodoPago/metodopago.php');
        $metodopagoObj = new MetodoPago();
        $metodopagos = $metodopagoObj->obtenerMetodoPago();
        if (!empty($metodopagos)) {
            foreach ($metodopagos as $metodopago) {
                echo "<tr>";
                echo "<td scope='row'>{$metodopago['nombre']}</td>";
                echo "<td scope='row'>{$metodopago['descripcion']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_metodopago&modulo=ventas&submodulo=metodopago&id={$metodopago['idmetodoPago']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_metodopago'>
                    <input type='hidden' name='modulo' value='ventas'>
                    <input type='hidden' name='submodulo' value='metodopago'>
                    <input type='hidden' name='idmetodoPago' value='{$metodopago['idmetodoPago']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Ventas/MetodoPago/metodopago.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idmetodoPago' value='{$metodopago['idmetodoPago']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este Método de Pago?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center alert alert-danger'>No hay métodos de pago registrados.</div>";
        }

        ?>
    </tbody>
</table>