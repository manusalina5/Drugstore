<?php
include_once 'Model/Personas/Cliente/cliente.php';
include_once 'config/conexion.php';
include_once('Model/Personas/Documento/tipoDocumento.php');
include_once('Model/Personas/Documento/Documento.php');
include_once('Model/Personas/Contacto/tipoContacto.php');
include_once('Model/Personas/Contacto/Contacto.php');
include_once('Model/Personas/Direccion/Direccion.php');

if (isset($_GET['idClientes'])) {
    $idClientes = $_GET['idClientes'];
    $cliente = new Cliente();
    $cliente->setIdCliente($idClientes);
    $clienteData = $cliente->obtenerClientesPorId();

    
} else {
    echo "Error: El id está vacío";
}

?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<h1 class="h2 text-center">Modificar Cliente</h1>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <div class="progress mb-4">
            <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Paso 1 de 5</div>
        </div>

        <form id="form" action="Controller/Personas/Cliente/cliente.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idClientes" value="<?php echo $clienteData['idClientes']; ?>">
            <input type="hidden" name="idPersona" value="<?php echo $clienteData['idPersona']; ?>">

            <!-- Paso 1: Datos Personales -->
            <div class="step" id="step-1">
                <h3>Datos Personales</h3>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese sus nombres" value="<?php echo $clienteData['nombre']; ?>">
                    <span class="text-danger" id="nombreMensaje"> </span>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ingrese sus apellidos" value="<?php echo $clienteData['apellido']; ?>">
                    <span class="text-danger" id="apellidoMensaje"> </span>
                </div>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 2: Documento -->
            <div class="step" id="step-2" style="display: none;">
                <h3>Documento</h3>
                <div class="mb-3">
                    <label for="tipodocumento" class="font-weight-bold">Tipo de Documento</label>
                    <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos" id="tipodocumento">
                        <?php
                        $documento = new Documento();
                        $documento->setPersonaId($clienteData['idPersona']);
                        $documentoObt = $documento->obtenerDocumentoPorId();
                        $tipoDocumentoObj = new TipoDocumento();
                        $tipoDocumentos = $tipoDocumentoObj->obtenerTipoDocumentos();
                        if (!empty($tipoDocumentos)) {
                            foreach ($tipoDocumentos as $tipoDocumento) {
                                if ($tipoDocumento['idtipoDocumentos'] == $documentoObt['idtipoDocumentos']) {
                                    echo "<option selected value='{$documentoObt['idtipoDocumentos']}'>{$documentoObt['valorTipoDocumentos']}</option>";
                                } else {
                                    echo "<option value='{$tipoDocumento['idtipoDocumentos']}'>{$tipoDocumento['valor']}</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    <span class="text-danger" id="tipoDocumentoMensaje"></span>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Ingrese su documento" id="documento" name="documento" value="<?php echo $documentoObt['valorDocumento']; ?>">
                    <span class="text-danger" id="documentoMensaje"> </span>
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
                        <select class="form-select" aria-label="Select TipoContacto" name="idtipoContacto[]">
                            <option selected value="">Elija tipo de contacto</option>
                            <?php
                            $contacto = new Contacto();
                            $contacto->setPersona_idPersona($clienteData['idPersona']);
                            $contactoObt = $contacto->obtenerContactoPorId();
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
                        <input type="text" class="form-control mt-2" placeholder="Ingrese su contacto" name="contacto[]" value="<?php echo $contactoObt['valorContacto']; ?>" required>
                        <span class="text-danger contactoMensaje" id="contactoMensaje-0"> </span>
                        <button type="button" class="btn btn-danger btn-sm mt-2 remove-contacto">Eliminar</button>
                    </div>
                </div>
                <button type="button" id="add-contacto" class="btn btn-success btn-sm">Agregar Contacto</button>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="button" class="btn btn-primary next-step">Siguiente</button>
            </div>

            <!-- Paso 4: Dirección -->
            <div class="step" id="step-4" style="display: none;">
                <h3>Dirección</h3>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección</label>
                    <?php
                                include_once('Model/Personas/Direccion/Direccion.php');
                                $direccion = new Direccion();
                                $direccion->setPersona_idPersona($clienteData['idPersona']);
                                $direccionData = $direccion->obtenerDireccionPorId();
                                if (!empty($direccionData)) {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' id='direccion' name='direccion'>{$direccionData['descripcion']}</textarea>";
                                } else {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' name='direccion'></textarea>";
                                }
                                ?>
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
                    <textarea class="form-control" id="observaciones" name="observaciones" required maxlength="255"><?php echo $clienteData['observaciones'] ?? $clienteData['observaciones'] ?? ''; ?></textarea>
                    <span class="text-danger" id="observacionesMensaje"></span>
                </div>
                <button type="button" class="btn btn-secondary prev-step">Anterior</button>
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </div>
        </form>
    </div>
    <div class="col"></div>
</div>

<script src="Assets/js/Validaciones/validaciones.js"></script>
<script src="Assets/js/Funciones/altaclientecontactos.js"></script>
<script src="Assets/js/Validaciones/alta_cliente.js"></script>
