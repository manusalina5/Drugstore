function actualizarBotonesEliminar() {
    const contactos = document.querySelectorAll('.contacto-item');
    const botonesEliminar = document.querySelectorAll('.remove-contacto');

    botonesEliminar.forEach(button => {
        button.style.display = contactos.length > 1 ? 'inline-block' : 'none';
    });
}

// Evento para inicializar el botón de eliminar en contactos existentes
document.querySelectorAll('.remove-contacto').forEach(button => {
    button.addEventListener('click', function () {
        const contactoItem = this.closest('.contacto-item');
        if (contactoItem) {
            contactoItem.remove(); // Elimina el contenedor principal del contacto
            actualizarBotonesEliminar(); // Actualiza la visibilidad de los botones
        }
    });
});

// Evento para agregar un nuevo contacto
document.getElementById('add-contacto').addEventListener('click', function () {
    const container = document.getElementById('contactos-container');
    const newContacto = document.querySelector('.contacto-item').cloneNode(true);

    // Limpia los campos del nuevo contacto
    newContacto.querySelector('select').value = '';
    newContacto.querySelector('input').value = '';

    // Actualizar los IDs de los mensajes de error para cada nuevo contacto
    const index = container.querySelectorAll('.contacto-item').length; // Obtiene el índice del nuevo contacto
    newContacto.querySelector('.tipocontactoMensaje').id = `tipocontactoMensaje-${index}`;
    newContacto.querySelector('.contactoMensaje').id = `contactoMensaje-${index}`;

    // Limpia los mensajes de error
    newContacto.querySelector('.tipocontactoMensaje').innerHTML = '';
    newContacto.querySelector('.contactoMensaje').innerHTML = '';

    // Agregar el evento de eliminación para el nuevo contacto
    const removeButton = newContacto.querySelector('.remove-contacto');
    removeButton.addEventListener('click', function () {
        const contactoItem = this.closest('.contacto-item');
        if (contactoItem) {
            contactoItem.remove(); // Elimina el contenedor principal del contacto
            actualizarBotonesEliminar(); // Actualiza la visibilidad de los botones
        }
    });

    // Agregar el nuevo contacto al contenedor
    container.appendChild(newContacto);

    // Actualizar la visibilidad de los botones "Eliminar"
    actualizarBotonesEliminar();
});

// Actualizar la visibilidad inicial de los botones "Eliminar"
actualizarBotonesEliminar();
