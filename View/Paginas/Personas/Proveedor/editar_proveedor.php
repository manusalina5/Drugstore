<?php

include_once 'Model/Personas/Proveedor/proveedor.php';
include_once 'config/conexion.php';

if (isset($_GET['idProveedor'])) {
    $idProveedor = $_GET['idProveedor'];
    $proveedor = new Proveedor();
    $proveedor->setIdProveedor($idProveedor);
    $proveedorData = $proveedor->obtenerProveedoresPorId();
    // print_r($proveedorData);
    // exit();
} else {
    echo "Error: El id está vacio";
}


?>

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1 class="text-center">Modificar Proveedor</h1>
        <form action="Controller/Personas/Proveedor/proveedor.controlador.php" method="POST">
            <h3>Datos Personales</h3>
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idProveedor" value="<?php echo $proveedorData['idProveedor']; ?>">
            <input type="hidden" name="idPersona" value="<?php echo $proveedorData['idPersona']; ?>">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese sus nombres" value="<?php echo $proveedorData['nombre']; ?>">
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ingrese sus apellidos" value="<?php echo $proveedorData['apellido']; ?>">
            </div>

            <!-- Razón Social -->
            <div class="mb-3">
                <label for="razonSocial" class="form-label">Razón Social</label>
                <input type="text" class="form-control" id="razonSocial" name="razonSocial" required placeholder="Ingrese la Razon Social" value="<?php echo $proveedorData['razonSocial'] ?>">
            </div>

            <!-- Tipo Documento -->
            <div class="mb-3">
                <label for="tipodocumento" class="font-weight-bold">Documento</label>
                <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos" id="tipodocumento">

                    <?php
                    include_once('Model/Personas/Documento/tipoDocumento.php');
                    include_once('Model/Personas/Documento/Documento.php');

                    $documento = new Documento();
                    $documento->setPersonaId($proveedorData['idPersona']);
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
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' name='documento' value='" . $documentoObt['valorDocumento'] . "'>";
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
                            $contacto->setPersona_idPersona($proveedorData['idPersona']);
                            $contactoObt = $contacto->obtenerContactoPorId();
                            // if (!empty($contactoObt)) {
                            //     echo "<option selected value='{$contactoObt['idtipoContacto']}'>{$contactoObt['valorTipoContactos']}</option>";
                            // } else {
                            //     echo "<option selected value='''>Seleccione un Tipo de Contacto</option>";
                            // }


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
                                echo "<input type='text' class='form-control' placeholder='Ingrese su contacto' aria-label='contacto' name='contacto' value='{$contactoObt['valorContacto']}'>";
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
                                $direccion->setPersona_idPersona($proveedorData['idPersona']);
                                $direccionData = $direccion->obtenerDireccionPorId();
                                if (!empty($direccionData)) {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' name='direccion'>{$direccionData['descripcion']}</textarea>";
                                } else {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' name='direccion'></textarea>";
                                }
                                ?>
                            </div>


                            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>