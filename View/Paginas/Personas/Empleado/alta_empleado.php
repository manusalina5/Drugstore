<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1 class="text-center">Registrar Empleado</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Personas/Empleado/empleado.controlador.php" method="POST" onsubmit="return validate(event)">

            <input type="hidden" name="action" value="registro">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre"  placeholder="Ingrese sus nombres">
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido"  placeholder="Ingrese sus apellidos">
            </div>

            <!-- Tipo Documento -->
            <div class="mb-3">
                <label id="label-tipodocumento" for="tipodocumento" class="font-weight-bold">Tipo de Documento</label>
                <select class="form-select" aria-label="Select TipoDocumento"  name="idtipoDocumentos" id="tipodocumento">
                    <option selected value="">Elija tipo de documento</option>
                    <?php
                    include_once('Model/Personas/Documento/tipoDocumento.php');
                    $tipoDocumentoObj = new TipoDocumento();
                    $tipoDocumentos = $tipoDocumentoObj->obtenerTipoDocumentos();
                    if (!empty($tipoDocumentos)) {
                        foreach ($tipoDocumentos as $tipoDocumento) {
                            echo "<option value='{$tipoDocumento['idtipoDocumentos']}'>{$tipoDocumento['valor']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Documento -->
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Ingrese su documento" aria-label="documento" name="documento" id="documento">
            </div>

            <!-- Tipo Contacto -->
            <div class="mb-3">
                <label id="label-select" for="tipocontacto" class="font-weight-bold">Contacto</label>
                <select class="form-select" aria-label="Select TipoContacto"  name="idtipoContacto" id="tipocontacto">
                    <option selected value="">Elija tipo de contacto</option>
                    <?php
                    include_once('Model/Personas/Contacto/tipoContacto.php');
                    $tipoContactoObj = new TipoContacto();
                    $tipoContactos = $tipoContactoObj->obtenerTipoContacto();
                    if (!empty($tipoContactos)) {
                        foreach ($tipoContactos as $tipoContacto) {
                            echo "<option value='{$tipoContacto['idtipoContacto']}'>{$tipoContacto['valor']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <!-- Contacto -->
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Ingrese su contacto" aria-label="contacto" name="contacto" id="contacto">
            </div>

            <!-- Dirección -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea  class="form-control" maxlength="255" id="direccion" rows="1" name="direccion"></textarea>
            </div>

            <!-- Legajo -->
            <div class="mb-3">
                <label for="legajo" class="form-label">Legajo</label>
                <input type="text" class="form-control" id="legajo" name="legajo"  placeholder="Ingrese el legajo">
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tipodocumento').select2({
            placeholder: "Elija tipo de documento",
            allowClear: true
        });
    });
    $(document).ready(function() {
        $('#tipocontacto').select2({
            placeholder: "Elija tipo de contacto",
            allowClear: true
        });
    });
    </script>

<script src="Assets/js/Validaciones/alta_empleado.js"></script>