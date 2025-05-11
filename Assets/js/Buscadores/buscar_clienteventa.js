// Obtener referencias a los elementos DOM
const buscarClienteInput = document.getElementById('buscarCliente');
const listaClientesDiv = document.getElementById('listaClientes');
const clienteIdInput = document.getElementById('clienteId');
const cardClienteDiv = document.getElementById('cardCliente');
const listCardNombreLi = document.getElementById('listCardNombre');
const listCardApellidoLi = document.getElementById('listCardApellido');
const listCardTipoDocumentoLi = document.getElementById('listCardTipoDocumento');
const listCardDocumentoLi = document.getElementById('listCardDocumento');
const clienteAlertContainer = document.getElementById('clienteAlertContainer'); // Nuevo contenedor de alertas
const limpiarSeleccionBtn = document.getElementById('limpiarSeleccionBtn'); // Botón de limpiar selección

let searchTimeout; // Variable para el debounce

// Event listener para el input de búsqueda
buscarClienteInput.addEventListener('input', function () {
    let query = this.value.trim(); // Usar trim() para eliminar espacios en blanco

    // Limpiar timeout anterior si existe
    clearTimeout(searchTimeout);

    // Si la consulta es corta, limpiar la lista de sugerencias y ocultar el card si no hay cliente seleccionado
    if (query.length < 3) {
        listaClientesDiv.innerHTML = ''; // CORREGIDO: limpia listaClientes
        // Si no hay un cliente ya seleccionado en el card, ocultarlo.
        // Podríamos usar una variable de estado o chequear si clienteIdInput.value está vacío
        if (clienteIdInput.value === '') {
            cardClienteDiv.style.display = 'none';
        }
        // Limpiar alertas
        clienteAlertContainer.innerHTML = '';
        return; // Salir de la función si la consulta es muy corta
    }

    // Configurar un nuevo timeout para la búsqueda (debounce)
    searchTimeout = setTimeout(() => {
        // Opcional: Mostrar un indicador de carga
        listaClientesDiv.innerHTML = '<div class="list-group-item text-center text-muted">Buscando...</div>';

        // Realizar la llamada fetch
        fetch(`Controller/Personas/Cliente/cliente.controlador.php?action=buscarventa&q=${encodeURIComponent(query)}`) // Usar encodeURIComponent
            .then(response => {
                // Verificar si la respuesta es exitosa (código 2xx)
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json(); // Parsear la respuesta como JSON
            })
            .then(data => {
                listaClientesDiv.innerHTML = ''; // Limpiar el "Buscando..." o sugerencias anteriores
                clienteAlertContainer.innerHTML = ''; // Limpiar alertas anteriores

                // Verificar si los datos son un arreglo y no está vacío
                if (Array.isArray(data) && data.length > 0) {
                    mostrarSugerenciasCliente(data);
                } else {
                    // Mostrar mensaje de "no resultados" en la lista de sugerencias
                    listaClientesDiv.innerHTML = '<div class="list-group-item text-muted">No se encontraron resultados.</div>';
                    // Podrías opcionalmente mostrar una alerta también:
                    // showAlert('No se encuentra ningun cliente con esos parametros.', 'warning');
                }
            })
            .catch(error => {
                console.error('Error al buscar cliente:', error);
                listaClientesDiv.innerHTML = ''; // Limpiar la lista
                // Mostrar una alerta de error más amigable
                showAlert('Ocurrió un error al buscar clientes. Inténtelo de nuevo.', 'danger');
            });
    }, 300); // Esperar 300ms después de que el usuario deja de escribir
});

// Función para mostrar las sugerencias de clientes
function mostrarSugerenciasCliente(clientes) {
    listaClientesDiv.innerHTML = ''; // Asegurarse de que esté vacío antes de añadir nuevos elementos

    clientes.forEach(cliente => {
        const item = document.createElement('a');
        item.classList.add('list-group-item', 'list-group-item-action');
        // Usar textContent para seguridad y `${}` para concatenar
        item.textContent = `${cliente.nombre} ${cliente.apellido} - ${cliente.documento}`;
        item.dataset.id = cliente.idClientes; // Guardar el ID en el dataset

        // Al hacer clic en un cliente
        item.addEventListener('click', () => {
            // Llenar el card con los datos del cliente
            seleccionarCliente(cliente);

            // Limpiar la búsqueda y sugerencias después de seleccionar
            buscarClienteInput.value = '';
            listaClientesDiv.innerHTML = '';
        });

        listaClientesDiv.appendChild(item);
    });
}

// Función para llenar el card del cliente seleccionado
function seleccionarCliente(cliente) {
    // Asegurarse de que el card esté visible
    cardClienteDiv.style.display = 'block';

    // Llenar los campos del card
    listCardNombreLi.innerHTML = `<b>Nombre:</b> ${cliente.nombre || 'N/A'}`; // Usar || 'N/A' para datos faltantes
    listCardApellidoLi.innerHTML = `<b>Apellido:</b> ${cliente.apellido || 'N/A'}`;
    listCardDocumentoLi.innerHTML = `<b>Nro. documento:</b> ${cliente.documento || 'N/A'}`;
    listCardTipoDocumentoLi.innerHTML = `<b>Tipo Documento:</b> ${cliente.tipodocumento || 'N/A'}`; // Ajusta si el nombre de la propiedad es diferente

    // Guardar el ID del cliente seleccionado en el input oculto
    clienteIdInput.value = cliente.idClientes;

    // Limpiar cualquier alerta previa relacionada con la búsqueda/selección
    clienteAlertContainer.innerHTML = '';

    // Opcional: Enfocarse en el siguiente paso o habilitar botones relevantes
    // Por ejemplo, podrías querer deshabilitar la búsqueda y habilitar un botón "Continuar" aquí.
}

// Función para mostrar alertas
function showAlert(message, type = 'info') {
    // Limpiar alertas previas en este contenedor
    clienteAlertContainer.innerHTML = '';

    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`; // clases de Bootstrap
    alertDiv.role = 'alert';
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    // Añadir la alerta al contenedor específico
    clienteAlertContainer.appendChild(alertDiv);
}

// Event listener para el botón "Limpiar Selección"
limpiarSeleccionBtn.addEventListener('click', () => {
    limpiarSeleccionCliente();
});

// Función para limpiar la selección del cliente
function limpiarSeleccionCliente() {
    clienteIdInput.value = ''; // Limpiar el ID oculto
    // Limpiar el contenido del card
    listCardNombreLi.textContent = '';
    listCardApellidoLi.textContent = '';
    listCardTipoDocumentoLi.textContent = '';
    listCardDocumentoLi.textContent = '';

    // Ocultar el card
    cardClienteDiv.style.display = 'none';

    // Opcional: Limpiar el input de búsqueda y enfocarlo
    buscarClienteInput.value = '';
    listaClientesDiv.innerHTML = ''; // Asegurarse de que no queden sugerencias
    buscarClienteInput.focus(); // Poner el foco en el campo de búsqueda
}


// Opcional: Ocultar sugerencias si se hace clic fuera del input o la lista
document.addEventListener('click', function (event) {
    const isClickInside = buscarClienteInput.contains(event.target) || listaClientesDiv.contains(event.target);
    if (!isClickInside) {
        // Retrasar un poco para permitir el click en la sugerencia antes de ocultar
        setTimeout(() => {
            if (clienteIdInput.value === '') { // Solo ocultar si no hay cliente seleccionado
                listaClientesDiv.innerHTML = '';
            }
        }, 100);
    }
});

const btnVentaRapida = document.getElementById('btnVentaRapida');
btnVentaRapida.addEventListener('click', () => {
    // Realizar una solicitud para obtener los datos del cliente con ID = 1
    fetch('Controller/Personas/Cliente/cliente.controlador.php?action=buscarventa&q=1')
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data && data.length > 0) {
                // Seleccionar automáticamente el cliente con ID = 1
                const cliente = data.find(c => c.idClientes === '1');
                if (cliente) {
                    seleccionarCliente(cliente);
                } else {
                    showAlert('No se encontró el cliente con ID = 1.', 'warning');
                }
            } else {
                showAlert('No se encontró el cliente con ID = 1.', 'warning');
            }
        })
        .catch(error => {
            console.error('Error al seleccionar cliente default:', error);
            showAlert('Ocurrió un error al seleccionar el cliente default.', 'danger');
        });
});