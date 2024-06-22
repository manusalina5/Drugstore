<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1 class="text-center">Registrar Persona</h1>
        <form class="" action="Controller/Personas/persona.controlador.php" method="POST">

            <!-- Nombre -->
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese sus nombres">
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ingrese sus apellidos">
            </div>

            <!-- Tipo Documento -->
            <div class="mb-3">
                <label for="tipodocumento" class="font-weight-bold">Documento</label>
                <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos" id="tipodocumento">
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
                <input type="text" class="form-control" placeholder="Ingrese su documento" aria-label="documento" name="documento">
            </div>

            <!-- Tipo Contacto -->
            <div class="mb-3">
                <label id="label-select" for="tipocontacto" class="font-weight-bold">Contacto</label>
                <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto" id="tipocontacto">
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
                <input type="text" class="form-control" placeholder="Ingrese su contacto" aria-label="contacto" name="contacto">
            </div>

            <!-- Dirección -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea required class="form-control" maxlength="255" id="direccion" rows="1" name="direccion"></textarea>
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-success">Agregar</button>
            </div>
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