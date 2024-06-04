<h1 class="text-center">Lista de rubros</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Productos/rubro.php');
        $rubrosObj = new Rubro();
        $rubros = $rubrosObj->obtenerRubros();
        if (!empty($rubros)) {
            foreach ($rubros as $rubro) {
                echo "<tr>";
                echo "<td scope='row'>{$rubro['idRubros']}</td>";
                echo "<td scope='row'>{$rubro['nombre']}</td>";
                echo "<td scope='row'>
                        <a href='?page=editar_rubro&modulo=productos&id={$rubro['idRubros']} class = 'edit-icon icon'><i class='fi fi-rr-edit'></i></a>
                        </td>";
                echo "<td scope='row'>
                <form action='../../../Controller/Productos/marca.controlador.php' method='POST' style='display:inline-block;'>
                            <input type='hidden' name='action' value='eliminar'>
                            <input type='hidden' name='id' value='{$rubro['idRubros']}'>
                            <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta marca?\");'>
                                <i class='fi fi-rr-trash'></i>
                            </button>
                        </form>
                        </td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4' class='text-center alert alert-danger'>No hay rubros registrados</td></tr>";
        }

        ?>
    </tbody>
</table>