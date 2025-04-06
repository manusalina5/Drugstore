document.addEventListener('DOMContentLoaded', function () {
    const steps = document.querySelectorAll('.step');
    const progressBar = document.getElementById('progress-bar');
    let currentStep = 0;

    function updateSteps() {
        steps.forEach((step, index) => {
            step.style.display = index === currentStep ? 'block' : 'none';
        });

        const progress = ((currentStep + 1) / steps.length) * 100;
        progressBar.style.width = progress + '%';
        progressBar.innerText = `Paso ${currentStep + 1} de ${steps.length}`;
    }

    document.querySelectorAll('.next-step').forEach(button => {
        button.addEventListener('click', async function () {
            const esValido = await validarPasos(currentStep); // Espera el resultado de la validación
            if (esValido) {
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    updateSteps();
                }
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

async function validarPasos(currentStep) {
    switch (currentStep) {
        case 0:
            return validarPaso1();
        case 1:
            return await validarPaso2(); // Llamada asíncrona
        case 2:
            return validarPaso3();
        case 3:
            return validarPaso4();
        case 4:
            return validarPaso5();
        default:
            return true;
    }
}



function validarPaso1() {
    let esValido = true;
    let nombre = document.getElementById('nombre').value;
    let apellido = document.getElementById('apellido').value;

    // Validar longitud
    if (!validarLogitud(nombre, 'nombre', 50, 3)) {
        esValido = false;
    }
    if (!validarLogitud(apellido, 'apellido', 50, 3)) {
        esValido = false;
    }

    // Validar campo vacio
    if (!validarCampoVacio(nombre, 'nombre')) {
        esValido = false;
    }
    if (!validarCampoVacio(apellido, 'apellido')) {
        esValido = false;
    }

    // Validar solo letras
    if (!validarSoloLetras(nombre, 'nombre')) {
        esValido = false;
    }
    if (!validarSoloLetras(apellido, 'apellido')) {
        esValido = false;
    }
    return esValido;
}

async function validarPaso2() {
    let esValido = true;
    let documento = document.getElementById('documento').value;
    let tipodocumento = document.getElementById('tipodocumento').value;

    // Validar tipo de documento seleccionado primero
    if (tipodocumento === '') {
        document.getElementById('tipoDocumentoMensaje').innerHTML = 'Debe seleccionar un tipo de documento.';
        esValido = false;
    } else {
        document.getElementById('tipoDocumentoMensaje').innerHTML = '';
    }

    // Validar longitud
    if (!validarLogitud(documento, 'documento', 20, 8)) {
        esValido = false;
    }

    // Validar campo vacío
    if (!validarCampoVacio(documento, 'documento')) {
        esValido = false;
    }

    // Solo validar existencia si los demás campos son válidos
    if (esValido) {
        const documentoValido = await validarExistenDocumento();
        if (!documentoValido) {
            document.getElementById('documentoMensaje').innerHTML = 'El documento ya existe en el sistema.';
            esValido = false;
        }
    }

    return esValido;
}


function validarPaso3() {
    let valido = true;

    // Obtener todos los contactos dinámicos
    const contactos = document.querySelectorAll('.contacto-item');
    let indice = 0;
    // Iterar sobre cada uno de los contactos
    contactos.forEach((contacto) => {
        const selectContacto = contacto.querySelector('.selectTipocontacto');  // Asegúrate de que tenga la clase correcta
        const inputContacto = contacto.querySelector('input');
        const mensajeTipoContacto = contacto.querySelector('.tipocontactoMensaje');
        const mensajeContacto = contacto.querySelector('.contactoMensaje');
        // Validar si el select está vacío
        if (selectContacto && selectContacto.value === '') {
            mensajeTipoContacto.innerHTML = 'Debe seleccionar un tipo de contacto.';
            valido = false;
        } else {
            mensajeTipoContacto.innerHTML = ''; // Limpiar el mensaje de error
        }

        // Validar si el input está vacío
        if (inputContacto && inputContacto.value.trim() === '') {
            mensajeContacto.innerHTML = 'Debe ingresar un valor de contacto.';
            valido = false;
        } else {
            mensajeContacto.innerHTML = ''; // Limpiar el mensaje de error
        }
        indice++;
    });

    return valido;
}



function validarPaso4() {
    let esValido = true;
    let direccion = document.getElementById('direccion').value;

    // Validar longitud
    if (!validarLogitud(direccion, 'direccion', 255, 10)) {
        esValido = false;
    }

    // Validar campo vacío
    if (!validarCampoVacio(direccion, 'direccion')) {
        esValido = false;
    }

    return esValido;
}

function validarPaso5() {
    let esValido = true;
    let observaciones = document.getElementById('observaciones').value;

    // Validar longitud
    if (!validarLogitud(observaciones, 'observaciones', 255, 0)) {
        esValido = false;
    }

    // Validar campo vacío
    if (!validarCampoVacio(observaciones, 'observaciones')) {
        esValido = false;
    }

    return esValido;
}


function validarLogitud(valor, campo, max, min) {
    if (valor.length < min || valor.length > max) {
        document.getElementById(campo + 'Mensaje').innerHTML = `El campo debe tener entre ${min} y ${max} caracteres.`;
        return false;
    }
    document.getElementById(campo + 'Mensaje').innerHTML = '';
    return true;
}


function validarCampoVacio(valor, campo) {
    let idCampoMensaje = campo + 'Mensaje';
    if (valor.trim() === "") {
        document.getElementById(`${idCampoMensaje}`).innerHTML = `El campo "${campo}" no puede estar vacio`;
        return false;
    } else {
        document.getElementById(`${idCampoMensaje}`).innerHTML = '';
    }
    return true;
}

function validarSoloLetras(valor, campo) {
    let idCampoMensaje = campo + 'Mensaje';
    if (!/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(valor)) {
        document.getElementById(`${idCampoMensaje}`).innerHTML = `El campo "${campo}" solo debe contener letras y espacios.`;
        return false;
    }
    return true;
}

async function validarExistenDocumento() {
    let tipodocumento = document.getElementById('tipodocumento').value;
    let documento = document.getElementById('documento').value;
    const mensajeElement = document.getElementById('documentoMensaje');
    
    if (!tipodocumento || !documento) {
        return false;
    }

    try {
        const response = await fetch('Controller/Personas/Cliente/cliente.controlador.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'action': 'validarDocumento',
                'tipodocumento': tipodocumento,
                'valor': documento
            })
        });

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        
        // Siempre actualizar el mensaje, independientemente del resultado
        if (mensajeElement) {
            mensajeElement.innerHTML = data.message || '';
        }

        return data.success;
    } catch (error) {
        console.error('Error al validar documento:', error);
        if (mensajeElement) {
            mensajeElement.innerHTML = 'Error al validar el documento';
        }
        return false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const documentoInput = document.getElementById('documento');
    const tipoDocumentoSelect = document.getElementById('tipodocumento');
    
    async function validarDocumentoEnTiempoReal() {
        if (documentoInput.value.length >= 8 && tipoDocumentoSelect.value !== '') {
            await validarExistenDocumento();
        }
    }
    
    documentoInput.addEventListener('blur', validarDocumentoEnTiempoReal);
    documentoInput.addEventListener('input', function() {
        // Limpiar mensaje cuando el usuario está escribiendo
        const mensajeElement = document.getElementById('documentoMensaje');
        if (mensajeElement) {
            mensajeElement.innerHTML = '';
        }
    });
});
