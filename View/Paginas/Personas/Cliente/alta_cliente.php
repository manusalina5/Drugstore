<link rel="stylesheet" href="Assets/css/validaciones.css">

<h1 class="h2 text-center">REGISTRAR CLIENTES</h1>
<div class="row">
    <div class="col"></div>
    <div class="col">
        <!-- Barra de Progreso -->
        <div class="progress mb-4">
            <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 20%;"
                aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                Paso 1 de 5
            </div>
        </div>
        <div id="alert" class="alert-danger alerta"></div>

        <!-- Formulario -->
        <form id="form" action="Controller/Personas/Cliente/cliente.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">

            <!-- Paso 1: Datos Personales -->
            <div class="step" id="step-1">
                <h3>Datos Personales</h3>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required
                        placeholder="Ingrese sus nombres">
                    <span class="text-danger" id="nombreMensaje"> </span>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required
                        placeholder="Ingrese sus apellidos">
                    <span class="text-danger" id="apellidoMensaje"> </span>
                </div>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 2: Documento -->
            <div class="step" id="step-2" style="display: none;">
                <h3>Documento</h3>
                <div class="mb-3">
                    <label for="tipodocumento" class="form-label">Tipo de Documento</label>
                    <select class="form-select" aria-label="Select TipoDocumento" required 
                            name="idtipoDocumentos" id="tipodocumento">
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
                    <span class="text-danger" id="tipoDocumentoMensaje"></span>
                </div>
                <div class="mb-3">
                    <label for="documento" class="form-label">Documento</label>
                    <input type="text" class="form-control" placeholder="Ingrese su documento" 
                           name="documento" id="documento">
                    <span class="text-danger" id="documentoMensaje"></span>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 3: Contacto -->
            <div class="step" id="step-3" style="display: none;">
                <h3>Contacto</h3>
                <div id="contactos-container">
                    <div class="contacto-item mb-3">
                        <label for="tipocontacto" class="font-weight-bold">Tipo de Contacto</label>
                        <select class="form-select selectTipocontacto" aria-label="Select TipoContacto" required
                            name="idtipoContacto[]">
                            <option selected value=''>Elija tipo de contacto</option>
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
                        <span class="text-danger tipocontactoMensaje" id="tipocontactoMensaje-0"> </span>
                        <input type="text" class="form-control mt-2" placeholder="Ingrese su contacto" name="contacto[]"
                            required>
                        <span class="text-danger contactoMensaje" id="contactoMensaje-0"> </span>
                        <div class="mt-0">
                            <button type="button" class="btn btn-danger btn-sm mt-2 remove-contacto">Eliminar</button>
                        </div>
                    </div>
                </div>

                <!-- Botón Agregar Contacto -->
                <div class="mt-3">
                    <button type="button" id="add-contacto" class="btn btn-success btn-sm">Agregar Contacto</button>
                </div>

                <!-- Botones de Navegación -->
                <div class="d-flex mt-4">
                    <button type="button" class="btn btn-secondary prev-step me-2">Anterior</button>
                    <button type="button" class="btn btn-primary next-step">Siguiente</button>
                </div>
            </div>


            <!-- Paso 4: Dirección -->
            <div class="step" id="step-4" style="display: none;">
                <h3>Dirección</h3>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <textarea required class="form-control" maxlength="255" id="direccion" rows="1"
                        name="direccion"></textarea>
                    <span class="text-danger" id="direccionMensaje"> </span>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 5: Observaciones -->
            <div class="step" id="step-5" style="display: none;">
                <h3>Observaciones</h3>
                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control" maxlength="255" id="observaciones" rows="2"
                        name="observaciones"></textarea>
                    <span class="text-danger" id="observacionesMensaje"> </span>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="submit" class="btn btn-success">Registrar Cliente</button>
            </div>
        </form>
    </div>
    <div class="col">
    </div>
</div>

<script src="Assets/js/Validaciones/validaciones.js"></script>
<script src="Assets/js/Funciones/altaclientecontactos.js"></script>
<script src="Assets/js/Validaciones/alta_cliente.js"></script>