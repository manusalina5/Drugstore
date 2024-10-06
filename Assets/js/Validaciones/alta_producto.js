// Validación cantidad

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

function validate(event) {
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


    ]

    campos.forEach(campo => {
        esValido = validarCampo(campo) && esValido; // Validar cada campo
    });

    // Si es válido, enviar el formulario
    if (esValido) {
        form.submit(); 
        //console.log('Envia formulario');
    } else {
        console.log('Hay errores')
    }

    return esValido; // Prevenir el envío del formulario si hay errores
}
