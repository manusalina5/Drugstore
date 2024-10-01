<div class="container mt-5">
        <h1 class="text-center mb-4">Cierre de Caja</h1>
        <form action="?page=procesar_cierre_caja" method="POST">
            <div class="mb-3">
                <label for="montoCierre" class="form-label">Monto Final</label>
                <input type="number" class="form-control" id="montoCierre" name="montoCierre" placeholder="Ingrese el monto final" required>
            </div>
            <div class="mb-3">
                <label for="fechaCierre" class="form-label">Fecha de Cierre</label>
                <input type="date" class="form-control" id="fechaCierre" name="fechaCierre" required>
            </div>
            <div class="mb-3">
                <label for="horaCierre" class="form-label">Hora de Cierre</label>
                <input type="time" class="form-control" id="horaCierre" name="horaCierre" required>
            </div>
            <button type="submit" class="btn btn-danger">Cerrar Caja</button>
        </form>
    </div>