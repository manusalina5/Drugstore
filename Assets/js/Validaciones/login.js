function validate() {
    const password = document.getElementById("password");
    const username = document.getElementById("nombre_usuario");
    const form = document.getElementById("form_login");
    const username_parrafo = document.getElementById("username_parrafo");
    const password_parrafo = document.getElementById("password_parrafo");

    let isValid = true; // Variable para controlar la validez general

    if (username.value.length == 0) {
        username.classList.remove("validation-success");
        username.classList.add("validation-error");
        username_parrafo.style.display = "block";
        isValid = false; // Se marca como inválido
    } else {
        username.classList.remove("validation-error");
        username_parrafo.style.display = "none";
        username.classList.add("validation-success");
    }

    if (password.value.length == 0) {
        password.classList.remove("validation-success");
        password.classList.add("validation-error");
        password_parrafo.style.display = "block";
        isValid = false; // Se marca como inválido
    } else {
        password.classList.remove("validation-error");
        password_parrafo.style.display = "none";
        password.classList.add("validation-success");
    }

    if (isValid) {
        // Envío del formulario solo si es válido
        form.submit();
    }

    // Opcional: Ocultar mensajes de éxito después de un tiempo
    setTimeout(function () {
        username.classList.remove("validation-success");
        password.classList.remove("validation-success");
    }, 2000); // 2 segundos para que el mensaje se vea

    return false; // Se mantiene el return false para evitar el envío por defecto del navegador
}
