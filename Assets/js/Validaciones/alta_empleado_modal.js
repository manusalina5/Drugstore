document.addEventListener("DOMContentLoaded", function () {
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const tipodocumento = document.getElementById("tipodocumento");
    const documento = document.getElementById("documento");
    const tipocontacto = document.getElementById("tipocontacto");
    const contacto = document.getElementById("contacto");
    const direccion = document.getElementById("direccion");
    const legajo = document.getElementById("legajo");
    
    const errorNombre = document.getElementById("errorNombre");
    const errorApellido = document.getElementById("errorApellido");
    const errorTipoDocumento = document.getElementById("errorTipoDocumento");
    const errorDocumento = document.getElementById("errorDocumento");
    const errorTipoContacto = document.getElementById("errorTipoContacto");
    const errorContacto = document.getElementById("errorContacto");
    const errorDireccion = document.getElementById("errorDireccion");
    const errorLegajo = document.getElementById("errorLegajo");
    
    const formulario = document.getElementById("formModal");
    const btnRegistrar = document.getElementById("btnGuardar");

    formulario.addEventListener("submit", function (event) {
        event.preventDefault();
        let valido = true;

        if (!validarVacio(nombre, errorNombre) || !validarNombre(nombre, errorNombre)) valido = false;
        if (!validarVacio(apellido, errorApellido) || !validarNombre(apellido, errorApellido)) valido = false;
        if (!validarVacio(tipodocumento, errorTipoDocumento)) valido = false;
        if (!validarVacio(documento, errorDocumento) || !validarDocumento(documento, errorDocumento)) valido = false;
        if (!validarVacio(tipocontacto, errorTipoContacto)) valido = false;
        if (!validarVacio(contacto, errorContacto) || !validarContacto(contacto, tipocontacto, errorContacto)) valido = false;
        if (!validarVacio(direccion, errorDireccion) || !validarDireccion(direccion, errorDireccion)) valido = false;
        if (!validarVacio(legajo, errorLegajo) || !validarLegajo(legajo, errorLegajo)) valido = false;

        if (valido) {
            formulario.submit();
        }
    });

    function validarVacio(campo, errorCampo) {
        if (campo.value.trim() === "") {
            errorCampo.innerHTML = "Este campo es obligatorio";
            return false;
        } else {
            errorCampo.innerHTML = "";
            return true;
        }
    }

    function validarNombre(campo, errorCampo) {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s'-]{2,}$/;
        if (!regex.test(campo.value.trim())) {
            errorCampo.innerHTML = "Solo letras, mínimo 2 caracteres";
            return false;
        }
        return true;
    }

    function validarDocumento(campo, errorCampo) {
        const regex = /^\d{7,10}$/;
        if (!regex.test(campo.value.trim())) {
            errorCampo.innerHTML = "Debe ser numérico (7-10 dígitos)";
            return false;
        }
        return true;
    }

    function validarContacto(campo, tipoCampo, errorCampo) {
        const valor = campo.value.trim();
        if (tipoCampo.value === "email") {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regex.test(valor)) {
                errorCampo.innerHTML = "Ingrese un email válido";
                return false;
            }
        } else if (tipoCampo.value === "telefono") {
            const regex = /^\d{8,15}$/;
            if (!regex.test(valor)) {
                errorCampo.innerHTML = "Ingrese un teléfono válido (8-15 dígitos)";
                return false;
            }
        }
        return true;
    }

    function validarDireccion(campo, errorCampo) {
        if (campo.value.trim().length < 5) {
            errorCampo.innerHTML = "La dirección debe tener al menos 5 caracteres";
            return false;
        }
        return true;
    }

    function validarLegajo(campo, errorCampo) {
        const regex = /^\d{1,10}$/;
        if (!regex.test(campo.value.trim())) {
            errorCampo.innerHTML = "El legajo debe ser numérico";
            return false;
        }
        return true;
    }
});
