<?php
include_once("Model/Caja/caja.php");
include_once("Model/Usuario/usuarios.php");
$cajas = Caja::listarCajas();
?>
<h1 class="h1 mb-4 text-center">Cajas</h1>
<div class="mb-3">
    <button class="btn btn-primary" id="btnAbrirNuevaCaja">Abrir Nueva Caja</button>
    <button class="btn btn-secondary" id="btnGenerarReporte">Generar Reporte</button>
</div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre de usuario</th>
                <th>Estado Caja</th>
                <th>Fecha Apertura</th>
                <th>Monto Inicial</th>
                <th>Fecha Cierre</th>
                <th>Monto Final</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cajas as $caja):
                $username = Usuario::obtenerUserName($caja['Empleado_idEmpleado']);
                ?>
                <tr>
                    <td><?= $username ?></td>
                    <td>
                        <span class="badge <?= $caja['estado'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                            <?= $caja['estado'] == 1 ? 'Abierta' : 'Cerrada' ?>
                        </span>
                    </td>
                    <td><?= $caja['fechaApertura'] ?></td>
                    <td>$ <?= $caja['montoInicial'] ?></td>
                    <td><?= $caja['fechaCierre'] ?? '' ?></td>
                    <td><?= $caja['montoFinal'] ? '$ ' . $caja['montoFinal'] : '' ?></td>
                    <!-- Cambia los id a class para seleccionar correctamente varios botones -->
                    <td>
                        <?php if ($caja['estado'] == 1): ?>
                            <button class="btn btn-danger btn-sm btnCerrarCaja"
                                data-id="<?= $caja['idCajas'] ?>">Cerrar</button>
                        <?php else: ?>
                            <button class="btn btn-info btn-sm btnVerHistorial" data-id="<?= $caja['idCajas'] ?>"
                                data-bs-toggle="modal" data-bs-target="#modalVerHistorial">Ver
                                Historial</button>
                        <?php endif; ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Historial de Movimientos -->
<div class="modal fade" id="modalVerHistorial" tabindex="-1" aria-labelledby="modalVerHistorialLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerHistorialLabel">Historial de Movimientos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="historialMovimientosContent" class="table-responsive">Cargando historial...</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Cerrar Caja-->
<div class="modal fade" id="modalCerrarCaja" tabindex="-1" aria-labelledby="modalCerrarCaja" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="modalCerrarCajaLabel">Cerrar Caja</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formModalCerrarCaja" action="Controller/Caja/caja.controlador.php?action=cerrarcaja"
                    method="POST">
                    <div class="mb-3">
                        <label for="montoFinal" class="form-label">Monto Final</label>
                        <input readonly type="number" class="form-control" id="montoFinal" name="montoFinal" required>
                        <input type="hidden" id="idCajaCerrar" name="idCaja">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="btnModalCerrarCaja">Cerrar Caja</button>
            </div>
        </div>
    </div>
</div>

<script src="Assets/js/Funciones/caja.js"></script>