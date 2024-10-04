export function validarCampo(campo) {
    const elemento = document.getElementById(campo.id);
    const valor = elemento.value.trim();
    const alert = document.getElementById("alert");
    let esValido = true; // Controlar el estado de validez aquí

    alert.classList.remove("alerta");
    alert.classList.add("no-alerta");
    alert.innerHTML = '';

    function mostrarAlerta(mensaje) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += mensaje + '<br>';
        esValido = false; // Afectar el estado de esValido
    }

    if (valor === "") {
        mostrarAlerta(`El campo "${campo.nombre}" no puede estar vacío.`);
    } else {
        if (campo.minLen && valor.length < campo.minLen) {
            mostrarAlerta(`El campo "${campo.nombre}" debe tener al menos ${campo.minLen} caracteres.`);
        }
        if (campo.maxLen && valor.length > campo.maxLen) {
            mostrarAlerta(`El campo "${campo.nombre}" no debe exceder los ${campo.maxLen} caracteres.`);
        }
        if (campo.regex && !campo.regex.test(valor)) {
            mostrarAlerta(`El campo "${campo.nombre}" ${campo.errorMsg}`);
        }
        if (valor !== elemento.value) {
            mostrarAlerta(`El campo "${campo.nombre}" no debe comenzar ni terminar con espacios.`);
        }
        if (/["'<>]/.test(valor)) {
            mostrarAlerta(`El campo "${campo.nombre}" contiene caracteres no permitidos.`);
        }
    }

    return esValido; // Retornar el estado de validez
}
