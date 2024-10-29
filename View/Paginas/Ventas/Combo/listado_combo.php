<?php
include_once("Model/Ventas/combo.php");
$combos = Combo::listarCombo();

?>

<div class="container mt-5">
    <h1 class="mb-4">Combos Disponibles</h1>
    <a href="crear_combo.php" class="btn btn-primary mb-3">Crear Nuevo Combo</a>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Valor Descuento</th>
                <th>Tipo de Descuento</th>
                <th>Fecha de Vencimiento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($combos)): ?>
                <tr>
                    <td colspan="7" class="text-center">No se encuentran registros.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($combos as $combo): ?>
                    <tr>
                        <td><?php echo $combo['nombre']; ?></td>
                        <td><?php echo $combo['descripcion']; ?></td>
                        <td><?php echo $combo['valorDescuento']; ?></td>
                        <td><?php echo $combo['tipoDescuento']; ?></td>
                        <td><?php echo $combo['fechaVencimiento']; ?></td>
                        <td><?php echo $combo['estado'] ? "Activo" : "Inactivo"; ?></td>
                        <td>
                            <a href="detalle_combo.php?id=<?php echo $combo['idcombos']; ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="editar_combo.php?id=<?php echo $combo['idcombos']; ?>"
                                class="btn btn-warning btn-sm">Editar</a>
                            <a href="eliminar_combo.php?id=<?php echo $combo['idcombos']; ?>"
                                onclick="return confirm('¿Estás seguro?')" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
    </table>
</div>