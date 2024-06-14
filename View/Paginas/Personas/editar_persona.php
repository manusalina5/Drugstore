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

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Persona</h1>
        <form action="Controller/Personas/persona.controlador.php" method="POST">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idPersona" value="<?php echo $personaData['idPersona']; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $personaData['nombre']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $personaData['apellido']; ?>" required>
            </div>

            <div class="mb-3">
                <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos">

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
                    echo '<div class="mb-3">';
                    if (!empty($documentoObt['valorDocumento'])) {
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' name='documento' value='" . $documentoObt['valorDocumento'] . "'>";
                    } else {
                        echo "<input type='text' class='form-control' placeholder='Ingrese su documento' aria-label='documento' name='documento'>";
                    }
                    echo '</div>';

                    ?>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto">

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
                            echo "<div class='mb-3'>";
                            if (!empty($contactoObt)) {
                                echo "<input type='text' class='form-control' placeholder='Ingrese su contacto' aria-label='contacto' name='contacto' value='{$contactoObt['valorContacto']}'>";
                            } else {
                                echo "<input type='text' class='form-control' placeholder='Ingrese su contacto' aria-label='contacto' name='contacto'>";
                            }

                            echo "</div>";
                            ?>
                            <button type="submit" class="btn btn-primary text-center">Guardar</button>
        </form>

    </div>

    <div class="col"></div>
</div>