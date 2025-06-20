<h3 class="text-center">PASO 1 ➡️ Seleccione el cliente</h3>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6 bg-primary-subtle p-3 rounded-3">
        <div class="col-md-10 ms-3">
            <div class="mb-3">
                <label for="buscarCliente" class="form-label fw-bold">Buscar Cliente</label>
                <input type="text" class="form-control" id="buscarCliente"
                    placeholder="Ingrese nombre, apellido o documento">
                <div id="listaClientes" class="list-group mt-2">
                </div>
            </div>
        </div>
        <div class="col-md-10 ms-3">
            <div class="mb-3" style="display: none;">
                <label for="clienteId" class="form-label">ID Cliente</label>
                <input type="text" class="form-control" id="clienteId" readonly>
            </div>
        </div>
        <div class="card mb-3 mx-auto" style="width: 18rem; display: none;" id="cardCliente">
            <div class="card-header fw-bold fs-5" id="cardClienteHeader">
                Cliente Seleccionado
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" id="listCardNombre"></li>
                <li class="list-group-item" id="listCardApellido"></li>
                <li class="list-group-item" id="listCardTipoDocumento"></li>
                <li class="list-group-item" id="listCardDocumento"></li>
            </ul>
            <div class="card-footer">
                <button class="btn btn-outline-danger btn-sm w-100" id="limpiarSeleccionBtn">Limpiar Selección</button>
            </div>
        </div>
        <div class="d-flex justify-content-center gap-3 mt-3">
            <button class="btn btn-warning" title="Venta sin cliente registrado" id="btnVentaRapida">
                Venta Rápida
            </button>
            <button class="btn btn-secondary" title="¿No está registrado el cliente? ¡Registralo!"
                data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">
                Registrar cliente
            </button>
        </div>

    </div>
    <div class="col-3"></div>
</div>

<div id="clienteAlertContainer" class="mt-3"></div>