

<div class="container mt-5">
    <h1><?php echo isset($combo) ? "Editar Combo" : "Crear Nuevo Combo"; ?></h1>
    <form action="guardar_combo.php" method="post">
        <input type="hidden" name="id" value="<?php echo $combo['idcombos'] ?? ''; ?>">

        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?php echo $combo['nombre'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control"><?php echo $combo['descripcion'] ?? ''; ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Valor Descuento:</label>
            <input type="number" name="valorDescuento" class="form-control" step="0.01" value="<?php echo $combo['valorDescuento'] ?? ''; ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo de Descuento:</label>
            <select name="tipoDescuento_idtipoDescuento" class="form-select">
                <?php foreach ($tiposDescuento as $tipo) { ?>
                    <option value="<?php echo $tipo['idtipoDescuento']; ?>" <?php echo isset($combo) && $combo['tipoDescuento_idtipoDescuento'] == $tipo['idtipoDescuento'] ? 'selected' : ''; ?>>
                        <?php echo $tipo['nombre']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de Vencimiento:</label>
            <input type="date" name="fechaVencimiento" class="form-control" value="<?php echo $combo['fechaVencimiento'] ?? ''; ?>">
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="estado" class="form-check-input" <?php echo isset($combo['estado']) && $combo['estado'] ? 'checked' : ''; ?>>
            <label class="form-check-label">Activo</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Productos:</label>
            <select name="productos[]" class="form-select" multiple>
                <?php foreach ($productos as $producto) { ?>
                    <option value="<?php echo $producto['idProductos']; ?>" <?php echo isset($combo) && in_array($producto['idProductos'], $comboProductos) ? 'selected' : ''; ?>>
                        <?php echo $producto['nombre']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="lista_combos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>