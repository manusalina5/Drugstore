IMask(
    document.getElementById('contacto_clientes'),
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

$(document).ready(function () {
    $('#seleccionarCliente').select2({
        placeholder: "Elija el cliente",
        allowClear: true,
        theme: 'classic'
    });
});


$(document).ready(function () {
    $('#tipodocumento').select2({
        placeholder: "Elija tipo de documento",
        allowClear: true
    });
});
$(document).ready(function () {
    $('#tipocontacto').select2({
        placeholder: "Elija tipo de contacto",
        allowClear: true
    });
});

function submitForm() {
    //const formData = new FormData(document.getElementById('form_clientes'));
    const data = {
        action : 'registro_venta',
        nombre : document.getElementById('nombre_clientes').value,
        apellido : document.getElementById('apellido_clientes').value,
        observaciones : document.getElementById('observaciones_clientes').value,
        documento : document.getElementById('documento_clientes').value,
        contacto : document.getElementById('contacto_clientes').value,
        direccion : document.getElementById('direccion_clientes').value,
        tipocontacto : document.getElementById('tipocontacto_clientes').value,
        tipodocumento : document.getElementById('tipodocumento_clientes').value
    }
    // console.log(data)
    $.ajax({
        type:"POST", // la variable type guarda el tipo de la peticion GET,POST,..
        url:"Controller/Personas/Cliente/cliente.controlador.php", //url guarda la ruta hacia donde se hace la peticion
        data:data, // data recive un objeto con la informacion que se enviara al servidor
        success:function(datos){ //success es una funcion que se utiliza si el servidor retorna informacion
             console.log(datos)
            alert(data.message); // Mensaje de éxito

            // // Actualizar campos de venta con datos del cliente
            // const cliente = document.getElementById('seleccionarCliente');
            // const idCliente = document.getElementById('clienteId');
            // cliente.value = data.nombreapellido;
            // idCliente.value = data.clienteId;

            // // Cerrar el modal después del registro
            // const modalElement = document.getElementById('modalClientes');
            // const modalBootstrap = bootstrap.Modal.getInstance(modalElement);
            // modalBootstrap.hide(); // Cerrar el modal
            // console.log('Modal cerrado'); // Verifica si el modal se cierra
         },
        
    })

   
}


function validate() {
    //event.preventDefault(); // Prevenir el envío por defecto

    const nombre = document.getElementById('nombre_clientes');
    const apellido = document.getElementById('apellido_clientes');
    const observaciones = document.getElementById('observaciones_clientes');
    const documento = document.getElementById('documento_clientes');
    const contacto = document.getElementById('contacto_clientes');
    const direccion = document.getElementById('direccion_clientes');
    const alert = document.getElementById('alert_clientes');
    const form = document.getElementById('form_clientes');
    const tipocontacto = document.getElementById('tipocontacto_clientes');
    const tipodocumento = document.getElementById('tipodocumento_clientes');

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

    //documento
    if (!/^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/.test(documento.value)) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += 'El campo "Documento" solo debe contener números.<br>';
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
    //    form.submit(); // Enviar el formulario si todo es válido
        submitForm();
    }
      
    return false; // Prevenir el envío del formulario si hay errores
}


// function enviarFormulario() {
//     fetch("Controller/Personas/Cliente/cliente.controlador.php", {
//         method: "post",
//         headers: {
//             'Accept': 'application/json',
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({
//             success,
//             message,
//             clienteId,
//             nombreapellido

//         })
//     })
//         .then(response => {
//             if (response.ok) { // Check for successful response (200-299 status code)
//                 return response.json(); // Parse the JSON response body
//             } else {
//                 throw new Error(`Request failed with status ${response.status}`);
//             }
//         })
//         .then(data => {
//             console.log(data);
//         })
//         .catch(error => {
//             console.error("Error:", error);
//         });
// }




/*
async function submitForm() {
    const formData = new FormData(document.getElementById('form_clientes'));
    try {
        const response = await fetch('Controller/Personas/Cliente/cliente.controlador.php', {
            method: 'POST',
            body: formData
        });

        if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.status);
        }

        const data = await response.json();
        console.log(data); // Verifica la respuesta del servidor

        if (data.success) {
            alert(data.message); // Mensaje de éxito

            // Actualizar campos de venta con datos del cliente
            const cliente = document.getElementById('seleccionarCliente');
            const idCliente = document.getElementById('clienteId');
            cliente.value = data.nombreapellido;
            idCliente.value = data.clienteId;

            // Cerrar el modal después del registro
            const modalElement = document.getElementById('modalClientes');
            const modalBootstrap = bootstrap.Modal.getInstance(modalElement);
            modalBootstrap.hide(); // Cerrar el modal
            console.log('Modal cerrado'); // Verifica si el modal se cierra

            // Mantener en la misma página y continuar con la venta
        } else {
            alert(data.message); // Mensaje de error
        }
    } catch (error) {
        console.error('Error:', error);
    }
}*/







