const btnVentas = document.getElementById('btnFinalizar');

btnVentas.onclick = function () {
    if (window.carrito.length === 0) {
        mostrarToastr("warning", "Debe agregar al menos un producto al carrito", "Carrito vacío");
        return;
    }

    const metodoPago = document.getElementById('metodoPago').value;
    const clienteId = document.getElementById('clienteId')?.value || null;

    if (!metodoPago) {
        mostrarToastr("warning", "Debe seleccionar un método de pago", "Falta información");
        return;
    }

    let total = window.carrito.reduce((acc, item) => acc + item['subtotal'], 0);

    const data = {
        action: 'ventas',
        carrito: window.carrito,
        total: parseFloat(total.toFixed(2)),
        idmetodopago: parseInt(metodoPago),
        idcliente: clienteId
    };

    // Desactivar botón para evitar múltiples envíos
    btnVentas.disabled = true;
    btnVentas.innerText = "Procesando...";

    fetch("Controller/Ventas/ventas.controlador.php?action=ventas", {
        method: "POST",
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en el servidor');
        return response.json();
    })
    .then(datos => {
        btnVentas.disabled = false;
        btnVentas.innerText = "Finalizar";

        if (!datos.success) {
            mostrarToastr("warning", datos.message || "Hay algunos campos vacíos o errores", "No se pudo completar la venta");
        } else {
            mostrarToastr("success", "Venta agregada correctamente", "Éxito");
            setTimeout(() => {
                window.location.reload();
            }, 1500);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        mostrarToastr("error", error.message || "Error en el servidor", "Fallo inesperado");
        btnVentas.disabled = false;
        btnVentas.innerText = "Finalizar";
    });
};

// 🔔 Función para mostrar notificaciones Toastr
function mostrarToastr(tipo, mensaje, titulo) {
    Command: toastr[tipo](mensaje, titulo);
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "4000",
        "extendedTimeOut": "1000"
    };
}

// 🧼 Función para limpiar la venta
function limpiarFormularioVenta() {
    window.carrito = [];
    if(document.getElementById('carrito')) document.getElementById('carrito').innerHTML = "";
    if(document.getElementById('totalCarrito')) document.getElementById('totalCarrito').innerText = "$0.00";
    if(document.getElementById('totalFinal')) document.getElementById('totalFinal').innerText = "$0.00";
    if(document.getElementById('resumenCliente')) document.getElementById('resumenCliente').innerText = "No especificado";
    if(document.getElementById('metodoPago')) document.getElementById('metodoPago').value = "";
    if(document.getElementById('divDetallesPago')) document.getElementById('divDetallesPago').style.display = "none";
    if(document.getElementById('buscarProducto')) document.getElementById('buscarProducto').value = "";
    if(document.getElementById('listaProductos')) document.getElementById('listaProductos').innerHTML = "";
    if(document.getElementById('clienteId')) document.getElementById('clienteId').value = "";
    if(document.getElementById('buscarCliente')) document.getElementById('buscarCliente').value = "";
    if(document.getElementById('resumenProductos')) document.getElementById('resumenProductos').innerHTML = "";
    // Reiniciar paso a 1 si es necesario
    window.pasoActual = 1;
    if(typeof mostrarPaso === 'function') mostrarPaso(1);
    // Enfocar el primer campo del paso 1
    setTimeout(() => {
        if(document.getElementById('buscarCliente')) document.getElementById('buscarCliente').focus();
    }, 200);
}
