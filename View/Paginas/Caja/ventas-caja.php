<!-- Información de la Caja en una sola fila -->
<div class="d-flex justify-content-between align-items-center bg-light p-3 border rounded">
    <!-- Contenedor para la información -->
    <div class="d-flex gap-4"> <!-- Contenedor para la información de la caja -->
        <p class="mb-0"><strong>Saldo Inicial:</strong> $<span id="saldoInicial">0.00</span></p>
        <p class="mb-0"><strong>Ventas del Día:</strong> $<span id="ventasDia">0.00</span></p>
        <p class="mb-0"><strong>Saldo Final:</strong> $<span id="saldoFinal">0.00</span></p>
        <p class="mb-0"><strong>Estado Caja: <span id="estadoCaja"></span></strong> </p>
    </div>
    <div class="d-flex gap-2"> <!-- Contenedor para los botones -->
        <button id="btnAbrirCaja" type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#modalAbrirCaja">Abrir Caja</button>
        <button id="btnCerrarCaja" type="button" class="btn btn-danger" data-bs-toggle="modal"
            data-bs-target="#modalCerrarCaja">Cerrar Caja</button>
    </div>
</div>
</div>

<!-- Modal Abrir Caja-->
<div class="modal fade" id="modalAbrirCaja" tabindex="-1" aria-labelledby="modalAbrirCaja" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="modalAbrirCajaLabel">Abrir Caja</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formModalAbrirCaja" action="Controller/Caja/caja.controlador.php?action=abrircaja"
                    method="POST">
                    <div class="mb-3">
                        <label for="montoInicial" class="form-label">Monto Inicial</label>
                        <input type="number" class="form-control" id="montoInicial" name="montoInicial"
                            placeholder="Ingrese el monto inicial" required>
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

<!-- Modal Cerrar Caja-->
<div class="modal fade" id="modalCerrarCaja" tabindex="-1" aria-labelledby="modalCerrarCaja" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="modalCerrarCajaLabel">Cerrar Caja</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formModalCerrarCaja" action="Controller/Caja/caja.controlador.php?action=cerrarcaja"
                    method="POST">
                    <div class="mb-3">
                        <label for="montoFinal" class="form-label">Monto Final</label>
                        <input type="number" class="form-control" id="montoFinal" name="montoFinal"
                            placeholder="Ingrese el monto final" required>
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