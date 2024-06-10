<h1 class="text-center">Lista de productos</h1>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Codigo de Barras</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Cantidad Min</th>
            <th scope="col">Precio Costo</th>
            <th scope="col">Precio Venta</th>
            <th scope="col">Marca</th>
            <th scope="col">Rubro</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <?php
        include_once('Model/Productos/producto.php');
        include_once 'Model/Productos/marca.php';
        include_once 'Model/Productos/rubro.php';
        $productoObj = new Producto();
        $productos = $productoObj->obtenerProductos();
        if (!empty($productos)) {
            foreach ($productos as $producto) {
                $marca = new Marca();
                $marca->setId($producto['Marca_idMarca']);
                $marcaData = $marca->obtenerMarcaPorId();
                $rubro = new Rubro();
                $rubro->setId($producto['Rubro_idRubros']);
                $rubroData = $rubro->obtenerRubrosPorId();
                echo "<tr>";
                echo "<td scope='row'>{$producto['idProductos']}</td>";
                echo "<td scope='row'>{$producto['nombre']}</td>";
                echo "<td scope='row'>{$producto['codBarras']}</td>";
                echo "<td scope='row'>{$producto['cantidad']}</td>";
                echo "<td scope='row'>{$producto['cantidadMin']}</td>";
                echo "<td scope='row'>{$producto['precioCosto']}</td>";
                echo "<td scope='row'>{$producto['precioVenta']}</td>";
                echo "<td scope='row'>{$marcaData['nombre']}</td>";
                echo "<td scope='row'>{$rubroData['nombre']}</td>";
                echo "<td scope='row'>
                <form action='?page=editar_producto&modulo=productos&id={$producto['idProductos']}' method='GET' style='display:inline-block;'>
                    <input type='hidden' name='page' value='editar_producto'>
                    <input type='hidden' name='modulo' value='productos'>
                    <input type='hidden' name='idProductos' value='{$producto['idProductos']}'>
                    <button type='submit' class='btn btn-warning btn-sm'>
                        <i class='fi fi-rr-edit'></i>
                    </button>
                </form>
                <form action='Controller/Productos/producto.controlador.php' method='POST' style='display:inline-block;'>
                    <input type='hidden' name='action' value='eliminar'>
                    <input type='hidden' name='idProductos' value='{$producto['idProductos']}'>
                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta producto?\");'>
                        <i class='fi fi-rr-trash'></i>
                    </button>
                </form>
                </td>";
                echo "</tr>";
            }
        } else {
            echo "<div colspan='3' class='text-center'>No hay productos registradas</div>";
        }

        ?>
    </tbody>
</table>