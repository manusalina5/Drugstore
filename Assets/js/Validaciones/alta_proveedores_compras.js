// Máscaras y Select2 para campos de proveedor
IMask(
    document.getElementById('contacto_proveedores'),
    {
        mask: [
            {
                mask: '+{549}(370)0000000' // Máscara para número de teléfono
            },
            {
                mask: /^\S*@?\S*$/ // Máscara para email
            }
        ]
    }
);


// Función para enviar el formulario de proveedor
function submitFormProveedor() {
    const data = {
        action: 'registro_proveedor',
        razonSocial: document.getElementById('razonSocial_proveedores').value,
        nombre: document.getElementById('nombre_proveedores').value,
        apellido: document.getElementById('apellido_proveedores').value,
        contacto: document.getElementById('contacto_proveedores').value,
        documento: document.getElementById('documento_proveedores').value,
        direccion: document.getElementById('direccion_proveedores').value,
        idtipoContacto: document.getElementById('tipocontacto_proveedores').value,
        idtipoDocumentos: document.getElementById('tipodocumento_proveedores').value
    };

    $.ajax({
        type: "POST",
        url: "Controller/Personas/Proveedor/proveedor.controlador.php",
        data: data,
        success: function (datos) {
            try {
                datos = JSON.parse(datos);
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
            if (!datos.success) {
                alert(datos.message);
            } else {
                alert(datos.message);
                document.getElementById("cerrarModalProveedor").click(); // Cambiado para cerrar correctamente el modal
            }
        }
    });
}

// Validación del formulario de proveedor
function validateProveedor() {
    const campos = [
        { id: 'razonSocial_proveedores', nombre: 'Razón Social', minLen: 3, maxLen: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/, errorMsg: 'solo debe contener letras y espacios.' },
        { id: 'nombre_proveedores', nombre: 'Nombre', minLen: 3, maxLen: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/, errorMsg: 'solo debe contener letras y espacios.' },
        { id: 'apellido_proveedores', nombre: 'Apellido', minLen: 3, maxLen: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/, errorMsg: 'solo debe contener letras y espacios.' },
        { id: 'contacto_proveedores', nombre: 'Contacto', minLen: 3, maxLen: 100 },
        { id: 'direccion_proveedores', nombre: 'Dirección', minLen: 3, maxLen: 255 }
    ];

    const selectCampos = [
        { id: 'tipodocumento_proveedores', nombre: 'Tipo de documento' },
        { id: 'tipocontacto_proveedores', nombre: 'Tipo de contacto' }
    ];

    const alert = document.getElementById('alert_proveedores');
    let esValido = true;
    alert.innerHTML = '';

    // Ocultar alerta por defecto
    alert.classList.add("no-alerta");
    alert.classList.remove("alerta");

    // Función para mostrar el mensaje de error
    function mostrarError(mensaje) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += `${mensaje}<br>`;
        esValido = false;
    }

    // Función para validar campos de texto
    function validarCampo(campo) {
        const elemento = document.getElementById(campo.id);
        const valor = elemento.value.trim();

        if (valor === "") {
            mostrarError(`El campo "${campo.nombre}" no puede estar vacío.`);
            return;
        }
        if (campo.minLen && valor.length < campo.minLen) {
            mostrarError(`El campo "${campo.nombre}" debe tener al menos ${campo.minLen} caracteres.`);
        }
        if (campo.maxLen && valor.length > campo.maxLen) {
            mostrarError(`El campo "${campo.nombre}" no debe exceder los ${campo.maxLen} caracteres.`);
        }
        if (campo.regex && !campo.regex.test(valor)) {
            mostrarError(`El campo "${campo.nombre}" ${campo.errorMsg}`);
        }
        if (valor !== elemento.value) {
            mostrarError(`El campo "${campo.nombre}" no debe comenzar ni terminar con espacios.`);
        }
        if (/["'<>]/.test(valor)) {
            mostrarError(`El campo "${campo.nombre}" contiene caracteres no permitidos.`);
        }
    }

    // Validar campos de texto
    campos.forEach(validarCampo);

    // Validar selects
    selectCampos.forEach(campo => {
        const valor = document.getElementById(campo.id).value.trim();
        if (valor === "") {
            mostrarError(`Seleccione un ${campo.nombre}.`);
        }
    });

    if (esValido) {
        submitFormProveedor();
    }

    return false; 
}
