const montoFinalModal = document.getElementById('montoFinal');
const formModalCerrarCaja = document.getElementById('formModalCerrarCaja');
const btnModalCerrarCaja = document.getElementById('btnModalCerrarCaja');

// Botón para cerrar caja
btnModalCerrarCaja.onclick = function() {
    let id = document.getElementById('idCajaCerrar').value;
    let monto = document.getElementById('montoFinal').value;
    if(id !== '' && monto !== '') {
        formModalCerrarCaja.submit();
    }
};

// Evento para cargar la vista al DOM
document.addEventListener('DOMContentLoaded', () => {
    // Cerrar caja
    document.querySelectorAll('#btnCerrarCaja').forEach(button => {
        button.addEventListener('click', async function() {
            await obtenerInfoCaja();
            const idCaja = this.getAttribute('data-id');
            const montoInicial = this.getAttribute('data-monto-inicial');
            document.getElementById('idCajaCerrar').value = idCaja;
            document.getElementById('montoFinal').value = montoInicial;
            $('#modalCerrarCaja').modal('show');
        });
    });
});

// Obtener información de caja para actualizar el monto final
async function obtenerInfoCaja() {
    const response = await fetch('Controller/Caja/caja.controlador.php?action=obtenerinfo');
    if (!response.ok) throw new Error("Error en la respuesta de la API");
    const data = await response.json();
    montoFinalModal.value = data[0]?.total ?? '';
}


document.addEventListener('DOMContentLoaded', () => {
    // Delegación de evento para los botones de ver historial de movimientos
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('btnVerHistorial')) {
            const idCaja = event.target.getAttribute('data-id');
            
            // Actualiza el contenido antes de cargar los datos
            const historialContainer = document.getElementById('historialMovimientosContent');
            historialContainer.innerHTML = 'Cargando historial...';
            
            obtenerHistorialMovimientos(idCaja)
                .then(data => {
                    console.log("Datos de movimientos:", data); // Verifica los datos obtenidos
                    renderizarHistorialMovimientos(data); // Renderiza los datos en el modal
                    $('#modalVerHistorial').modal('show'); // Muestra el modal
                })
                .catch(error => {
                    console.error("Error al obtener el historial de movimientos:", error);
                    historialContainer.innerHTML = '<p class="text-danger">Error al cargar el historial.</p>';
                });
        }
    });
});

// Función asincrónica para obtener el historial de movimientos
async function obtenerHistorialMovimientos(idCaja) {
    const response = await fetch(`Controller/Caja/caja.controlador.php?action=obtenerhistorial&idCaja=${idCaja}`);
    if (!response.ok) throw new Error("Error en la respuesta de la API");
    return response.json();
}

// Renderizar historial de movimientos en una tabla
function renderizarHistorialMovimientos(movimientos) {
    const historialContainer = document.getElementById('historialMovimientosContent');
    historialContainer.innerHTML = ''; 

    if (movimientos.length === 0) {
        historialContainer.innerHTML = '<p class="text-muted">No hay movimientos registrados para esta caja.</p>';
        return;
    }

    let tablaHistorial = `
        <table class="table table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>Tipo</th>
                    <th>Monto</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
    `;

    movimientos.forEach(mov => {
        tablaHistorial += `
            <tr>
                <td>${mov.tipoMovimiento}</td>
                <td>$ ${parseFloat(mov.monto).toFixed(2)}</td>
                <td>${mov.descripcion}</td>
                <td>${new Date(mov.fechaHora).toLocaleString()}</td>
            </tr>
        `;
    });

    tablaHistorial += `</tbody></table>`;
    historialContainer.innerHTML = tablaHistorial;
}
