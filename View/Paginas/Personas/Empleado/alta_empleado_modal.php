<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="formModal" action="Controller/Personas/Empleado/empleado.controlador.php" method="POST">

            <input type="hidden" name="action" value="registroModal">
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    placeholder="Ingrese sus nombres">
                <div class="errorNombre text-danger" id="errorNombre"></div>
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" 
                    placeholder="Ingrese sus apellidos">
                <div class="errorApellido text-danger" id="errorApellido"></div>
            </div>

            <!-- Tipo Documento -->
            <div class="mb-3">
                <label id="label-tipodocumento" for="tipodocumento" class="font-weight-bold">Tipo de Documento</label>
                <select class="form-select" aria-label="Select TipoDocumento"  name="idtipoDocumentos"
                    id="tipodocumento">
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
                <div class="errorTipoDocumento text-danger" id="errorTipoDocumento"></div>
            </div>

            <!-- Documento -->
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Ingrese su documento" aria-label="documento"
                    name="documento" id="documento">
                <div class="errorDocumento text-danger" id="errorDocumento"></div>
            </div>

            <!-- Tipo Contacto -->
            <div class="mb-3">
                <label id="label-select" for="tipocontacto" class="font-weight-bold">Contacto</label>
                <select class="form-select" aria-label="Select TipoContacto"  name="idtipoContacto"
                    id="tipocontacto">
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
                <div class="errorTipoContacto text-danger" id="errorTipoContacto"></div>
            </div>

            <!-- Contacto -->
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Ingrese su contacto" aria-label="contacto"
                    name="contacto" id="contacto">
                <div class="errorContacto text-danger" id="errorContacto"></div>
            </div>

            <!-- Dirección -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea  class="form-control" maxlength="255" id="direccion" rows="1"
                    name="direccion"></textarea>
                <div class="errorDireccion text-danger" id="errorDireccion"></div>
            </div>

            <!-- Legajo -->
            <div class="mb-3">
                <label for="legajo" class="form-label">Legajo</label>
                <input type="text" class="form-control" id="legajo" name="legajo" 
                    placeholder="Ingrese el legajo">
                <div class="errorLegajo text-danger" id="errorLegajo"></div>
            </div>

            <div class="d-grid gap-1 mb-3">
                <button type="submit" class="btn btn-success" id="btnGuardar">Registrar</button>
            </div>


        </form>
    </div>
    <div class="col">
    </div>
</div>



<script src="Assets/js/Validaciones/alta_empleado_modal.js"></script>