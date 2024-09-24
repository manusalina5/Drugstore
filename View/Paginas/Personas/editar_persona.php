<?php
include_once 'Model/Personas/persona.php';
include_once 'config/conexion.php';

if (isset($_GET['idPersona'])) {
    $id = $_GET['idPersona'];
    $persona = new Persona();
    $persona->setId($id);
    $personaData = $persona->obtenerPersonasPorId();
} else {
    echo "El form esta vacio";
}

?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Persona</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Personas/persona.controlador.php" method="POST" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idPersona" value="<?php echo $personaData['idPersona']; ?>">

            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $personaData['nombre']; ?>" required>
            </div>

            <!-- Apellido -->
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $personaData['apellido']; ?>" required>
            </div>

            <!-- Tipo Documento -->
            <div class="mb-3">
                <label for="tipodocumento" class="font-weight-bold">Documento</label>
                <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos" id="tipodocumento">

                    <?php
                    include_once('Model/Personas/Documento/tipoDocumento.php');
                    include_once('Model/Personas/Documento/Documento.php');

                    $documento = new Documento();
                    $documento->setPersonaId($id);
                    $documentoObt = $documento->obtenerDocumentoPorId();

                    if (!empty($documentoObt)) {
                        echo "<option selected value='{$documentoObt['idtipoDocumentos']}'>{$documentoObt['valorTipoDocumentos']}</option>";
                    } else {
                        echo "<option selected value=''>Seleccione un Tipo de Documento</option>";
                    }


                    $tipoDocumentoObj = new TipoDocumento();
                    $tipoDocumentos = $tipoDocumentoObj->obtenerTipoDocumentos();
                    if (!empty($tipoDocumentos)) {
                        foreach ($tipoDocumentos as $tipoDocumento) {
                            echo "<option value='{$tipoDocumento['idtipoDocumentos']}'>{$tipoDocumento['valor']}</option>";
                        }
                    }


                    echo '</select>';
                    echo '</div>';


                    // Documento
                    echo '<div class="mb-3">';
                    if (!empty($documentoObt['valorDocumento'])) {
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' id='documento' name='documento' value='" . $documentoObt['valorDocumento'] . "'>";
                    } else {
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' id='documento' name='documento'>";
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
                            $contacto->setPersona_idPersona($id);
                            $contactoObt = $contacto->obtenerContactoPorId();
                            if (!empty($contactoObt)) {
                                echo "<option selected value='{$contactoObt['idtipoContacto']}'>{$contactoObt['valorTipoContactos']}</option>";
                            } else {
                                echo "<option selected value='''>Seleccione un Tipo de Contacto</option>";
                            }


                            $tipoContactoObj = new TipoContacto();
                            $tipoContactos = $tipoContactoObj->obtenerTipoContacto();

                            if (!empty($tipoContactos)) {
                                foreach ($tipoContactos as $tipoContacto) {
                                    echo "<option value='{$tipoContacto['idtipoContacto']}'>{$tipoContacto['valor']}</option>";
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
                                $direccion->setPersona_idPersona($personaData['idPersona']);
                                $direccionData = $direccion->obtenerDireccionPorId();
                                if (!empty($direccionData)) {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' name='direccion'>{$direccionData['descripcion']}</textarea>";
                                } else {
                                    echo "<textarea class='form-control' required maxlength='255'  id='direccion' rows='1' name='direccion'></textarea>";
                                }
                                ?>
                            </div>
                            
                            <button type="submit" class="btn btn-primary text-center">Guardar</button>
        </form>

    </div>

    <div class="col"></div>
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


<script src="Assets/js/Validaciones/alta_persona.js"></script>