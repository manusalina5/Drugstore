<link rel="stylesheet" href="Assets/css/validaciones.css">

<h1 class="text-center mb-4">Registrar Cliente</h1>

        <!-- Barra de Progreso -->
        <div class="progress mb-4">
            <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                Paso 1 de 5
            </div>
        </div>

        <!-- Formulario -->
        <form id="form" action="Controller/Personas/Cliente/cliente.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">

            <!-- Paso 1: Datos Personales -->
            <div class="step" id="step-1">
                <h3>Datos Personales</h3>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese sus nombres">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ingrese sus apellidos">
                </div>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 2: Documento -->
            <div class="step" id="step-2" style="display: none;">
                <h3>Documento</h3>
                <div class="mb-3">
                    <label id="label-tipodocumento" for="tipodocumento" class="font-weight-bold">Tipo de Documento</label>
                    <select class="form-select" required name="idtipoDocumentos" id="tipodocumento">
                        <option selected value="">Elija tipo de documento</option>
                        <?php
                        // Código PHP para obtener tipo de documentos
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Ingrese su documento" name="documento" id="documento">
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
                        <select class="form-select" name="idtipoContacto[]" required>
                            <option selected value="">Elija tipo de contacto</option>
                            <?php
                            // Código PHP para obtener tipo de contacto
                            ?>
                        </select>
                        <input type="text" class="form-control mt-2" placeholder="Ingrese su contacto" name="contacto[]" required>
                        <button type="button" class="btn btn-danger mt-2 remove-contacto">Eliminar</button>
                    </div>
                </div>
                <button type="button" id="add-contacto" class="btn btn-primary mt-3">Agregar Contacto</button>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 4: Dirección -->
            <div class="step" id="step-4" style="display: none;">
                <h3>Dirección</h3>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <textarea required class="form-control" maxlength="255" id="direccion" rows="1" name="direccion"></textarea>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 5: Observaciones -->
            <div class="step" id="step-5" style="display: none;">
                <h3>Observaciones</h3>
                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control" maxlength="255" id="observaciones" rows="2" name="observaciones"></textarea>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="submit" class="btn btn-success">Registrar Cliente</button>
            </div>
        </form>



<script src="Assets/js/Funciones/altaclientecontactos.js"></script>
<script src="Assets/js/Validaciones/alta_cliente.js"></script>