<h1 class="text-center">Lista de productos</h1>
<div class=" boton-agregar">
    <a href="index.php?page=alta_producto&modulo=productos" class="btn btn-success">Agregar nuevo Producto</a>
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Actualizar precios
    </button>

</div>

<div class="form-group">
    <input type="text" id="busqueda" class="form-control" placeholder="Buscar producto">
</div>

<table class="table table-striped table-hover table-responsive">
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
    <tbody id="tablaProductos">
        <!-- Aquí se cargarán los productos desde el script de JavasCript -->
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Actualización de precios</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Inicio Formulario Modal -->
                <form>
                    <div class="mb-3">
                        <label for="tipoaumento" class="form-label">Tipo de Aumento</label>
                        <select class="form-select mb-3" name="tipoaumento" id="tipoaumento" aria-label="Seleccione un tipo de aumento">
                            <option value="" disabled selected>Selecciona una opción...</option>
                            <option value="rubro">Por Rubro</option>
                            <option value="marca">Por Marca</option>
                        </select>
                    </div>

                    <!-- Listado de rubro o marca -->
                    <div class="mb-3" id="listadorubromarca"></div>

                    <div class="mb-3">
                        <label for="priceOption" class="form-label">Opción de Precio</label>
                        <select class="form-control" name="priceOption" id="priceOption">
                            <option value="" disabled selected>Selecciona una opción...</option>
                            <option value="costo-utilidad">Costo Opción 1</option>
                            <option value="costo-precio">Costo Opción 2</option>
                            <option value="precioventa">Precio Venta</option>
                            <option value="utilidad">Utilidad</option>
                        </select>
                        <small class="form-text text-muted" id="mensajePriceOption"></small>
                    </div>

                    <div class="mb-3">
                        <label for="tipoMonto" class="form-label">Tipo de Monto</label>
                        <select class="form-control" name="tipoMonto" id="tipoMonto">
                            <option value="" disabled selected>Selecciona una opción...</option>
                            <option value="fijo">Monto Fijo</option>
                            <option value="porcentual">Porcentual</option>
                        </select>
                        <small class="form-text text-muted" id="mensajeTipoMonto"></small>
                    </div>

                    <div class="mb-3">
                        <label for="montoActualizar" class="form-label">Monto a Actualizar</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="montoActualizar" name="montoActualizar" required placeholder="Ingrese el monto a actualizar">
                            <span class="input-group-text" id="simboloMonto">%</span> <!-- Cambia el símbolo según el tipo de monto -->
                        </div>
                        <small class="form-text text-muted" id="mensajeMontoActualizar"></small>
                    </div>
                </form>


                <!-- // Fin Modal -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="cerrarModal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btnAumentarPrecio">Actualizar precios</button>
            </div>
        </div>
    </div>
</div>


<!-- Paginación -->

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center" id="paginacion">
        <!-- Paginacion de productos -->
    </ul>

</nav>

<script src="Assets\js\Buscadores\buscar_producto.js"></script>
<script src="Assets\js\Funciones\aumentarprecios.js"></script>