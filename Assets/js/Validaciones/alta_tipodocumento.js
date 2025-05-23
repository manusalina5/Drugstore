function validate(event) {
    event.preventDefault(); // Prevenir el envío por defecto

    const valor = document.getElementById('valortipodedocumento');
    const alert = document.getElementById('alert');
    const form = document.getElementById('form');

    let esValido = true;


    // Ocultar la alerta por defecto
    alert.classList.add("no-alerta");
    alert.classList.remove("alerta");

    // 1. Validar que el campo no esté vacío
    if (valor.value.trim() === "") {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo no puede estar vacío.<br>';
        esValido = false;
    }

    // 2. Validar longitud mínima (3 caracteres)
    if (valor.value.length < 3) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El nombre debe tener al menos 3 caracteres.<br>';
        esValido = false;
    }

    // 3. Validar longitud máxima (50 caracteres)
    if (valor.value.length > 50) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El nombre no debe exceder los 50 caracteres.<br>';
        esValido = false;
    }

    // 4. Validar caracteres permitidos (solo letras y espacios)
    if (!/^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/.test(valor.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El nombre solo debe contener letras y espacios.<br>';
        esValido = false;
    }

    // 5. Validar que no haya espacios al inicio o al final
    if (valor.value.trim() !== valor.value) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El nombre no debe comenzar ni terminar con espacios.<br>';
        esValido = false;
    }

    // 6. Validación de seguridad (evitar inyección de código)
    if (/["'<>]/.test(valor.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El nombre contiene caracteres no permitidos.<br>';
        esValido = false;
    }

    // Si es válido, enviar el formulario
    if (esValido) {
        form.submit(); // Enviar el formulario si todo es válido
    }

    return false; // Prevenir el envío del formulario si hay errores
}
