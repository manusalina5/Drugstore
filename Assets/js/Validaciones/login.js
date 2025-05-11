async function validarUsuario() {
    const username = document.getElementById("nombre_usuario");

    if (username.value.trim() === "") {
        console.error("El nombre de usuario está vacío.");
        return false; // Retorna false si el campo está vacío
    }

    try {
        const response = await fetch("Controller/Usuario/login.controlador.php?action=verificarUsuario", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ nombre_usuario: username.value })
        });

        if (!response.ok) {
            console.error("Error en la solicitud al servidor:", response.status);
            return false; // Retorna false si hay un error en la solicitud
        }

        const data = await response.json();

        if (data.success) {
            console.log("Usuario válido.");
            return true; // Usuario válido
        } else {
            console.error("Usuario no válido:", data.message);
            return false; // Usuario no válido
        }
    } catch (error) {
        console.error("Error al verificar el usuario:", error);
        return false; // Retorna false si ocurre un error
    }
}

async function validate() {
    const password = document.getElementById("password");
    const username = document.getElementById("nombre_usuario");
    const form = document.getElementById("form_login");
    const username_parrafo = document.getElementById("username_parrafo");
    const password_parrafo = document.getElementById("password_parrafo");

    let isValid = true;

    // Validación local
    if (username.value.length == 0) {
        username.classList.remove("validation-success");
        username.classList.add("validation-error");
        username_parrafo.style.display = "block";
        isValid = false;
    } else {
        username.classList.remove("validation-error");
        username_parrafo.style.display = "none";
        username.classList.add("validation-success");
    }

    if (password.value.length == 0) {
        password.classList.remove("validation-success");
        password.classList.add("validation-error");
        password_parrafo.style.display = "block";
        isValid = false;
    } else {
        password.classList.remove("validation-error");
        password_parrafo.style.display = "none";
        password.classList.add("validation-success");
    }

    // Validación remota
    if (isValid) {
        const usuarioValido = await validarUsuario();
        if (!usuarioValido) {
            username_parrafo.innerHTML = "El usuario o la contraseña son incorrectos.";
            username.classList.remove("validation-success");
            username.classList.add("validation-error");
            username_parrafo.style.display = "block";
            isValid = false;
        }
    }

    if (isValid) {
        form.submit(); // Envío del formulario solo si todo es válido
    }

    setTimeout(function () {
        username.classList.remove("validation-success");
        password.classList.remove("validation-success");
    }, 2000);

    return false; // Evita el envío por defecto
}