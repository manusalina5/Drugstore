window.carrito = Array.isArray(window.carrito) ? window.carrito : [];

document.getElementById('buscarProducto').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 2) {
        fetch(`Controller/Productos/producto.controlador.php?action=buscarventa&q=${query}`)
            .then(response => response.json())
            .then(data => {
                mostrarSugerencias(data);
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('listaProductos').innerHTML = '';
    }
});

function mostrarSugerencias(productos) {
    let lista = document.getElementById('listaProductos');
    lista.innerHTML = '';

    productos.forEach(producto => {
        let item = document.createElement('button');
        item.classList.add('list-group-item', 'list-group-item-action');
        item.textContent = `${producto.nombre} - $${producto.precioVenta}`;
        item.setAttribute('data-id', producto.idProductos);
        item.setAttribute('data-precio', producto.precioVenta);
        item.setAttribute('data-nombre', producto.nombre);
        item.setAttribute('data-stock', producto.cantidad);

        item.addEventListener('click', function () {
            agregarProductoDesdeBusqueda(this);
        });

        lista.appendChild(item);
    });
}

function agregarProductoDesdeBusqueda(item) {
    const id = parseInt(item.getAttribute('data-id'));
    const nombre = item.getAttribute('data-nombre');
    const precio = parseFloat(item.getAttribute('data-precio'));
    const stock = parseInt(item.getAttribute('data-stock'));

    agregarAlCarrito(id, nombre, precio, 1, stock); // cantidad 1 por defecto

    document.getElementById('buscarProducto').value = '';
    document.getElementById('listaProductos').innerHTML = '';
}

// ENTER agrega si hay 1 solo resultado
document.getElementById('buscarProducto').addEventListener('keydown', function (e) {
    if (e.key === 'Enter') {
        let lista = document.querySelectorAll('#listaProductos .list-group-item');
        if (lista.length === 1) {
            lista[0].click();
            e.preventDefault();
        }
    }
});

document.getElementById('formAgregarProducto').addEventListener('submit', function(e) {
    e.preventDefault();
});
