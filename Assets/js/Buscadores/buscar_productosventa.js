document.getElementById('buscarProducto').addEventListener('keyup', function () {
    let query = this.value;

    if (query.length > 1) { // Solo buscar si el texto es mayor a 1 caracter
        fetch('Controller/Productos/producto.controlador.php?action=buscarventa&query=' + query)
            .then(response => response.json())
            .then(data => {
                let listaProductos = document.getElementById('listaProductos');
                listaProductos.innerHTML = ''; // Limpiar la lista de sugerencias

                data.forEach(producto => {
                    let item = document.createElement('a');
                    item.href = "#";
                    item.classList.add('list-group-item', 'list-group-item-action');
                    item.textContent = producto.nombre + ' - ' + producto.codBarras;
                    item.dataset.id = producto.idProductos;
                    item.dataset.precio = producto.precioVenta;
                    item.dataset.nombre = producto.nombre;

                    // Al hacer clic en un producto, se llena el formulario con sus datos
                    item.addEventListener('click', function () {
                        document.getElementById('buscarProducto').value = this.dataset.nombre;
                        document.getElementById('precio').value = this.dataset.precio;
                        listaProductos.innerHTML = ''; // Limpiar sugerencias
                    });

                    listaProductos.appendChild(item);
                });
            });
    }
});
