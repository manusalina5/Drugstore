<?php

include_once 'Model/Personas/Cliente/cliente.php';
include_once 'config/conexion.php';

if (isset($_GET['idClientes'])) {
    $idClientes = $_GET['idClientes'];
    $cliente = new Cliente();
    $cliente->setIdCliente($idClientes);
    $clienteData = $cliente->obtenerClientesPorId();

} else {
    echo "Error: El id está vacio";
}


?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1 class="text-center">Modificar cliente</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Personas/Cliente/cliente.controlador.php" method="POST" onsubmit="return validate(event)">
            <h3>Datos Personales</h3>
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idClientes" value="<?php echo $clienteData['idClientes']; ?>">
            <input type="hidden" name="idPersona" value="<?php echo $clienteData['idPersona']; ?>">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese sus nombres" value="<?php echo $clienteData['nombre']; ?>">
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ingrese sus apellidos" value="<?php echo $clienteData['apellido']; ?>">
            </div>

            <!-- Tipo Documento -->
            <div class="mb-3">
                <label for="tipodocumento" class="font-weight-bold">Documento</label>
                <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos" id="tipodocumento">

                    <?php
                    include_once('Model/Personas/Documento/tipoDocumento.php');
                    include_once('Model/Personas/Documento/Documento.php');

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


                    echo '</select>';
                    echo '</div>';


                    // Documento
                    echo '<div class="mb-3">';
                    if (!empty($documentoObt['valorDocumento'])) {
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' id='documento' name='documento' value='" . $documentoObt['valorDocumento'] . "'>";
                    } else {
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' name='documento'>";
                    }
                    echo '</div>';

                    ?>

                    <!-- Tipo Contacto -->
                    <div class="mb-3">
                        <label for="tipocontacto" class="font-weight-bold">Contacto</label>
                        <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto" id="tipocontacto">

                            <?php
                            include_once('Model/Personas/Contacto/tipoContacto.php');
                            include_once('Model/Personas/Contacto/Contacto.php');

                            $contacto = new Contacto();
                            $contacto->setPersona_idPersona($clienteData['idPersona']);
                            $contactoObt = $contacto->obtenerContactoPorId();


                            $tipoContactoObj = new TipoContacto();
                            $tipoContactos = $tipoContactoObj->obtenerTipoContacto();

                            if (!empty($tipoContactos)) {
                                foreach ($tipoContactos as $tipoContacto) {
                                    if ($tipoContacto['idtipoContacto'] == $ontactoObt['idtipoContacto']) {
                                        echo "<option selected value='{$contactoObt['idtipoContacto']}'>{$contactoObt['valorTipoContactos']}</option>";
                                    } else {
                                        echo "<option value='{$tipoContacto['idtipoContacto']}'>{$tipoContacto['valor']}</option>";
                                    }
                                }
                            }

                            echo "</select>";
                            echo "</div>";

                            // Contacto
                            echo "<div class='mb-3'>";
                            if (!empty($contactoObt)) {
                                echo "<input type='text' class='form-control' placeholder='Ingrese su contacto' aria-label='contacto' name='contacto' id='contacto' value='{$contactoObt['valorContacto']}'>";
                            } else {
                                echo "<input type='text' class='form-control' placeholder='Ingrese su contacto' aria-label='contacto' name='contacto'>";
                            }
                            echo "</div>";
                            ?>

                            <!-- Dirección -->
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
                            </div>

                            <!-- Observaciones -->
                            <div class="mb-3">
                                <label for="observaciones" class="form-label">Observaciones</label>
                                <textarea required class="form-control" maxlength="255" id="observaciones" rows="2" name="observaciones"><?php echo $clienteData['observaciones'] ?></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>

<script src="Assets/js/Validaciones/alta_cliente.js"></script>