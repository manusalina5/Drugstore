<div class="modal fade" id="modalAgregarCliente" tabindex="-1" aria-labelledby="modalAgregarCliente" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel">Alta de cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Inicio lógica de alta-->

                <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert_clientes">
                </div>

                <form id="form_clientes" action="Controller/Personas/Cliente/cliente.controlador.php" method="POST">
                    <input type="hidden" name="action" value="registro_venta">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombre_clientes" name="nombre" required placeholder="Ingrese sus nombres">
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellido_clientes" name="apellido" required placeholder="Ingrese sus apellidos">
                    </div>

                    <!-- Tipo Documento -->
                    <div class="mb-3">
                        <label id="label-tipodocumento" for="tipodocumento" class="font-weight-bold">Tipo de Documento</label>
                        <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos" id="tipodocumento_clientes">
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
                        <input type="text" class="form-control" placeholder="Ingrese su documento" aria-label="documento" name="documento" id="documento_clientes">
                    </div>

                    <!-- Tipo Contacto -->
                    <div class="mb-3">
                        <label id="label-select" for="tipocontacto" class="font-weight-bold">Contacto</label>
                        <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto" id="tipocontacto_clientes">
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
                        <input type="text" class="form-control" placeholder="Ingrese su contacto" aria-label="contacto" name="contacto" id="contacto_clientes">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea required class="form-control" maxlength="255" id="direccion_clientes" rows="1" name="direccion"></textarea>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" maxlength="255" id="observaciones_clientes" rows="2" name="observaciones"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cerrarModal">Cerrar</button>
                        <button type="button" onclick="validate()" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>

                <!-- Fin de lógica de alta-->
            </div>

        </div>
    </div>
</div>