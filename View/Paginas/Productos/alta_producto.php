<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Registrar Producto</h1>
        <div class="d-grid gap-1">
                <a href="?page=listado_producto&modulo=productos" class="btn btn-primary">Listado</a>
            </div>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" class="" action="Controller/Productos/producto.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <!-- Código de Barras -->
            <div class="mb-3">
                <label for="codBarras" class="form-label">Codigo de Barras</label>
                <input type="text" class="form-control" id="codBarras" name="codBarras" required>
            </div>

            <!-- Cantidad -->
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" required>
            </div>

            <!-- Cantidad Mínima -->
            <div class="mb-3">
                <label for="cantidadMin" class="form-label">Cantidad Minima</label>
                <input type="number" class="form-control" id="cantidadMin" name="cantidadMin" required>
            </div>

            <!-- Precio Costo -->
            <div class="mb-3">
                <label for="precioCosto" class="form-label">Precio Costo</label>
                <input type="text" class="form-control" id="precioCosto" name="precioCosto" required>
            </div>

            <!-- Precio Venta -->
            <div class="mb-3">
                <label for="precioVenta" class="form-label">Precio Venta</label>
                <input type="text" class="form-control" id="precioVenta" name="precioVenta" required>
            </div>

            <!-- Select Marca -->
            <div class="mb-3">
                <select class="form-select" aria-label="Select Marcas" required name="marcaId" id="marca">
                    <option selected>Elegir la marca</option>
                    <?php
                    include_once('Model/Productos/marca.php');
                    $marcaObj = new Marca();
                    $marcas = $marcaObj->obtenerMarcas();
                    if (!empty($marcas)) {
                        foreach ($marcas as $marca) {
                            echo "<option value='{$marca['idmarca']}'>{$marca['nombre']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Select Rubro -->
            <div class="mb-3">
                <select class="form-select" aria-label="Select Rubros" required name="rubroId" id="rubro">
                    <option selected>Elegir el rubro</option>
                    <?php
                    include_once('Model/Productos/rubro.php');
                    $rubroObj = new Rubro();
                    $rubros = $rubroObj->obtenerRubros();
                    if (!empty($rubros)) {
                        foreach ($rubros as $rubro) {
                            echo "<option value='{$rubro['idRubros']}'>{$rubro['nombre']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="d-grid gap-1">
                <button id='formbutton' type="button" class="btn btn-success">Agregar</button>
            </div>
            <hr>    
        </form>
    </div>
    <div class="col"></div>
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


<script type='module' src="Assets/js/Validaciones/alta_producto.js"></script>