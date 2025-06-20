const resumenCliente = document.getElementById('resumenCliente');
const clienteNombre = document.getElementById('listCardNombre');
const clienteApellido = document.getElementById('listCardApellido');

document.addEventListener('pasoCambiado', (e) => {
    const paso = e.detail.paso;

    if (paso === 3) {
        cargarResumenDeVenta();
    }
});

document.addEventListener('DOMContentLoaded', () => {
    if (window.pasoActual === 3) {
        cargarResumenDeVenta();
    }
});

function cargarResumenDeVenta() {
    const nombre = clienteNombre.dataset.valor || 'N/A';
    const apellido = clienteApellido.dataset.valor || 'N/A';
    const clienteNombreFull = `${nombre} ${apellido}`;

    resumenCliente.innerText = clienteNombreFull;
    
}
