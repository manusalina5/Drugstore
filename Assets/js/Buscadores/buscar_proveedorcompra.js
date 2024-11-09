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
        document.getElementById('listaProveedores').innerHTML = '';
        document.getElementById('botonAgregarProveedor').style.display = 'none'; // Ocultar el botón cuando no hay consulta
    }
});

document.getElementById('buscarProveedor').addEventListener('change',function(){
    document.getElementById('proveedorId').value = '';
});

function mostrarSugerenciasProveedor(proveedores) {
    let lista = document.getElementById('listaProveedores');
    let botonAgregarProveedor = document.getElementById('botonAgregarProveedor');
    lista.innerHTML = '';

    if (proveedores.length === 0) {
        // Si no hay proveedores, mostramos el botón "Agregar Proveedor"
        botonAgregarProveedor.style.display = 'block';
    } else {
        // Si hay proveedores, ocultamos el botón "Agregar Proveedor"
        botonAgregarProveedor.style.display = 'none';

        proveedores.forEach(proveedor => {
            let item = document.createElement('a');
            item.classList.add('list-group-item', 'list-group-item-action');
            item.textContent = `${proveedor.razonSocial}`;
            item.setAttribute(`data-id`, proveedor.idProveedor);
            item.dataset.nombre = proveedor.razonSocial;

            // Al hacer clic en un proveedor, se llena el formulario con sus datos
            item.addEventListener('click', function () {
                document.getElementById('buscarProveedor').value = this.dataset.nombre;
                document.getElementById('proveedorId').value = this.dataset.id;
                lista.innerHTML = ''; // Limpiar sugerencias
            });

            lista.appendChild(item);
        });
    }
}
