document.addEventListener('DOMContentLoaded', () => {
    // Inicialización de variables
    let pasoActual = 1;
    const totalPasos = 3;

    // Referencias a elementos del DOM
    const btnSiguiente = document.getElementById('btnSiguiente');
    const btnAnterior = document.getElementById('btnAnterior');
    const btnFinalizar = document.getElementById('btnFinalizar'); // Referencia al botón "Finalizar"
    const pasos = document.querySelectorAll('.paso');
    const barraDeProgreso = document.getElementById('barra-de-progreso');
    const clienteIdInput = document.getElementById('clienteId'); // Referencia al input del cliente seleccionado
    const alertasGenerales = document.getElementById('alertasGenerales'); // Referencia al contenedor de alertas generales

    // Función para mostrar el paso actual
    const mostrarPaso = (paso) => {
        pasos.forEach((p, index) => {
            if (index + 1 === paso) {
                p.classList.remove('oculto');
            } else {
                p.classList.add('oculto');
            }
        });

        // Mostrar u ocultar botones según el paso actual
        btnAnterior.style.display = paso === 1 ? 'none' : 'inline-block';
        btnSiguiente.style.display = paso === totalPasos ? 'none' : 'inline-block';
        btnFinalizar.style.display = paso === totalPasos ? 'inline-block' : 'none'; // Mostrar solo en el último paso

        // Actualizar la barra de progreso
        const progreso = (paso / totalPasos) * 100;
        barraDeProgreso.style.width = `${progreso}%`;
    };

    // Manejar clic en "Siguiente"
    btnSiguiente.addEventListener('click', () => {
        // Validar si hay un cliente seleccionado antes de avanzar
        if (pasoActual === 1 && (!clienteIdInput.value || clienteIdInput.value.trim() === '')) {
            // Insertar la alerta en el contenedor de alertas generales
            alertasGenerales.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    Debe seleccionar un cliente o seleccionar venta rápida para continuar.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;

            return; // Detener el avance al siguiente paso
        }

        if(clienteIdInput.value && clienteIdInput.value.trim() !== '') {
            // Limpiar alertas previas en el contenedor de alertas generales
            alertasGenerales.innerHTML = '';
        }

        if (pasoActual < totalPasos) {
            pasoActual++;
            mostrarPaso(pasoActual);
        }
    });

    // Manejar clic en "Anterior"
    btnAnterior.addEventListener('click', () => {
        if (pasoActual > 1) {
            pasoActual--;
            mostrarPaso(pasoActual);
        }
    });

    // Mostrar el primer paso al cargar la página
    mostrarPaso(pasoActual);
});
