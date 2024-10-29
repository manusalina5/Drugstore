const btnGuardarMovimiento = document.getElementById('btnGuardarMovimiento');

btnGuardarMovimiento.onclick = function() {
    const data = {
        tipoMovimiento : document.getElementById('tipoMovimiento').value,
        monto : document.getElementById('monto').value,
        descripcion : document.getElementById('descripcion').value,
        metodoPago : document.getElementById('metodoPago').value
    }

    fetch("Controller/Caja/movimiento.caja.controlador.php?action=guardarMovimiento", {
        method: "POST", // Tipo de petición
        headers: {
            'Content-Type': 'application/json' // Especifica que el cuerpo de la petición está en formato JSON
        },
        body: JSON.stringify(data) // Convierte el objeto `data` en una cadena JSON
    })
        .then(response => response.json()) // Convierte la respuesta en JSON
        .then(success => {
            if (!success) {
                Command: toastr["warning"]("Hay algunos campos vacíos", "No se pudo la operación");

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
                Command: toastr["success"]("Aumento realizado correctamente!", "Éxito");

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

                document.getElementById("cerrarModal").click();
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
};