<div class="row">
    <div class="col"></div>
    <div class="col">

        <h2 class="mt-5">Gestión de Accesos</h2>
        <form action="Controller/Usuario/accesos.controlador.php" method="POST">
            <?php
            include_once('Model/Usuario/modulos.php');
            include_once('Model/Usuario/perfiles.php');
            include_once('Model/Usuario/perfilModulo.php');

            $perfil = new Perfil();

            $modulo = new Modulos();

            $perfiles = $perfil->obtenerPerfiles();
            $modulos = $modulo->obtenerModulos();

            ?>

            <div class="mb-3">
                <label for="perfil" class="form-label">Seleccione Perfil:</label>
                <select name="perfil" id="perfil" class="form-select">
                    <?php
                    foreach ($perfiles as $perfil) {
                        echo "<option value='{$perfil['idPerfiles']}'>{$perfil['nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Seleccione Módulos:</label>
                <div class="form-check">
                    <?php foreach ($modulos as $modulo) { ?>
                        <input class="form-check-input" type="checkbox" name="modulos[]" value="<?php echo $modulo['idmodulos']; ?>" id="modulo-<?php echo $modulo['idmodulos']; ?>">
                        <label class="form-check-label" for="modulo-<?php echo $modulo['idmodulos']; ?>">
                            <?php echo $modulo['nombre']; ?>
                        </label><br>
                    <?php } ?>
                </div>
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            
        </form>
    </div>
    <div class="col"></div>
</div>