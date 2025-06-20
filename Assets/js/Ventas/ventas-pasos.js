document.addEventListener('DOMContentLoaded', () => {
    // Inicialización de variables
    window.pasoActual = 1;
    const totalPasos = 3;

    // Referencias a elementos del DOM
    const btnSiguiente = document.getElementById('btnSiguiente');
    const btnAnterior = document.getElementById('btnAnterior');
    const btnFinalizar = document.getElementById('btnFinalizar');
    const pasos = document.querySelectorAll('.paso');
    const barraDeProgreso = document.getElementById('barra-de-progreso');
    const clienteIdInput = document.getElementById('clienteId');
    const alertasGenerales = document.getElementById('alertasGenerales');

    // Función para mostrar el paso actual
    const mostrarPaso = (paso) => {
        pasos.forEach((p, index) => {
            if (index + 1 === paso) {
                p.classList.remove('oculto');
            } else {
                p.classList.add('oculto');
            }
        });

        btnAnterior.style.display = paso === 1 ? 'none' : 'inline-block';
        btnSiguiente.style.display = paso === totalPasos ? 'none' : 'inline-block';
        btnFinalizar.style.display = paso === totalPasos ? 'inline-block' : 'none';

        const progreso = (paso / totalPasos) * 100;
        barraDeProgreso.style.width = `${progreso}%`;
    };

    // Botón "Siguiente"
    btnSiguiente.addEventListener('click', () => {
        if (window.pasoActual === 1 && (!clienteIdInput.value || clienteIdInput.value.trim() === '')) {
            alertasGenerales.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    Debe seleccionar un cliente o seleccionar venta rápida para continuar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            return;
        }

        if (window.pasoActual === 2 && (!window.carrito || window.carrito.length === 0)) {
            alertasGenerales.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    Debe agregar al menos un producto al carrito para continuar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            return;
        }

        if (clienteIdInput.value && clienteIdInput.value.trim() !== '') {
            alertasGenerales.innerHTML = '';
        }

        if (window.pasoActual < totalPasos) {
            window.pasoActual++;

            // ✅ Disparar evento personalizado cuando cambia el paso
            document.dispatchEvent(new CustomEvent('pasoCambiado', {
                detail: { paso: window.pasoActual }
            }));

            mostrarPaso(window.pasoActual);
        }
    });

    // Botón "Anterior"
    btnAnterior.addEventListener('click', () => {
        if (window.pasoActual > 1) {
            window.pasoActual--;

            // ✅ También podés notificar el cambio al ir atrás
            document.dispatchEvent(new CustomEvent('pasoCambiado', {
                detail: { paso: window.pasoActual }
            }));

            mostrarPaso(window.pasoActual);
        }
    });

    // Mostrar primer paso
    mostrarPaso(window.pasoActual);
});

// Función para actualizar el resumen de productos en el paso 3
function actualizarResumenVenta() {
    const resumenProductos = document.getElementById('resumenProductos');
    const totalFinal = document.getElementById('totalFinal');
    if (!resumenProductos || !totalFinal || !window.carrito) return;
    let total = 0;
    resumenProductos.innerHTML = '';
    window.carrito.forEach(p => {
        total += p.subtotal;
        resumenProductos.innerHTML += `
            <tr>
                <td>${p.nombre}</td>
                <td>${p.cantidad}</td>
                <td>$${p.precio.toFixed(2)}</td>
                <td>$${p.subtotal.toFixed(2)}</td>
            </tr>
        `;
    });
    totalFinal.innerText = `$${total.toFixed(2)}`;
}

// Actualizar resumen al cambiar de paso

document.addEventListener('pasoCambiado', (e) => {
    if (e.detail.paso === 3) {
        actualizarResumenVenta();
    }
});

// También actualizar al cargar el DOM si ya está en paso 3
if (window.pasoActual === 3) {
    actualizarResumenVenta();
}

// Actualizar resumen al cambiar el carrito (dinámico)
document.addEventListener('carritoActualizado', function(e) {
    if (window.pasoActual === 3) {
        actualizarResumenVenta();
    }
});

// Enviar datos al backend al confirmar venta
const btnConfirmarVenta = document.getElementById('btnConfirmarVenta');
if (btnConfirmarVenta) {
    btnConfirmarVenta.addEventListener('click', () => {
        const clienteId = document.getElementById('clienteId') ? document.getElementById('clienteId').value : null;
        const metodoPago = document.getElementById('metodoPago') ? document.getElementById('metodoPago').value : null;
        if (!clienteId || !metodoPago || window.carrito.length === 0) {
            alert('Debe seleccionar cliente, método de pago y tener productos en el carrito.');
            return;
        }
        fetch('Controller/Ventas/ventas.controlador.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                idcliente: clienteId,
                idmetodopago: metodoPago,
                carrito: window.carrito,
                total: window.carrito.reduce((acc, p) => acc + p.subtotal, 0)
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert('Venta registrada correctamente');
                window.location.reload();
            } else {
                alert('Error al registrar la venta: ' + (data.message || '')); 
            }
        })
        .catch(err => {
            alert('Error de conexión al registrar la venta');
        });
    });
}

