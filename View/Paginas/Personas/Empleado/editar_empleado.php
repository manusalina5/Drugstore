<?php

include_once 'Model/Personas/Empleado/empleado.php';
include_once 'config/conexion.php';

if (isset($_GET['idEmpleado'])) {
    $idEmpleado = $_GET['idEmpleado'];
    $empleado = new Empleado();
    $empleado->setIdEmpleado($idEmpleado);
    $empleadoData = $empleado->obtenerEmpleadosPorId();
    // print_r($empleadoData);
    // exit();
} else {
    echo "Error: El id está vacio";
}


?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1 class="text-center">Modificar Empleado</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Personas/Empleado/empleado.controlador.php" method="POST" onsubmit="return validate(event)">
            <h3>Datos Personales</h3>
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idEmpleado" value="<?php echo $empleadoData['idEmpleado']; ?>">
            <input type="hidden" name="idPersona" value="<?php echo $empleadoData['idPersona']; ?>">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ingrese sus nombres" value="<?php echo $empleadoData['nombre']; ?>">
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ingrese sus apellidos" value="<?php echo $empleadoData['apellido']; ?>">
            </div>

            <!-- Tipo Documento -->
            <div class="mb-3">
                <label for="tipodocumento" class="font-weight-bold">Documento</label>
                <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos" id="tipodocumento">

                    <?php
                    include_once('Model/Personas/Documento/tipoDocumento.php');
                    include_once('Model/Personas/Documento/Documento.php');

                    $documento = new Documento();
                    $documento->setPersonaId($empleadoData['idPersona']);
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
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' name='documento' id='documento'>";
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
                            $contacto->setPersona_idPersona($empleadoData['idPersona']);
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
                                echo "<input type='text' class='form-control' placeholder='Ingrese su contacto' aria-label='contacto' id='contacto' name='contacto' value='{$contactoObt['valorContacto']}'>";
                            } else {
                                echo "<input type='text' class='form-control' placeholder='Ingrese su contacto' aria-label='contacto' id='contacto' name='contacto'>";
                            }
                            echo "</div>";
                            ?>

                            <!-- Dirección -->
                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <?php
                                include_once('Model/Personas/Direccion/Direccion.php');
                                $direccion = new Direccion();
                                $direccion->setPersona_idPersona($empleadoData['idPersona']);
                                $direccionData = $direccion->obtenerDireccionPorId();
                                if (!empty($direccionData)) {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' name='direccion'>{$direccionData['descripcion']}</textarea>";
                                } else {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' name='direccion'></textarea>";
                                }
                                ?>
                            </div>

                            <!-- Legajo -->
                            <div class="mb-3">
                                <label for="legajo" class="form-label">Legajo</label>
                                <input type="text" class="form-control" id="legajo" name="legajo" required placeholder="Ingrese el legajo" value="<?php echo $empleadoData['legajo'] ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
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

<script src="Assets/js/Validaciones/alta_empleado.js"></script>