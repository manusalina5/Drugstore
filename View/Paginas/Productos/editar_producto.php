<?php
include_once 'Model/Productos/producto.php';
include_once 'config/conexion.php';

if(isset($_GET['idProductos'])) {
    $id = $_GET['idProductos']; 

    $producto = new Producto();
    $producto->setId($id);
    $productoData = $producto->obtenerProductosPorId();
}
?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Modificar Producto</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" class="" action="Controller/Productos/producto.controlador.php" method="POST" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idProductos" value="<?php echo $productoData['idProductos']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo $productoData['nombre']; ?>">
            </div>
            <div class="mb-3">
                <label for="codBarras" class="form-label">Codigo de Barras</label>
                <input type="text" class="form-control" id="codBarras" name="codBarras" required value="<?php echo $productoData['codBarras']; ?>">
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required value="<?php echo $productoData['cantidad']; ?>">
            </div>
            <div class="mb-3">
                <label for="cantidadMin" class="form-label">Cantidad Minima</label>
                <input type="number" class="form-control" id="cantidadMin" name="cantidadMin" required value="<?php echo $productoData['cantidadMin']; ?>">
            </div>
            <div class="mb-3">
                <label for="precioCosto" class="form-label">Precio Costo</label>
                <input type="text" class="form-control" id="precioCosto" name="precioCosto" required value="<?php echo $productoData['precioCosto']; ?>">
            </div>
            <div class="mb-3">
                <label for="precioVenta" class="form-label">Precio Venta</label>
                <input type="text" class="form-control" id="precioVenta" name="precioVenta" required value="<?php echo $productoData['precioVenta']; ?>">
            </div>
            <div class="mb-3">
                <select class="form-select" aria-label="Default select example" required name="marcaId" id="marca" >
                    <?php
                    include_once('Model/Productos/marca.php');
                    $marcasObj = new Marca();
                    $marcas = $marcasObj->obtenerMarcas();
                    $marcaEdit = new Marca();
                    $marcaEdit->setId($productoData['Marca_idMarca']);
                    $marcaData = $marcaEdit->obtenerMarcaPorId();
                    echo "<option selected value=".$marcaData['idmarca'].">{$marcaData['nombre']}</option>";
                    if (!empty($marcas)) {
                        foreach ($marcas as $marca) {
                            echo "<option value='{$marca['idmarca']}'>{$marca['nombre']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <select class="form-select" aria-label="Default select example" required name="rubroId" id="rubro">
                    <?php
                    include_once('Model/Productos/rubro.php');
                    $rubroObj = new Rubro();
                    $rubros = $rubroObj->obtenerRubros();
                    $rubroEdit = new Rubro();
                    $rubroEdit->setId($productoData['Rubro_idRubros']);
                    $rubroData = $rubroEdit->obtenerRubrosPorId();
                    echo "<option selected value=".$rubroData['idRubros'].">{$rubroData['nombre']}</option>";
                    if (!empty($rubros)) {
                        foreach ($rubros as $rubro) {
                            echo "<option value='{$rubro['idRubros']}'>{$rubro['nombre']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="d-grid gap-1">
            <button type="submit" class="btn btn-success">Modificar</button>
            </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#marca').select2({
            placeholder: "Elija la marca",
            allowClear: true
        });
    });
    $(document).ready(function() {
        $('#rubro').select2({
            placeholder: "Elija el rubro",
            allowClear: true
        });
    });
</script>

<script src="Assets/js/Validaciones/alta_producto.js"></script>