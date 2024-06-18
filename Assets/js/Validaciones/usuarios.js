function validate_username(event) {
    const username_parrafo = document.getElementById('username_parrafo');
    const username_parrafoVacio = document.getElementById('username_parrafoVacio');
    const username_valido = document.getElementById('username_valido');
    const username = event.target.value;

    if (username.length === 0) {
        username_parrafoVacio.style.display = 'block';
        username_valido.style.display = 'none';
        username_parrafo.style.display = 'none';
        return;
    } else {
        username_parrafoVacio.style.display = 'none';
    }

    $.ajax({
        url: "Controller/Usuario/usuario.ajax.controlador.php",
        type: "post",
        data: {
            'nombre_usuario': username,
            'action': 'ajax'
        },
        success: function (response) {
            let data = JSON.parse(response);
            if (data.data == 'error') {
                username_parrafo.style.display = 'block';
                username_valido.style.display = 'none';
                document.getElementById('nombre_usuario').value = '';
            } else {
                username_parrafo.style.display = 'none';
                username_valido.style.display = 'block';
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        },
    });
}

function validate(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    const password = document.getElementById('password');
    const username = document.getElementById('nombre_usuario');
    const form = document.getElementById('form_registro');
    const username_parrafoVacio = document.getElementById('username_parrafoVacio');
    const password_parrafo = document.getElementById('password_parrafo');

    let valid = true;

    if (username.value.length == 0) {
        username.classList.add('validation-error');
        username_parrafoVacio.style.display = 'block';
        valid = false;
    } else {
        username.classList.remove('validation-error');
        username_parrafoVacio.style.display = 'none';
        username.classList.add('validation-success');
    }

    if (password.value.length == 0) {
        password.classList.add('validation-error');
        password_parrafo.style.display = 'block';
        valid = false;
    } else {
        password.classList.remove('validation-error');
        password_parrafo.style.display = 'none';
        password.classList.add('validation-success');
    }

    if (valid) {
        // Usar setTimeout para retrasar el envío del formulario
        setTimeout(function() {
            form.submit();
        }, 1000); // 1000 milisegundos equivalen a 1 segundo
    }
}
