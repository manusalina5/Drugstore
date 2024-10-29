<div class="modal fade" id="modalAgregarProveedor" tabindex="-1" aria-labelledby="modalAgregarProveedor"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="ModalLabel">Alta de Proveedor</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert"
                    id="alert_proveedores">
                </div>

                <form id="form_proveedores" action="Controller/Personas/Proveedor/proveedor.controlador.php"
                    method="POST">
                    <input type="hidden" name="action" value="registro_proveedor">

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre_proveedores" name="nombre" required
                            placeholder="Ingrese el nombre">
                    </div>

                    <!-- Apellido -->
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido_proveedores" name="apellido" required
                            placeholder="Ingrese el apellido">
                    </div>

                    <!-- Razón Social -->
                    <div class="mb-3">
                        <label for="razonSocial" class="form-label">Razón Social</label>
                        <input type="text" class="form-control" id="razonSocial_proveedores" name="razonSocial" required
                            placeholder="Ingrese razón social">
                    </div>

                    <!-- Tipo Documento -->
                    <div class="mb-3">
                        <label for="tipodocumento" class="form-label">Tipo de Documento</label>
                        <select class="form-select" name="idtipoDocumentos" id="tipodocumento_proveedores" required>
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
                        <input type="text" class="form-control" placeholder="Ingrese documento" name="documento"
                            id="documento_proveedores">
                    </div>

                    <!-- Tipo Contacto -->
                    <div class="mb-3">
                        <label id="label-select" for="tipocontacto" class="font-weight-bold">Contacto</label>
                        <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto"
                            id="tipocontacto_proveedores">
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
                        <input type="text" class="form-control" name="contacto" id="contacto_proveedores"
                            placeholder="Ingrese contacto">
                    </div>

                    <!-- Dirección -->
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea class="form-control" maxlength="255" id="direccion_proveedores" rows="1"
                            name="direccion" placeholder="Ingrese dirección"></textarea>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" maxlength="255" id="observaciones_proveedores" rows="2"
                            name="observaciones"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="cerrarModalProveedor">Cerrar</button>
                        <button type="button" onclick="validateProveedor()" class="btn btn-primary">Guardar
                            cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="Assets/js/Validaciones/alta_proveedores_compras.js"></script>