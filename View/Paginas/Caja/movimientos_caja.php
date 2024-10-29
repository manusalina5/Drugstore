<?php
include_once("Model/Caja/movimientocaja.php");
$movimientos = MovimientoCaja::listarMovimientosCaja();
include_once 'Model/Ventas/MetodoPago/metodopago.php';
$metodosDePagos = MetodoPago::obtenerMetodoPago();
?>
<h1 class="h1 mb-4 text-center">Movimientos de Cajas</h1>
<div class="mb-3">
    <button class="btn btn-success" id="btnAgregarMovimiento" data-bs-toggle="modal" data-bs-target="#modalAgregarMovimiento">Nuevo Movimiento de Caja</button>
    <a class="btn btn-primary" id="btnVerCajas" href="index.php?page=listado_caja&modulo=caja">Ver Cajas</a>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tipo de Movimiento</th>
                <th>Monto</th>
                <th>Descripcion Actual</th>
                <th>Fecha Hora</th>
                <th>Metodo Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php
            #tipoMovimiento, monto, descripcion, fechaHora, metodopago
            if ($movimientos !== false) {
                foreach ($movimientos as $movimiento) {
                    echo "
                            <tr>
                                <td>{$movimiento['tipoMovimiento']}</td>
                                <td>{$movimiento['monto']}</td>
                                <td>{$movimiento['descripcion']}</td>
                                <td>{$movimiento['fechaHora']}</td>
                                <td>{$movimiento['metodopago']}</td>
                            </tr>
                        ";
                }
            } else {
                echo "<td colspan='5' class='text-center'>No hay movimientos de caja registrados</td>";
            }
            ?>
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="modalAgregarMovimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="h1 modal-title fs-5" id="exampleModalLabel">Nuevo Movimiento de Caja</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="tipoMovimiento" class="form-label">Tipo de Movimiento</label>
                        <select class="form-select" id="tipoMovimiento">
                            <option selected value="Egreso">Egreso</option>
                            <option value="Ingreso">Ingreso</option>
                        </select>
                    </div>
                    <!-- idmovimientoCaja, tipoMovimiento, monto, descripcion, fechaHora, caja_idCajas, metodopago_idmetodoPago -->
                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto</label>
                        <input type="number" class="form-control" id="monto">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion">
                    </div>
                    <div class="mb-3">
                        <label for="metodoPago" class="form-label">Metodo de pago</label>
                        <select class="form-select" id="metodoPago">
                            <?php
                            foreach ($metodosDePagos as $metodopago) {
                                $id = $metodopago['idmetodoPago'];
                                $nombre = $metodopago['nombre'];
                                echo "<option value='$id'>$nombre</option>";
                            }
                            ?>
                        </select>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="cerrarModal" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" id="btnGuardarMovimiento">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script src="Assets/js/Altas/movimientoscaja.js"></script>