<?php
include_once("Model/Ventas/tipo_descuento.php");
$tiposDescuento = TipoDescuento::listarTipoDescuento(); 

//idcombos, nombre, valorDescuento, descripcion, estado, tipoDescuento_idtipoDescuento, fechaVencimiento
?>
<div class="container mt-5">

    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col">
                <h1>Crear Nuevo Combo</h1>
                <form action="Controller/Ventas/combo.controlador.php" method="post">
                    <input type="hidden" name="id">
                    <div class="mb-3">
                        <label class="form-label">Nombre:</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción:</label>
                        <textarea name="descripcion" class="form-control"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Valor Descuento:</label>
                        <input type="number" name="valorDescuento" class="form-control" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipo de Descuento:</label>
                        <select name="tipoDescuento_idtipoDescuento" class="form-select">
                            <?php foreach ($tiposDescuento as $tipo) { ?>
                                <option value="<?php echo $tipo['idtipoDescuento']; ?>">
                                    <?php echo $tipo['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha de Vencimiento:</label>
                        <input type="date" name="fechaVencimiento" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="lista_combos.php" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
            <div class="col">

            </div>
        </div>
    </div>


</div>