// const nivel_stock = document.getElementById('nivel_stock');
// const stocklabel = document.getElementById('stocklabel');

// stocklabel.addEventListener('click',cambiarcolor,false);

// function cambiarcolor(){
//     nivel_stock.innerHTML = 'Bajo';
//     nivel_stock.style.color = '#6e151cff';
//     nivel_stock.style.backgroundColor = '#f1aeb5';
//     nivel_stock.style.borderColor = '#f1aeb5';
// }


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
    const data = {
        action: 'registro_venta',
        nombre: document.getElementById('nombre_clientes').value,
        apellido: document.getElementById('apellido_clientes').value,
        observaciones: document.getElementById('observaciones_clientes').value,
        documento: document.getElementById('documento_clientes').value,
        contacto: document.getElementById('contacto_clientes').value,
        direccion: document.getElementById('direccion_clientes').value,
        idtipoContacto: document.getElementById('tipocontacto_clientes').value,
        idtipoDocumentos: document.getElementById('tipodocumento_clientes').value
    }

    $.ajax({
        type: "POST", // la variable type guarda el tipo de la peticion GET,POST,..
        url: "Controller/Personas/Cliente/cliente.controlador.php", //url guarda la ruta hacia donde se hace la peticion
        data: data, // data recive un objeto con la informacion que se enviara al servidor
        success: function (datos) { //success es una funcion que se utiliza si el servidor retorna informacion
            try {
                datos = JSON.parse(datos); // Asegúrate de que los datos sean un objeto JSON
            } catch (e) {
                console.error("Error parsing JSON:", e);
            }
            if (!datos.success) {
                alert(datos.message);
            } else {
                //Mensaje de éxito
                alert(datos.message);

            }

            // Actualizar campos de venta con datos del cliente
            const cliente = document.getElementById('buscarCliente');
            const idCliente = document.getElementById('clienteId');
            cliente.value = datos.nombreapellido;
            idCliente.value = datos.clienteId;

            // Cerrar el modal después del registro

            document.getElementById("cerrarModal").click();

        },

    })


}


function validate() {
    const campos = [
        { id: 'nombre_clientes', nombre: 'Nombre', minLen: 3, maxLen: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/, errorMsg: 'solo debe contener letras y espacios.' },
        { id: 'apellido_clientes', nombre: 'Apellido', minLen: 3, maxLen: 50, regex: /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+$/, errorMsg: 'solo debe contener letras y espacios.' },
        { id: 'documento_clientes', nombre: 'Documento', minLen: 3, maxLen: 30, regex: /^[A-Za-z0-9ÁÉÍÓÚáéíóúñÑ\s]+$/, errorMsg: 'solo debe contener números y letras.' },
        { id: 'contacto_clientes', nombre: 'Contacto', minLen: 3, maxLen: 100 },
        { id: 'direccion_clientes', nombre: 'Dirección', minLen: 3, maxLen: 255 },
        { id: 'observaciones_clientes', nombre: 'Observaciones', maxLen: 245 }
    ];

    const selectCampos = [
        { id: 'tipodocumento_clientes', nombre: 'Tipo de documento' },
        { id: 'tipocontacto_clientes', nombre: 'Tipo de contacto' }
    ];

    const alert = document.getElementById('alert_clientes');
    let esValido = true;
    alert.innerHTML = '';

    // Ocultar alerta por defecto
    alert.classList.add("no-alerta");
    alert.classList.remove("alerta");

    // Función para mostrar el mensaje de error
    function mostrarError(mensaje) {
        alert.classList.remove("no-alerta");
        alert.classList.add("alerta");
        alert.innerHTML += `${mensaje}<br>`;
        esValido = false;
    }

    // Función para validar campos de texto
    function validarCampo(campo) {
        const elemento = document.getElementById(campo.id);
        const valor = elemento.value.trim();

        if (valor === "") {
            mostrarError(`El campo "${campo.nombre}" no puede estar vacío.`);
            return;
        }
        if (campo.minLen && valor.length < campo.minLen) {
            mostrarError(`El campo "${campo.nombre}" debe tener al menos ${campo.minLen} caracteres.`);
        }
        if (campo.maxLen && valor.length > campo.maxLen) {
            mostrarError(`El campo "${campo.nombre}" no debe exceder los ${campo.maxLen} caracteres.`);
        }
        if (campo.regex && !campo.regex.test(valor)) {
            mostrarError(`El campo "${campo.nombre}" ${campo.errorMsg}`);
        }
        if (valor !== elemento.value) {
            mostrarError(`El campo "${campo.nombre}" no debe comenzar ni terminar con espacios.`);
        }
        if (/["'<>]/.test(valor)) {
            mostrarError(`El campo "${campo.nombre}" contiene caracteres no permitidos.`);
        }
    }

    // Validar campos de texto
    campos.forEach(validarCampo);

    // Validar selects
    selectCampos.forEach(campo => {
        const valor = document.getElementById(campo.id).value.trim();
        if (valor === "") {
            mostrarError(`Seleccione un ${campo.nombre}.`);
        }
    });

    if (esValido) {
        submitForm();
    }

    return false; // Prevenir el envío del formulario si hay errores
}







