IMask(document.getElementById("cantidad"), {
    mask: Number,
    min: 1,
    max: 10000,
    thousandsSeparator: " ",
});

// Validación cantidad minima
IMask(document.getElementById("cantidadMin"), {
    mask: Number,
    min: 1,
    max: 10000,
    thousandsSeparator: " ",
});

IMask(document.getElementById("codBarras"), {
    mask: Number,
    min: 1000000000000, // Mínimo para un número de 13 dígitos
    max: 9999999999999, // Máximo para un número de 13 dígitos
    thousandsSeparator: "", // Sin separadores
    padFractionalZeros: false, // Sin ceros decimales
});

const formbuttom = document.getElementById("formbutton");
formbuttom.addEventListener("click", validate, false);

import { validarCampo } from './validaciones.js';

async function validate(event) {
    event.preventDefault(); // Prevenir el envío por defecto
    const form = document.getElementById("form");
    let esValido = true;

    const alert = document.getElementById("alert");

    alert.classList.remove("alerta");
    alert.classList.add("no-alerta");
    alert.innerHTML = '';

    const campos = [
        {
            id: 'nombre',
            nombre: 'nombre',
            minLen: 3, maxLen: 50,
            regex: /^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/,
            errorMsg: 'solo debe contener letras y espacios.'
        },
        {
            id: 'precioCosto',
            nombre: 'precio de costo',
            esPrecio: true
        },
        {
            id: 'precioVenta',
            nombre: 'precio de venta',
            esPrecio: true
        },
        {
            id: 'marca',
            nombre: 'marca',
            esSelect: true
        },
        {
            id: 'rubro',
            nombre: 'rubro',
            esSelect: true
        },
        {
            id: 'cantidad',
            nombre: 'cantidad'
        },
        {
            id: 'codBarras',
            nombre: 'Código de barras'
        },
        {
            id: 'cantidadMin',
            nombre: 'cantidad mínima'
        }
    ];

    campos.forEach(campo => {
        esValido = validarCampo(campo) && esValido; // Validar cada campo
    });

    // Verificar código de barras
    const inputCodBarras = document.getElementById('codBarras');
    const codigoEsValido = await existeCodBarras(inputCodBarras);

    if (!codigoEsValido) {
        esValido = false;
    }

    // Si es válido, enviar el formulario
    if (esValido) {
        form.submit();
    } else {
        console.log('Hay errores');
    }

    return esValido; // Prevenir el envío del formulario si hay errores
}

async function existeCodBarras(inputCodBarras) {
    let codBarras = inputCodBarras.value;

    try {
        let response = await fetch(`Controller/Productos/producto.controlador.php?action=buscarcodBarras&codBarras=${codBarras}`);
        let data = await response.json();

        if (data !== false) {
            // Si se encuentra el producto, mostrar una alerta
            mostrarAlerta('error', 'Ya existe un producto con ese código de barras', 'Producto existente');
            return false;  // Código de barras ya existe
        }
        return true; // Código de barras es válido
    } catch (error) {
        console.error('Error:', error);
        return false; // Manejar el error como si el código de barras fuera inválido
    }
}

function mostrarAlerta(status, mensaje, titulomensaje) {
    Command: toastr[status](mensaje, titulomensaje)

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
