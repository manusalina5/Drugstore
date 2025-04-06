// registroCombo.js

document.addEventListener("DOMContentLoaded", function () {
    const btnGuardarCombo = document.getElementById('btnGuardarCombo');

    btnGuardarCombo.onclick = function guardarCombo() {
        const selectedProducts = window.getSelectedProducts();
        const data = {
            productos: selectedProducts,
            nombre: document.getElementById('nombre').value,
            descripcion: document.getElementById('descripcion').value,
            valor: document.getElementById('valor').value,
            tipovalor: document.getElementById('tipodescuento').value,
            fechavencimiento: document.getElementById('fechavencimiento').value
        };

        // Aquí se enviaría el 'data' al servidor o se realiza otra acción de registro
        console.log(data);

//         fetch('Controller/Ventas/combo.controlador.php?action=registro',{
//             method: "POST",
//             header:{
//                 "Content-Type": "application/json",
//             },
//             body: JSON.stringify(data),
//         })
//             .then((response) => response.json())
//             .then((datos) => {
//                 if (!datos.success) {
//                     Command: toastr["warning"](
//                         "Hay algunos campos vacíos",
//                         "No se pudo completar el registro"
//                     );
    
//                     toastr.options = {
//                         closeButton: true,
//                         debug: false,
//                         newestOnTop: false,
//                         progressBar: true,
//                         positionClass: "toast-top-right",
//                         preventDuplicates: false,
//                         onclick: null,
//                         showDuration: "300",
//                         hideDuration: "1000",
//                         timeOut: "5000",
//                         extendedTimeOut: "1000",
//                         showEasing: "swing",
//                         hideEasing: "linear",
//                         showMethod: "fadeIn",
//                         hideMethod: "fadeOut",
//                     };
//                     console.log(datos.data);
//                 } else {
//                     Command: toastr["success"]("Combo agregado correctamente!", "Exito");
    
//                     toastr.options = {
//                         closeButton: true,
//                         debug: false,
//                         newestOnTop: false,
//                         progressBar: true,
//                         positionClass: "toast-top-right",
//                         preventDuplicates: false,
//                         showDuration: "300",
//                         hideDuration: "1000",
//                         timeOut: "5000",
//                         extendedTimeOut: "1000",
//                         showEasing: "swing",
//                         hideEasing: "linear",
//                         showMethod: "fadeIn",
//                         hideMethod: "fadeOut",
//                     };
    
//                     modal.hide();
//                     // Recargar la página si la operación fue exitosa
//                     setTimeout(() => {
//                         location.reload();
//                     }, 3000);
//                 }})
//                 .catch((error) => {
//                     console.error("Error:", error);
//                 });
//     };
// });
}})