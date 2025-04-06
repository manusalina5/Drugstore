<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1 class="text-center">Registrar Cliente</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Personas/Cliente/cliente.controlador.php" method="POST" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="registro">

            <!-- Nombre -->
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
                <label id="label-tipodocumento" for="tipodocumento" class="font-weight-bold">Tipo de Documento</label>
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
                <input type="text" class="form-control" placeholder="Ingrese su documento" aria-label="documento" name="documento" id="documento">
            </div>

<!-- Tipo Contacto y Contacto -->
<div id="contactos-container">
    <div class="contacto-item mb-3">
        <label id="label-select" for="tipocontacto" class="font-weight-bold">Tipo de Contacto</label>
        <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto[]">
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
        <input type="text" class="form-control mt-2" placeholder="Ingrese su contacto" aria-label="contacto" name="contacto[]" required>
        <button type="button" class="btn btn-danger mt-2 remove-contacto">Eliminar</button>
    </div>
</div>
<button type="button" id="add-contacto" class="btn btn-primary mt-3">Agregar Contacto</button>


            <!-- Dirección -->
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <textarea required class="form-control" maxlength="255" id="direccion" rows="1" name="direccion"></textarea>
            </div>

            <!-- Observaciones -->
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" maxlength="255" id="observaciones" rows="2" name="observaciones"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>


    
<script src="Assets/js/Funciones/altaclientecontactos.js"></script>
<script src="Assets/js/Validaciones/alta_cliente.js"></script>