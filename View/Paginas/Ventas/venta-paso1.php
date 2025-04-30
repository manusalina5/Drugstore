<h3 class="text-center">PASO 1 ➡️ Seleccione el cliente</h3>

<div class="row">
    <div class="col-3"></div>
    <div class="col-6 bg-primary-subtle p-3 rounded-3">
        <div class="col-md-10 ms-3">
            <div class="mb-3">
                <label for="buscarCliente" class="form-label">Buscar Cliente</label>
                <input type="text" class="form-control" id="buscarCliente"
                    placeholder="Ingrese nombre, apellido o documento">
                <div id="listaClientes" class="list-group mt-2"></div>
            </div>
        </div>
        <div class="col-md-10 ms-3">
            <div class="mb-3">
                <label for="clienteId" class="form-label">ID Cliente</label>
                <input type="text" class="form-control" id="clienteId" readonly>
            </div>
        </div>
        <div class="d-flex justify-content-center">

            <button class="btn btn-warning" title="Venta sin cliente registrado">Venta Rapida</button>
            <button class="btn btn-secondary ms-3" title="¿No está registrado el cliente? ¡Registralo!">Registrar cliente</button>
        </div>
    </div>
<div class="col-3"></div>

</div>