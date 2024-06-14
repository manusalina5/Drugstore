<div class="row ">
    <div class="col">
    </div>
    <div class="col">
        <h1>Registrar Persona</h1>
        <form class="" action="Controller/Personas/persona.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <select class="form-select" aria-label="Select TipoDocumento" required name="idtipoDocumentos">
                    <option selected>Elija tipo de documento</option>
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
            <div class="mb-3"><input type="text" class="form-control" placeholder="Ingrese su documento" aria-label="documento" name="documento"></div>
            <div class="mb-3">
                <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto">
                    <option selected>Elija tipo de contacto</option>
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
            <div class="mb-3"><input type="text" class="form-control" placeholder="Ingrese su contacto" aria-label="contacto" name="contacto"></div>
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>
    </div>
    <div class="col">
    </div>
</div>