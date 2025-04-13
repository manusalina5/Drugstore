<?php
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();
?>
<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="container-fluid">
    <h1 class="text-left h2">VENTAS</h1>
    
    <!-- Sección de Caja -->
    <div class="d-flex flex-column gap-3 mb-4">
        <div class="d-flex justify-content-between align-items-center bg-light p-3 border rounded">
            <div class="d-flex gap-4">
                <p class="mb-0"><strong>Saldo Inicial:</strong> $<span id="saldoInicial">0.00</span></p>
                <p class="mb-0"><strong>Ventas del Día:</strong> $<span id="ventasDia">0.00</span></p>
                <p class="mb-0"><strong>Saldo Final:</strong> $<span id="saldoFinal">0.00</span></p>
                <p class="mb-0"><strong>Estado Caja: <span id="estadoCaja"></span></strong></p>
            </div>
            <div class="d-flex gap-2">
                <button id="btnAbrirCaja" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAbrirCaja">Abrir Caja</button>
                <button id="btnCerrarCaja" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalCerrarCaja">Cerrar Caja</button>
            </div>
        </div>
    </div>

    <!-- Modal Abrir Caja -->
    <div class="modal fade" id="modalAbrirCaja" tabindex="-1" aria-labelledby="modalAbrirCaja" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="modalAbrirCajaLabel">Abrir Caja</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModalAbrirCaja" action="Controller/Caja/caja.controlador.php?action=abrircaja" method="POST">
                        <div class="mb-3">
                            <label for="montoInicial" class="form-label">Monto Inicial</label>
                            <input type="number" class="form-control" id="montoInicial" name="montoInicial" placeholder="Ingrese el monto inicial" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-success" id="btnModalAbrirCaja">Abrir Caja</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cerrar Caja -->
    <div class="modal fade" id="modalCerrarCaja" tabindex="-1" aria-labelledby="modalCerrarCaja" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="modalCerrarCajaLabel">Cerrar Caja</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formModalCerrarCaja" action="Controller/Caja/caja.controlador.php?action=cerrarcaja" method="POST">
                        <div class="mb-3">
                            <label for="montoFinal" class="form-label">Monto Final</label>
                            <input readonly type="number" class="form-control" id="montoFinal" name="montoFinal" placeholder="Ingrese el monto final" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" id="btnModalCerrarCaja">Cerrar Caja</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Proceso de Venta por Pasos -->
    <div class="steps-container">
        <!-- Paso 1: Selección de Cliente -->
        <div class="step step-1 active">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Paso 1: Seleccionar Cliente</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="buscarCliente" class="form-label">Buscar Cliente</label>
                                <input type="text" class="form-control" id="buscarCliente" placeholder="Ingrese nombre, apellido o documento">
                                <div id="listaClientes" class="list-group mt-2"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="clienteId" class="form-label">ID Cliente</label>
                                <input type="text" class="form-control" id="clienteId" readonly>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">
                        <i class="fas fa-plus"></i> Agregar Cliente
                    </button>
                </div>
            </div>
        </div>

        <!-- Paso 2: Selección de Productos -->
        <div class="step step-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Carrito de Compras</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unit.</th>
                                            <th>Subtotal</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody id="carrito"></tbody>
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
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Agregar Productos</h4>
                        </div>
                        <div class="card-body">
                            <form id="formAgregarProducto">
                                <div class="mb-3">
                                    <label for="buscarProducto" class="form-label">Buscar Producto</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="buscarProducto" placeholder="Nombre o código del producto">
                                        <button class="btn btn-outline-secondary" type="button" id="btnScanBarcode">
                                            <i class="fas fa-barcode"></i>
                                        </button>
                                    </div>
                                    <div id="listaProductos" class="list-group mt-2"></div>
                                </div>
                                <input type="hidden" id="idProducto">

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="precio" class="form-label">Precio Unitario</label>
                                        <input type="number" class="form-control" id="precio" placeholder="$0.00" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="codBarras" class="form-label">Código de Barras</label>
                                        <input type="text" id="codBarras" class="form-control" placeholder="Código de barras">
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-4">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" value="1" min="1">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="text" id="stock" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nivel_stock" class="form-label">Estado</label>
                                        <input type="text" id="nivel_stock" class="form-control" readonly>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary w-100" id="btnAgregarProducto">
                                    <i class="fas fa-cart-plus"></i> Agregar al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Paso 3: Método de Pago y Confirmación -->
        <div class="step step-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Método de Pago</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="metodoPago" class="form-label">Seleccione método</label>
                                <select class="form-select" id="metodoPago">
                                    <?php foreach ($metodosDePagos as $metodopago): ?>
                                        <option value="<?= $metodopago['idmetodoPago'] ?>">
                                            <?= $metodopago['nombre'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div id="divDetallesPago" style="display: none;">
                                <!-- Aquí irían campos adicionales según el método de pago -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Resumen de Venta</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <h5>Cliente: <span id="resumenCliente">No especificado</span></h5>
                            </div>
                            <div class="mb-3">
                                <h5>Productos: <span id="resumenCantidadProductos">0</span></h5>
                            </div>
                            <div class="mb-3">
                                <h2 class="text-success">Total: <span id="totalFinal">$0.00</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navegación entre pasos -->
        <div class="navigation-buttons mt-4">
            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary prev-btn" disabled>
                    <i class="fas fa-arrow-left"></i> Anterior
                </button>
                <button type="button" class="btn btn-primary next-btn">
                    Siguiente <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Cliente -->
<?php require('View/Paginas/Personas/Cliente/form.alta_cliente.php'); ?>

<style>
.steps-container {
    position: relative;
    min-height: 500px;
}
.step {
    display: none;
    animation: fadeIn 0.5s ease;
}
.step.active {
    display: block;
}
.navigation-buttons {
    margin-top: 20px;
}
#resumenCliente, #resumenCantidadProductos {
    font-weight: normal;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script src="Assets/js/Validaciones/ventas.js"></script>
<script src="Assets/js/Validaciones/alta_clientes_ventas.js"></script>
<script src="Assets/js/Buscadores/buscar_clienteventa.js"></script>
<script src="Assets/js/Buscadores/buscar_productosventa.js"></script>
<script src="Assets/js/Validaciones/carrito_ventas.js"></script>
<script src="Assets/js/Funciones/caja.ventas.js"></script>

<script>
// Control de pasos
$(document).ready(function() {
    let currentStep = 1;
    const totalSteps = 3;

    // Función para actualizar la navegación
    function updateNavigation() {
        $('.prev-btn').prop('disabled', currentStep === 1);
        
        if (currentStep === totalSteps) {
            $('.next-btn').hide();
            $('#btnConfirmarVenta').show();
        } else {
            $('.next-btn').show();
            $('#btnConfirmarVenta').hide();
        }
    }

    // Función para validar el paso actual
    function validateCurrentStep() {
        switch(currentStep) {
            case 1:
                if (!$('#clienteId').val()) {
                    Swal.fire('Error', 'Debe seleccionar un cliente para continuar', 'error');
                    return false;
                }
                // Actualizar resumen
                $('#resumenCliente').text($('#buscarCliente').val());
                return true;
                
            case 2:
                if ($('#carrito tr').length === 0) {
                    Swal.fire('Error', 'Debe agregar al menos un producto al carrito', 'error');
                    return false;
                }
                // Actualizar resumen
                $('#resumenCantidadProductos').text($('#carrito tr').length);
                $('#totalFinal').text($('#totalCarrito').text());
                return true;
                
            default:
                return true;
        }
    }

    // Evento siguiente
    $('.next-btn').click(function() {
        if (validateCurrentStep()) {
            $('.step-'+currentStep).removeClass('active');
            currentStep++;
            $('.step-'+currentStep).addClass('active');
            updateNavigation();
        }
    });

    // Evento anterior
    $('.prev-btn').click(function() {
        $('.step-'+currentStep).removeClass('active');
        currentStep--;
        $('.step-'+currentStep).addClass('active');
        updateNavigation();
    });

    // Inicializar navegación
    updateNavigation();

    // Confirmar venta (al final del proceso)
    $('#btnConfirmarVenta').click(function() {
        // Aquí iría la lógica para confirmar la venta
        // Puedes usar los mismos scripts que ya tenías
        confirmarVenta();
    });

    // Cancelar venta
    $('#btnCancelarVenta').click(function() {
        Swal.fire({
            title: '¿Cancelar venta?',
            text: "Se perderán todos los datos de la venta actual",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cancelar',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Reiniciar todo el proceso
                resetVenta();
            }
        });
    });

    // Función para reiniciar la venta
    function resetVenta() {
        // Limpiar campos
        $('#buscarCliente, #clienteId').val('');
        $('#carrito').empty();
        $('#totalCarrito, #totalFinal').text('$0.00');
        $('#resumenCliente').text('No especificado');
        $('#resumenCantidadProductos').text('0');
        
        // Volver al paso 1
        $('.step').removeClass('active');
        currentStep = 1;
        $('.step-1').addClass('active');
        updateNavigation();
    }

    // Integración con el carrito existente
    // (Los scripts originales seguirán funcionando)
});
</script>