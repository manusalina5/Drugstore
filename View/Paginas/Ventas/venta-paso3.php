<h3 class="text-center">Seleccione el metodo de pago</h3>
<!-- Paso 3: Método de Pago y Confirmación -->
<div class="step step-3 mt-4">
    <div class="row">
        <!-- Método de Pago -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Método de Pago</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="metodoPago" class="form-label">Seleccione método</label>
                        <select class="form-select" id="metodoPago">
                            <option value="" disabled selected>-- Seleccione --</option>
                            <?php foreach ($metodosDePagos as $metodopago): ?>
                                <option value="<?= $metodopago['idmetodoPago'] ?>">
                                    <?= $metodopago['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Detalles adicionales según método de pago -->
                    <div id="divDetallesPago" class="mt-3" style="display: none;">
                        <!-- Aquí se mostrarán dinámicamente los campos -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Resumen de Venta -->
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Resumen de Venta</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5><b>Cliente: </b><span id="resumenCliente"></span></h5>
                    </div>
                    <div class="mb-3">
                        <h5><b>Productos:</b></h5>
                        <div style="max-height: 200px; overflow-y: auto;">
                            <table class="table table-sm table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody id="resumenProductos"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h2 class="text-success">Total: <span id="totalFinal">$0.00</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
