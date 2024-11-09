const btnCompras = document.getElementById("btnConfirmarCompra");
const modal = new bootstrap.Modal(
    document.getElementById("modalConfirmarCompra")
);
const btnModal = document.getElementById("confirmarCompraBtn");
document.getElementById("codBarras").onchange = limpiarCamposProductos;
document.getElementById("buscarProducto").onchange = limpiarCamposProductos;

btnCompras.onclick = function () {
    modal.show();
};

btnModal.onclick = function () {
    btnModal.disabled = true;
    let total = 0;
    carrito.forEach((element) => {
        total += element["subtotal"];
    });

    const data = {
        action: "compras",
        carrito: carrito,
        total: parseFloat(total),
        idProveedor: parseInt(document.getElementById("proveedorId").value),
        idmetodopago: parseInt(document.getElementById("metodoPago").value),
    };

    fetch("Controller/Compras/compra.controlador.php?action=compras", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((datos) => {
            if (!datos.success) {
                Command: toastr["warning"](
                    "Hay algunos campos vacíos",
                    "No se pudo completar la compra"
                );

                toastr.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: false,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                };
                console.log(datos.data);
            } else {
                Command: toastr["success"]("Venta agregada correctamente!", "Exito");

                toastr.options = {
                    closeButton: true,
                    debug: false,
                    newestOnTop: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    preventDuplicates: false,
                    showDuration: "300",
                    hideDuration: "1000",
                    timeOut: "5000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                };

                modal.hide();
                // Recargar la página si la operación fue exitosa
                setTimeout(() => {
                    location.reload();
                }, 3000);
            }
        })
        .catch((error) => {
            console.error("Error:", error);
        });
};

let currentStep = 1;
const totalSteps = 3;

function updateProgressBar() {
    const progress = (currentStep / totalSteps) * 100;
    const progressBar = document.getElementById("progress-bar");
    progressBar.style.width = progress + "%";
    progressBar.setAttribute("aria-valuenow", progress);
    progressBar.textContent = Math.round(progress) + "%";
}

function showStep(step) {
    // Ocultar todas las etapas
    document
        .querySelectorAll(".step-content")
        .forEach((content) => content.classList.remove("active"));

    // Mostrar la etapa actual
    document.querySelector(`.etapa-${step}`).classList.add("active");
    updateProgressBar();
}

function nextStep() {
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function finishProcess() {
    alert("¡Proceso completado!");
    // Puedes agregar más lógica aquí, como una redirección o limpiar el formulario.
}

// Inicializar barra de progreso
updateProgressBar();

function limpiarCamposProductos() {
    let precio = document.getElementById("precio");
    let precioNuevo = document.getElementById("precioNuevo");
    let stock = document.getElementById("stock");
    let nivel_stock = document.getElementById("nivel_stock");

    precio.value = "";
    precioNuevo.value = "";
    stock.value = "";
    nivel_stock.value = "";
}
