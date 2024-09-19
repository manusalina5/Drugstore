<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1 class="h3">Registrar Tipo Contacto</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" class="" action="Controller/Personas/Contacto/tipocontacto.controlador.php" method="POST" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="valortipocontacto" class="form-label">Valor</label>
                <input type="text" class="form-control" id="valortipocontacto" name="valortipocontacto" required>
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>

<script src="Assets/js/Validaciones/alta_tipocontacto.js"></script>