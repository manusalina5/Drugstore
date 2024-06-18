
function validate(){
    const password = document.getElementById('password');
    const username = document.getElementById('nombre_usuario');
    const form = document.getElementById('form_login');
    const username_parrafo = document.getElementById('username_parrafo');
    const password_parrafo = document.getElementById('password_parrafo');
    
    if(username.value.length == 0){
        username.classList.add('validation-error');
        username_parrafo.style.display = 'block';
        return false; // Asegúrate de retornar false para evitar el envío del formulario
    }else{
        username.classList.remove('validation-error'); // Remover la clase de error si la validación es exitosa
        username_parrafo.style.display = 'none';
        username.classList.add('validation-success');
    }
    if(password.value.length == 0){
        password.classList.add('validation-error');
        password_parrafo.style.display = 'block';
        return false; // Asegúrate de retornar false para evitar el envío del formulario
    }else{
        password.classList.remove('validation-error');
        username_parrafo.style.display = 'none'; // Remover la clase de error si la validación es exitosa
        password.classList.add('validation-success');
    }
    
    // Usar setTimeout para retrasar el envío del formulario
    setTimeout(function() {
        form.submit();
    }, 1000); // 1000 milisegundos equivalen a 1 segundo

    return false; // Asegúrate de retornar false para evitar el envío inmediato del formulario
}

// function validate_username(){
//     alert('Hola mundo');
// }