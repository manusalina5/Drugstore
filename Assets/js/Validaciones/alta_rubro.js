const formbuttom = document.getElementById('submitform');
formbuttom.addEventListener("click", validate, false);

import { validarCampo } from './validaciones.js';

function validate(event){
    event.preventDefault(); // Prevenir el envío del formulario
    const form = document.getElementById("form");
    let esValido = true;

    const campos = [{
        id: 'nombrerubro', nombre: 'Nombre de rubros', minLen: 3, maxLen: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/, errorMsg: 'solo debe contener letras y espacios.'
    }]

    campos.forEach(campo => {
        esValido = validarCampo(campo) && esValido; // Validar cada campo
    });

    if(esValido){
        form.submit();
    }else{
        console.log('Error en validaciones');
    }

    return esValido;

}
