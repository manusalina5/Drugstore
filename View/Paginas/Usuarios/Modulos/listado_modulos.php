<h1 class="text-center">Lista de modulos</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Usuario/modulos.php');
        $modulosObj = new Modulos();
        $modulos = $modulosObj->obtenerModulos();
        if (!empty($modulos)) {
            foreach ($modulos as $modulo) {
                echo "<tr>";
                echo "<td scope='row'>{$modulo['idmodulos']}</td>";
                echo "<td scope='row'>{$modulo['nombre']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_modulos&modulo=usuarios&idModulos={$modulo['idmodulos']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_modulos'>
                    <input type='hidden' name='modulo' value='usuarios'>
                    <input type='hidden' name='submodulo' value='modulos'>
                    <input type='hidden' name='idmodulos' value='{$modulo['idmodulos']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Usuario/Modulos/modulo.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idmodulos' value='{$modulo['idmodulos']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este modulo?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center'>No hay modulos registrados</div>";
        }

        ?>
    </tbody>
</table>