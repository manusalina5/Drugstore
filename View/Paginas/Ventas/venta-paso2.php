<h3 class="text-center my-4">🛒 Seleccione los productos</h3>

<div class="step step-2 mx-3 mb-4">
    <div class="row g-4">
        <!-- Carrito -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Carrito de Compras</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th style="width: 100px;">Cantidad</th>
                                    <th>Precio Unit.</th>
                                    <th>Subtotal</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="carrito"></tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="3" class="text-end">Total</th>
                                    <th id="totalCarrito" class="text-success fw-bold">$0.00</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buscador -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex align-items-center">
                    <h5 class="mb-0">🔍 Buscar Producto</h5>
                </div>
                <div class="card-body">
                    <form id="formAgregarProducto" autocomplete="off">
                        <div class="mb-3">
                            <label for="buscarProducto" class="form-label">Nombre o código de barras</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="buscarProducto"
                                    placeholder="Ej. Coca Cola, 779..." autofocus>
                                <button class="btn btn-outline-secondary" type="button" id="btnScanBarcode"
                                    title="Escanear código">
                                    <i class="bi bi-upc-scan"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Lista de sugerencias -->
                        <div id="listaProductos" class="list-group mt-2 shadow-sm"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
