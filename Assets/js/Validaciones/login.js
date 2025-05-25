async function validarUsuario(nombre_usuario) {
    if (nombre_usuario.trim() === "") {
        console.error("El nombre de usuario está vacío.");
        return false;
    }

    try {
        const response = await fetch("Controller/Usuario/login.controlador.php?action=verificarUsuario", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ nombre_usuario })
        });

        if (!response.ok) {
            console.error("Error en la solicitud:", response.status);
            return false;
        }

        const data = await response.json();
        return data.success;
    } catch (error) {
        console.error("Error al verificar usuario:", error);
        return false;
    }
}

function mostrarError(input, parrafo) {
    input.classList.remove("validation-success");
    input.classList.add("validation-error");
    parrafo.style.display = "block";
}

function ocultarError(input, parrafo) {
    input.classList.remove("validation-error");
    input.classList.add("validation-success");
    parrafo.style.display = "none";
}

async function validate() {
    const form = document.getElementById("form_login");
    const username = document.getElementById("nombre_usuario");
    const password = document.getElementById("password");
    const username_parrafo = document.getElementById("username_parrafo");
    const password_parrafo = document.getElementById("password_parrafo");

    let isValid = true;

    // Validación local
    if (!username.value.trim()) {
        mostrarError(username, username_parrafo);
        isValid = false;
    } else {
        ocultarError(username, username_parrafo);
    }

    if (!password.value.trim()) {
        mostrarError(password, password_parrafo);
        isValid = false;
    } else {
        ocultarError(password, password_parrafo);
    }

    // Validación remota
    if (isValid) {
        const usuarioValido = await validarUsuario(username.value);
        if (!usuarioValido) {
            username_parrafo.innerText = "El usuario o la contraseña son incorrectos.";
            mostrarError(username, username_parrafo);
            isValid = false;
        }
    }

    if (isValid) form.submit();

    // Limpiar estilos después de 2 segundos
    setTimeout(() => {
        username.classList.remove("validation-success");
        password.classList.remove("validation-success");
    }, 2000);

    return false; // Evita el envío por defecto
}
