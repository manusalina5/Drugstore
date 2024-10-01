<h1 class="text-center mb-4">Movimientos de Caja</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Tipo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($movimientos as $movimiento): ?>
                    <tr>
                        <td><?php echo $movimiento['fecha']; ?></td>
                        <td><?php echo $movimiento['hora']; ?></td>
                        <td><?php echo $movimiento['descripcion']; ?></td>
                        <td><?php echo $movimiento['monto']; ?></td>
                        <td><?php echo $movimiento['tipo'] == 'ingreso' ? 'Ingreso' : 'Egreso'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>