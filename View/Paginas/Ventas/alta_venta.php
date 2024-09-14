<div class="container my-4">
    <h2 class="text-center">Ventas</h2>

    <!-- Formulario de Productos -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h4>Agregar Producto</h4>
            <form id="formAgregarProducto">
                <div class="mb-3">
                    <label for="buscarProducto" class="form-label">Buscar Producto</label>
                    <input type="text" class="form-control" id="buscarProducto" placeholder="Nombre o código del producto">
                    <div id="listaProductos" class="list-group mt-2"></div> <!-- Para la lista de sugerencias -->
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" value="1">
                </div>
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio Unitario</label>
                    <input type="number" class="form-control" id="precio" placeholder="$0.00" readonly>
                </div>
                <button type="button" class="btn btn-primary" id="btnAgregarProducto">Agregar al carrito</button>
            </form>
        </div>

        <!-- Carrito de Compras -->
        <div class="col-md-6">
            <h4>Carrito de Compras</h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="carrito">
                    <!-- Productos se agregan dinámicamente aquí -->
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end">Total</th>
                        <th id="totalCarrito">$0.00</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Resumen de la Venta -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h4>Resumen de Venta</h4>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total Bruto:
                    <span id="totalBruto">$0.00</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Descuento:
                    <input type="number" class="form-control w-25" id="descuento" value="0">
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Impuestos:
                    <span id="impuestos">21%</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Total a Pagar:
                    <span id="totalPagar">$0.00</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="row">
        <div class="col-md-6 d-flex gap-3">
            <button class="btn btn-success" id="btnConfirmarVenta">Confirmar Venta</button>
            <button class="btn btn-danger" id="btnCancelarVenta">Cancelar Venta</button>
        </div>
    </div>

    <!-- Historial de Ventas -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Historial de Ventas</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Ventas anteriores listadas aquí -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="Assets/js/Buscadores/buscar_productosventa.js"></script>

<script>
    $(document).ready(function() {
    $('#buscarProducto').on('keyup', function() {
        var query = $(this).val();

        if (query.length > 2) { // Realiza la búsqueda si tiene más de 2 caracteres
            $.ajax({
                url: 'Controller/Productos/producto.controlador.php?action=buscarVenta',
                type: 'GET',
                data: { query: query },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    if (data.length > 0) {
                        data.forEach(function(producto) {
                            html += '<a href="#" class="list-group-item list-group-item-action">';
                            html += producto.nombre + ' - ' + producto.codBarras;
                            html += '</a>';
                        });
                    } else {
                        html = '<p>No se encontraron productos</p>';
                    }
                    $('#listaProductos').html(html);
                }
            });
        } else {
            $('#listaProductos').html('');
        }
    });
});

</script>