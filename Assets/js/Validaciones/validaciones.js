function validarCampo(campo) {
    const elemento = document.getElementById(campo.id);
    const valor = elemento.value.trim();
    const alert = document.getElementById("alert");
    let esValido = true;

    function mostrarAlerta(mensaje) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.classList.add("alert");
        alert.innerHTML += mensaje + '<br>';
        elemento.classList.add('input-error');
        esValido = false;
    }

    if (campo.esSelect) {
        if (valor === "" || valor === "Elegir tipo") {
            mostrarAlerta(`Seleccione ${campo.nombre}.`);
        }
    } else {
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
        }
    }

    return esValido;
}