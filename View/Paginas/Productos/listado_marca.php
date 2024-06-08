<h1 class="text-center">Lista de marcas</h1>
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
        include_once('Model/Productos/marca.php');
        $marcaObj = new Marca();
        $marcas = $marcaObj->obtenerMarcas();
        if (!empty($marcas)) {
            foreach ($marcas as $marca) {
                echo "<tr>";
                echo "<td scope='row'>{$marca['idmarca']}</td>";
                echo "<td scope='row'>{$marca['nombre']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_marca&modulo=productos&id={$marca['idmarca']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_marca'>
                    <input type='hidden' name='modulo' value='productos'>
                    <input type='hidden' name='id' value='{$marca['idmarca']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Productos/marca.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='id' value='{$marca['idmarca']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta marca?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
            echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center'>No hay marcas registradas</div>";
        }

        ?>
    </tbody>
</table>