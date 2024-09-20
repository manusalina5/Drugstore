IMask(
    document.getElementById('contacto'),
    {
        mask: [
            {
                mask: '+{549}(370)0000000'
            },
            {
                mask: /^\S*@?\S*$/
            }
        ]
    }
)


function validate(event) {
    event.preventDefault(); // Prevenir el envío por defecto

    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const observaciones = document.getElementById('observaciones');
    const documento = document.getElementById('documento');
    const contacto = document.getElementById('contacto');
    const direccion = document.getElementById('direccion');
    const alert = document.getElementById('alert');
    const form = document.getElementById('form');
    const tipocontacto = document.getElementById('tipocontacto');
    const tipodocumento = document.getElementById('tipodocumento');

    let esValido = true;

    alert.innerHTML = '';


    // Ocultar la alerta por defecto
    alert.classList.add("no-alerta");
    alert.classList.remove("alerta");

    // 1. Validar que el campo no esté vacío
    // nombre
    if (nombre.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Nombre" no puede estar vacío.<br>';
        esValido = false;
    }
    //apellido
    if (apellido.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Apellido" no puede estar vacío.<br>';
        esValido = false;
    }

    //tipo documento
    if (tipodocumento.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'Seleccione un tipo de documento<br>';
        esValido = false;
    }

    //documento
    if (documento.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Documento" no puede estar vacío.<br>';
        esValido = false;
    }

    //tipo contacto
    if (tipocontacto.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'Seleccione un tipo de contacto<br>';
        esValido = false;
    }
    //contacto
    if (contacto.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Contacto" no puede estar vacío.<br>';
        esValido = false;
    }
    //direccion
    if (direccion.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Dirección" no puede estar vacío.<br>';
        esValido = false;
    }

    // 2. Validar longitud mínima (3 caracteres)
    //nombre
    if (nombre.value.length < 3) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Nombre" debe tener al menos 3 caracteres.<br>';
        esValido = false;
    }
    //apellido
    if (apellido.value.length < 3) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Apellido" debe tener al menos 3 caracteres.<br>';
        esValido = false;
    }

    //documento
    if (documento.value.length < 3) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Documento" debe tener al menos 3 caracteres.<br>';
        esValido = false;
    }
    //contacto
    if (contacto.value.length < 3) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Contacto" debe tener al menos 3 caracteres.<br>';
        esValido = false;
    }
    //direccion
    if (direccion.value.length < 3) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Dirección" debe tener al menos 3 caracteres.<br>';
        esValido = false;
    }

    // 3. Validar longitud máxima 
    //nombre
    if (nombre.value.length > 50) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Nombre" no debe exceder los 50 caracteres.<br>';
        esValido = false;
    }
    //apellido
    if (apellido.value.length > 50) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Apellido" no debe exceder los 50 caracteres.<br>';
        esValido = false;
    }
    //Observaciones
    if (observaciones.value.length > 245) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Observaciones" no debe exceder los 245 caracteres.<br>';
        esValido = false;
    }
    //documento
    if (documento.value.length > 30) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Documento" no debe exceder los 30 caracteres.<br>';
        esValido = false;
    }
    //contacto
    if (contacto.value.length > 100) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Contacto" no debe exceder los 100 caracteres.<br>';
        esValido = false;
    }
    //direccion
    if (direccion.value.length > 255) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Dirección" no debe exceder los 255 caracteres.<br>';
        esValido = false;
    }

    // 4. Validar caracteres permitidos (solo letras y espacios)
    //nombre
    if (!/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(nombre.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Nombre" solo debe contener letras y espacios.<br>';
        esValido = false;
    }
    //apellido
    if (!/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(apellido.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Apellido" solo debe contener letras y espacios.<br>';
        esValido = false;
    }
    //observaciones
    if (!/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(observaciones.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Observaciones" solo debe contener letras, números y espacios.<br>';
        esValido = false;
    }
    //documento
    if (!/^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/.test(documento.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Documento" solo debe contener números.<br>';
        esValido = false;
    }
    // //contacto
    // if (!/^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ@\s]+$/.test(contacto.value)) {
    //     alert.classList.remove("no-alerta");
    //     alert.classList.add("alerta");
    //     alert.innerHTML += 'El campo "Contacto" solo debe contener letras y espacios.<br>';
    //     esValido = false;
    // }

    //direccion
    if (!/^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/.test(direccion.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Dirección" solo debe contener letras, números y espacios.<br>';
        esValido = false;
    }

    // 5. Validar que no haya espacios al inicio o al final
    //nombre
    if (nombre.value.trim() !== nombre.value) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Nombre" no debe comenzar ni terminar con espacios.<br>';
        esValido = false;
    }
    //apellido
    if (apellido.value.trim() !== apellido.value) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Apellido" no debe comenzar ni terminar con espacios.<br>';
        esValido = false;
    }

    //documento
    if (documento.value.trim() !== documento.value) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Documento" no debe comenzar ni terminar con espacios.<br>';
        esValido = false;
    }
    //contacto
    if (contacto.value.trim() !== contacto.value) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Contacto" no debe comenzar ni terminar con espacios.<br>';
        esValido = false;
    }
    //direccion
    if (direccion.value.trim() !== direccion.value) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Dirección" no debe comenzar ni terminar con espacios.<br>';
        esValido = false;
    }

    // 6. Validación de seguridad (evitar inyección de código)
    //nombre
    if (/["'<>]/.test(nombre.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "nombre" contiene caracteres no permitidos.<br>';
        esValido = false;
    }
    //apellido
    if (/["'<>]/.test(apellido.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Apellido" contiene caracteres no permitidos.<br>';
        esValido = false;
    }
    //Observaciones
    if (/["'<>]/.test(observaciones.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Observaciones" contiene caracteres no permitidos.<br>';
        esValido = false;
    }
    //documento
    if (/["'<>]/.test(documento.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Documento" contiene caracteres no permitidos.<br>';
        esValido = false;
    }
    //contacto
    if (/["'<>]/.test(contacto.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Contacto" contiene caracteres no permitidos.<br>';
        esValido = false;
    }
    //direccion
    if (/["'<>]/.test(direccion.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Dirección" contiene caracteres no permitidos.<br>';
        esValido = false;
    }

    // Si es válido, enviar el formulario
    if (esValido) {
        form.submit(); // Enviar el formulario si todo es válido
    }

    return false; // Prevenir el envío del formulario si hay errores
}
