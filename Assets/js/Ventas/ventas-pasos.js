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
