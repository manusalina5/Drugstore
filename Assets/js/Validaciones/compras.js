const btnCompras = document.getElementById('btnConfirmarCompra');

btnCompras.onclick = function (){

    let total = 0;
    carrito.forEach(element => {
        total += element['subtotal'];
    });

    const data = {
        action : 'compras',
        carrito: carrito,
        total: parseFloat(total),
        idmetodopago: parseInt(document.getElementById('metodopago').value),
    }

    fetch("Controller/Compras/compras.controllador.php?action=compras",{
        method: "POST",
        headers: {
            'Content-Type': 'application/json' 
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
        .then(datos =>{
            if(!datos.success){
                Command: toastr["warning"]("Hay algunos campos vacíos", "No se pudo completar la compra")

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
            }else{
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