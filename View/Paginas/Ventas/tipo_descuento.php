<?php
include_once("Model/Ventas/tipo_descuento.php");
$tipos_descuento = TipoDescuento::listarTipoDescuento();
?>

<h1 class="h4 text-center">Tipo Descuento</h1>
<div class="row">
    <!-- Columna para el Formulario -->
    <div class="col-md-6">
        <h2 class="h5 mt-4">Registrar Tipo Descuento</h2>

        <!-- Formulario de Registro -->
        <form action="Controller/Ventas/tipo_descuento.controlador.php" method="POST">
            <input type="hidden" name="action" value="registro">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion">
            </div>
            <div class="d-grid gap-1">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>

    <!-- Columna para el Listado -->
    <div class="col-md-6">
        <h2 class="h5 mt-4">Listado de Tipos de Descuento</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tipos_descuento)): ?>
                    <?php foreach ($tipos_descuento as $tipo): ?>
                        <tr>
                            <td><?php echo $tipo['nombre']; ?></td>
                            <td><?php echo $tipo['descripcion']; ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning"
                                    onclick="editarTipo(<?php echo $tipo['idtipoDescuento']; ?>, '<?php echo htmlspecialchars($tipo['nombre'], ENT_QUOTES); ?>', '<?php echo htmlspecialchars($tipo['descripcion'], ENT_QUOTES); ?>')">Editar</button>
                                <button class="btn btn-sm btn-danger"
                                    onclick="eliminarTipo(<?php echo $tipo['idtipoDescuento']; ?>)">Eliminar</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No hay registros de tipos de descuento.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para Edición -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="Controller/Ventas/tipo_descuento.controlador.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Tipo Descuento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="action" value="editar">
                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-3">
                        <label for="edit-nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="edit-descripcion" name="descripcion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editarTipo(id, nombre, descripcion) {
        // Asigna los valores al formulario del modal
        document.getElementById('edit-id').value = id;
        document.getElementById('edit-nombre').value = nombre;
        document.getElementById('edit-descripcion').value = descripcion;

        // Muestra el modal
        var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
        editarModal.show();
    }

    function eliminarTipo(id) {
        if (confirm('¿Estás seguro de eliminar este tipo de descuento?')) {
            window.location.href = 'Controller/Ventas/tipo_descuento.controlador.php?action=eliminar&id=' + id;
        }
    }
</script>
