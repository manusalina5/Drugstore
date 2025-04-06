<?php
include_once("Model/Ventas/tipo_descuento.php");
$tiposDescuento = TipoDescuento::listarTipoDescuento();
?>
<h1 class="text-center">CREAR NUEVO COMBO</h1>

<!-- Barra de Progreso -->
<div class="mt-3">
    <div class="progress mb-4" style="height: 25px">
        <div id="progress-bar" class="progress-bar progress-bar-animated progress-bar-striped bg-success"
            role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Paso 1 de 2
        </div>
    </div>
</div>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <!-- Formulario para el primer paso -->
        <form id="form-step1" action="Controller/Ventas/combo.controlador.php?action=registro" method="post">
            <input type="hidden" name="id">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input id="nombre" type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Valor Descuento:</label>
                <input id="valor" type="number" name="valorDescuento" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tipo de Descuento:</label>
                <select name="tipoDescuento_idtipoDescuento" class="form-select" id="tipodescuento">
                    <?php foreach ($tiposDescuento as $tipo) { ?>
                        <option value="<?php echo $tipo['idtipoDescuento']; ?>">
                            <?php echo $tipo['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de Vencimiento:</label>
                <input type="date" name="fechaVencimiento" class="form-control" id="fechavencimiento">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" id="next-step">Siguiente</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>

<!-- Contenido del Paso 2 (inicialmente oculto) -->
<div id="step2-content" style="display: none;">
    <div class="row">
        <!-- Área de Búsqueda -->
        <div class="col-md-3">
            <h5>Buscar Producto</h5>
            <input type="text" id="busqueda" class="form-control mb-3" placeholder="Buscar producto">
            <label for="ordenarPor" class="me-2">Ordenar por:</label>
            <select id="ordenarPor" class="form-select mb-2">
                <option value="">Seleccionar...</option>
                <option value="nombre">Nombre del Producto</option>
                <option value="marca">Marca</option>
                <option value="rubro">Rubro</option>
                <option value="cantidad">Cantidad</option>
                <option value="precioCosto">Precio Costo</option>
                <option value="precioVenta">Precio Venta</option>
            </select>
            <select id="tipoOrden" class="form-select mb-3">
                <option value="ASC">Ascendente</option>
                <option value="DESC">Descendente</option>
            </select>
        </div>

        <!-- Área de Lista de Productos -->
        <div class="col-md-5">
            <h5>Lista de Productos</h5>
            <ul id="product-list-container" class="list-group mb-3"></ul>
            <nav aria-label="Page navigation" class="mt-2">
                <ul class="pagination justify-content-center" id="paginacion"></ul>
            </nav>
        </div>

        <!-- Panel de Productos Seleccionados -->
        <div class="col-md-4">
            <h5>Productos Seleccionados</h5>
            <ul id="selected-products-container" class="list-group mb-3"></ul>
            <button id="btnGuardarCombo" type="button" class="btn btn-success">Guardar Combo</button>
        </div>
    </div>
</div>

<script src="Assets/js/Buscadores/buscar_productocombo.js"></script>
<script src="Assets\js\Funciones\combos.js" ></script>