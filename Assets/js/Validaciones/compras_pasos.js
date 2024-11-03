document.addEventListener('DOMContentLoaded', function() {
    // Elementos de los pasos
    const paso1 = document.getElementById('paso1');
    const paso2 = document.getElementById('paso2');
    const paso3 = document.getElementById('paso3');
    const progressBar = document.getElementById('progressBar');

    // Botones de navegación
    const btnSiguientePaso1 = document.getElementById('btnSiguientePaso1');
    const btnAnteriorPaso2 = document.getElementById('btnAnteriorPaso2');
    const btnSiguientePaso2 = document.getElementById('btnSiguientePaso2');
    const btnAnteriorPaso3 = document.getElementById('btnAnteriorPaso3');

    // Función para actualizar la barra de progreso
    function actualizarProgreso(paso) {
        const porcentaje = (paso * 33.33);
        progressBar.style.width = `${porcentaje}%`;
        progressBar.textContent = `Paso ${paso} de 3`;
    }

    // Eventos de navegación
    btnSiguientePaso1.addEventListener('click', function() {
        if (validarPaso1()) {
            paso1.style.display = 'none';
            paso2.style.display = 'block';
            actualizarProgreso(2);
        }
    });

    btnAnteriorPaso2.addEventListener('click', function() {
        paso2.style.display = 'none';
        paso1.style.display = 'block';
        actualizarProgreso(1);
    });

    btnSiguientePaso2.addEventListener('click', function() {
        if (validarPaso2()) {
            paso2.style.display = 'none';
            paso3.style.display = 'block';
            actualizarProgreso(3);
        }
    });

    btnAnteriorPaso3.addEventListener('click', function() {
        paso3.style.display = 'none';
        paso2.style.display = 'block';
        actualizarProgreso(2);
    });

    // Funciones de validación
    function validarPaso1() {
        const proveedorId = document.getElementById('proveedorId').value;
        if (!proveedorId) {
            alert('Por favor, seleccione un proveedor');
            return false;
        }
        return true;
    }

    function validarPaso2() {
        const carrito = document.getElementById('carrito');
        if (carrito.children.length === 0) {
            alert('Por favor, agregue al menos un producto al carrito');
            return false;
        }
        return true;
    }
}); 