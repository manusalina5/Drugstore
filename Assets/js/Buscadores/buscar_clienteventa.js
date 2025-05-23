document.getElementById('buscarCliente').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 2) {
        fetch(`Controller/Personas/Cliente/cliente.controlador.php?action=buscarventa&q=${query}`) // Agregar direccion del controlador
            .then(response => response.json())
            .then(data => {
                mostrarSuregenciasCliente(data);
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('listaProductos').innerHTML = '';
    }
}
);

function mostrarSuregenciasCliente(clientes) {
    let lista = document.getElementById('listaClientes');
    lista.innerHTML = '';

    clientes.forEach(cliente => {
        let item = document.createElement('a');
        item.classList.add('list-group-item', 'list-group-item-action');
        item.textContent = `${cliente.nombre} ${cliente.apellido} - ${cliente.documento}`;
        item.setAttribute(`data-id`,cliente.idClientes);
        item.setAttribute(`data-id`,cliente.idClientes);
        item.dataset.nombre = cliente.nombre + ' ' + cliente.apellido;

        // Al hacer clic en un cliente, se llena el formulario con sus datos
        item.addEventListener('click', function () {
            document.getElementById('buscarCliente').value = this.dataset.nombre;
            document.getElementById('clienteId').value = this.dataset.id;
            listaClientes.innerHTML = ''; // Limpiar sugerencias
        });

        lista.appendChild(item);
    });

}
