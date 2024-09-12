<div class="row">
    <div class="col"></div>
    <div class="col">

        <h2 class="mt-5 text-center">Gestión de Accesos</h2>
        <form action="Controller/Usuario/accesos.controlador.php" method="POST">
            <?php
            include_once('Model/Usuario/modulos.php');
            include_once('Model/Usuario/perfiles.php');
            include_once('Model/Usuario/perfilModulo.php');

            $perfil = new Perfil();
            $modulo = new Modulos();
            $perfilModulo = new PerfilModulo();


            $modulos = $modulo->obtenerModulos();

            // Obtener el perfil seleccionado 
            $idPerfilSeleccionado = $_GET['idPerfiles'] ?? null;

            $perfiles = [];

            while ($row = $perfil->obtenerPerfilesPorId($idPerfilSeleccionado)) {
                $perfiles[] = $row;
                break;
            }

            // Obtener los módulos que ya tiene asignados el perfil seleccionado
            $modulosAsignados = [];
            if ($idPerfilSeleccionado) {
                $resultado = $perfilModulo->obtenerModulosPorPerfil($idPerfilSeleccionado);

                // Convertir el resultado en un array
                while ($row = $resultado->fetch_assoc()) {
                    $modulosAsignados[] = $row['modulos_idmodulos'];
                }
            }


            ?>


            <div class="mb-3">
                <h3>
                    <?php
                    foreach ($perfiles as $perfil) {
                        echo $perfil['nombre'];
                    }
                    ?>
                </h3>
            </div>

            <!-- Array ( [0] => Array ( [idmodulos] => 1 [nombre] => usuarios [estado] => 1 )  -->


            <div class="mb-3">
                <label class="form-label">Seleccione Módulos:</label>
                <div class="form-check">
                    <?php foreach ($modulos as $modulo) {
                        // Comprobar si el módulo está en la lista de módulos asignados
                        $checked = in_array($modulo['idmodulos'], $modulosAsignados) ? "checked" : "";
                    ?>
                        <input type="hidden" name="perfil" value='<?php echo $idPerfilSeleccionado; ?>'>
                        <input class="form-check-input" type="checkbox" name="modulos[]" value="<?php echo $modulo['idmodulos']; ?>" id="modulo-<?php echo $modulo['idmodulos']; ?>" <?php echo $checked; ?>>
                        <label class="form-check-label" for="modulo-<?php echo $modulo['idmodulos']; ?>">
                            <?php echo $modulo['nombre']; ?>
                        </label><br>
                    <?php } ?>
                </div>
            </div>

            <div class="mb-3">
                <div class="d-grid gap-1">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>


            <div class=" d-grid gap-1">
                <a href="index.php?page=listado_perfiles&modulo=usuarios&submodulo=perfiles" class="btn btn-primary">Ver perfiles</a>

            </div>

        </form>


    </div>
    <div class="col"></div>
</div>