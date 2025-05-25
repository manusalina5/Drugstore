IMask(
    document.getElementById('contacto'),
    {
        mask: [
            { mask: '+{549}(370)0000000' },
            { mask: /^\S*@?\S*$/ }
        ]
    }
);

function mostrarError(alert, mensaje) {
    alert.classList.remove("no-alerta");
    alert.classList.add("alerta");
    alert.innerHTML += mensaje + '<br>';
}

function validarCampo(alert, campo, nombre, opciones = {}) {
    const valor = campo.value;
    if (valor.trim() === "") {
        mostrarError(alert, `El campo "${nombre}" no puede estar vacío.`);
        return false;
    }
    if (opciones.min && valor.length < opciones.min) {
        mostrarError(alert, `El campo "${nombre}" debe tener al menos ${opciones.min} caracteres.`);
        return false;
    }
    if (opciones.max && valor.length > opciones.max) {
        mostrarError(alert, `El campo "${nombre}" no debe exceder los ${opciones.max} caracteres.`);
        return false;
    }
    if (opciones.regex && !opciones.regex.test(valor)) {
        mostrarError(alert, `El campo "${nombre}" contiene caracteres no permitidos.`);
        return false;
    }
    if (valor.trim() !== valor) {
        mostrarError(alert, `El campo "${nombre}" no debe comenzar ni terminar con espacios.`);
        return false;
    }
    if (/["'<>]/.test(valor)) {
        mostrarError(alert, `El campo "${nombre}" contiene caracteres no permitidos.`);
        return false;
    }
    return true;
}

function validate(event) {
    event.preventDefault();

    const campos = [
        { id: 'nombre', nombre: 'Nombre', min: 3, max: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/ },
        { id: 'apellido', nombre: 'Apellido', min: 3, max: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/ },
        { id: 'legajo', nombre: 'Legajo', min: 4, max: 20, regex: /^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/ },
        { id: 'documento', nombre: 'Documento', min: 3, max: 30, regex: /^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/ },
        { id: 'contacto', nombre: 'Contacto', min: 3, max: 100 },
        { id: 'direccion', nombre: 'Dirección', min: 3, max: 255, regex: /^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/ }
    ];

    const alert = document.getElementById('alert');
    const form = document.getElementById('form');
    const tipocontacto = document.getElementById('tipocontacto');
    const tipodocumento = document.getElementById('tipodocumento');

    alert.innerHTML = '';
    alert.classList.add("no-alerta");
    alert.classList.remove("alerta");

    let esValido = true;

    // Validar selects
    if (tipodocumento.value.trim() === "") {
        mostrarError(alert, 'Seleccione un tipo de documento');
        esValido = false;
    }
    if (tipocontacto.value.trim() === "") {
        mostrarError(alert, 'Seleccione un tipo de contacto');
        esValido = false;
    }

    // Validar campos de texto
    campos.forEach(campo => {
        const input = document.getElementById(campo.id);
        if (!validarCampo(alert, input, campo.nombre, campo)) {
            esValido = false;
        }
    });

    if (esValido) form.submit();
    return false;
}
