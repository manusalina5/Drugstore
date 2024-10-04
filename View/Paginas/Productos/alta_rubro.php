<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col">
    </div>
    <div class="col">
        <h1>Registrar Rubro</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form action="Controller/Productos/rubro.controlador.php" method="POST" id="form">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombrerubro" class="form-label">Nombre de Rubro</label>
                <input type="text" class="form-control" id="nombrerubro" name="nombrerubro" data-nombre="Nombre de rubro" required>
            </div>
            <div class="d-grid gap-1">
                <button id="submitform" type="button" class="btn btn-success">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>

<script type='module' src="Assets/js/Validaciones/alta_rubro.js"></script>