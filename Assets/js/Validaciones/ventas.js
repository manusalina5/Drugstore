const btnVentas = document.getElementById('btnConfirmarVenta');

btnVentas.onclick = function () {

    let total = 0;
    carrito.forEach(element => {
        total += element['subtotal'];
    });

    //alert(total);

    const data = {
        action: 'ventas',
        carrito: carrito,
        total: parseFloat(total),
        idmetodopago: parseInt(document.getElementById('metodoPago').value),
        idcliente: document.getElementById('clienteId').value
    }

    fetch("Controller/Ventas/ventas.controlador.php?action=ventas", {
        method: "POST", // Tipo de petición
        headers: {
            'Content-Type': 'application/json' // Especifica que el cuerpo de la petición está en formato JSON
        },
        body: JSON.stringify(data) // Convierte el objeto `data` en una cadena JSON
    })
        .then(response => response.json()) // Convierte la respuesta en JSON
        .then(datos => {
            if (!datos.success) {
                Command: toastr["warning"]("Hay algunos campos vacíos", "No se pudo completar la venta")

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            } else {
                Command: toastr["success"]("Venta agregada correctamente!", "Exito")

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
}

