
            <!-- Tipo Contacto -->
            <div class="mb-3">
                <label id="label-select" for="tipocontacto" class="font-weight-bold">Contacto</label>
                <select class="form-select" aria-label="Select TipoContacto" required name="idtipoContacto" id="tipocontacto">
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
                <input type="text" class="form-control" placeholder="Ingrese su contacto" aria-label="contacto" name="contacto" id="contacto">
            </div>

            