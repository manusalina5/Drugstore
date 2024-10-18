<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col">
            <h1 class="text-center mb-4">Apertura de Caja</h1>
            <form action="Controller/Caja/caja.controlador.php?action=abrircaja" method="POST">
                <div class="mb-3">
                    <label for="montoInicial" class="form-label">Monto Inicial</label>
                    <input type="number" class="form-control" id="montoInicial" name="montoInicial" placeholder="Ingrese el monto inicial" required>
                </div>
                <button type="submit" class="btn btn-success">Abrir Caja</button>
            </form>
        </div>
        <div class="col">
        </div>
    </div>
</div>
