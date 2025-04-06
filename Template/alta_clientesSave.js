document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const progressBar = document.getElementById('progress-bar');
    let currentStep = 0;

    function updateSteps() {
        steps.forEach((step, index) => {
            step.style.display = index === currentStep ? 'block' : 'none';
        });

        // Actualizar barra de progreso
        const progress = ((currentStep + 1) / steps.length) * 100;
        progressBar.style.width = progress + '%';
        progressBar.innerText = `Paso ${currentStep + 1} de ${steps.length}`;
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', function () {
            if (currentStep < steps.length - 1) {
                currentStep++;
                updateSteps();
            }
        });
    });

    document.querySelectorAll('.prev-step').forEach(button => {
        button.addEventListener('click', function () {
            if (currentStep > 0) {
                currentStep--;
                updateSteps();
            }
        });
    });

    updateSteps();
});

function mostrarAlerta(alerta, mensaje) {
    alerta.classList.remove("no-alerta");
    alerta.classList.add("alerta");
    alerta.innerHTML += mensaje + '<br>';
}

function validarCampoVacio(valor, campo, alerta) {
    if (valor.trim() === "") {
        mostrarAlerta(alerta, `El campo "${campo}" no puede estar vacío.`);
        return false;
    }
    return true;
}

function validarLongitud(valor, campo, min, max, alerta) {
    if (valor.length < min) {
        mostrarAlerta(alerta, `El campo "${campo}" debe tener al menos ${min} caracteres.`);
        return false;
    }
    if (valor.length > max) {
        mostrarAlerta(alerta, `El campo "${campo}" no debe exceder los ${max} caracteres.`);
        return false;
    }
    return true;
}

function validarSoloLetras(valor, campo, alerta) {
    if (!/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(valor)) {
        mostrarAlerta(alerta, `El campo "${campo}" solo debe contener letras y espacios.`);
        return false;
    }
    return true;
}

function validarSinCaracteresProhibidos(valor, campo, alerta) {
    if (/["'<>]/.test(valor)) {
        mostrarAlerta(alerta, `El campo "${campo}" contiene caracteres no permitidos.`);
        return false;
    }
    return true;
}

function validardatosPersonales(){
    let campos = [
        { id: 'nombre', nombre: 'Nombre', min: 3, max: 50, soloLetras: true },
        { id: 'apellido', nombre: 'Apellido', min: 3, max: 50, soloLetras: true }
    ]

    let esValido = true;

    campos.forEach(campo => {
        const valor = document.getElementById(campo.id).value;

        if (!validarCampoVacio(valor, campo.nombre, alerta)) esValido = false;
        if (!validarLongitud(valor, campo.nombre, campo.min, campo.max, alerta)) esValido = false;
        if (campo.soloLetras && !validarSoloLetras(valor, campo.nombre, alerta)) esValido = false;
        if (!validarSinCaracteresProhibidos(valor, campo.nombre, alerta)) esValido = false;
    });
}


function validate(event) {
    event.preventDefault();

    const alerta = document.getElementById('alert');
    alerta.innerHTML = '';
    alerta.classList.add("no-alerta");
    alerta.classList.remove("alerta");

    const campos = [
        { id: 'nombre', nombre: 'Nombre', min: 3, max: 50, soloLetras: true },
        { id: 'apellido', nombre: 'Apellido', min: 3, max: 50, soloLetras: true },
        { id: 'documento', nombre: 'Documento', min: 3, max: 30 },
        { id: 'contacto', nombre: 'Contacto', min: 3, max: 100 },
        { id: 'direccion', nombre: 'Dirección', min: 3, max: 255 }
    ];

    let esValido = true;

    campos.forEach(campo => {
        const valor = document.getElementById(campo.id).value;

        if (!validarCampoVacio(valor, campo.nombre, alerta)) esValido = false;
        if (!validarLongitud(valor, campo.nombre, campo.min, campo.max, alerta)) esValido = false;
        if (campo.soloLetras && !validarSoloLetras(valor, campo.nombre, alerta)) esValido = false;
        if (!validarSinCaracteresProhibidos(valor, campo.nombre, alerta)) esValido = false;
    });

    // Validar campos adicionales como selectores
    const tipodocumento = document.getElementById('tipodocumento').value;
    const tipocontacto = document.getElementById('tipocontacto').value;

    if (tipodocumento.trim() === "") {
        mostrarAlerta(alerta, 'Seleccione un tipo de documento');
        esValido = false;
    }

    if (tipocontacto.trim() === "") {
        mostrarAlerta(alerta, 'Seleccione un tipo de contacto');
        esValido = false;
    }

    if (esValido) {
        // Si todo es válido, puedes enviar el formulario
        console.log('Formulario válido');
        // form.submit(); // Descomentar si usas un formulario real
    }
}
