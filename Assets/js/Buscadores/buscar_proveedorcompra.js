document.getElementById('buscarProveedor').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 2) {
        fetch(`Controller/Personas/Proveedor/proveedor.controlador.php?action=buscarcompra&q=${query}`) 
            .then(response => response.json())
            .then(data => {
                mostrarSugerenciasProveedor(data);
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('listaProductos').innerHTML = '';
    }
}
);

function mostrarSugerenciasProveedor(proveedores) {
    let lista = document.getElementById('listaProveedores');
    lista.innerHTML = '';

    proveedores.forEach(proveedor => {
        let item = document.createElement('a');
        item.classList.add('list-group-item', 'list-group-item-action');
        item.textContent = `${proveedor.razonSocial}`;
        item.setAttribute(`data-id`,proveedor.idProveedor);
        item.setAttribute(`data-id`,proveedor.idProveedor);
        item.dataset.nombre = proveedor.razonSocial;

        // Al hacer clic en un proveedor, se llena el formulario con sus datos
        item.addEventListener('click', function () {
            document.getElementById('buscarProveedor').value = this.dataset.nombre;
            document.getElementById('proveedorId').value = this.dataset.id;
            listaProveedores.innerHTML = ''; // Limpiar sugerencias
        });

        lista.appendChild(item);
    });

}
