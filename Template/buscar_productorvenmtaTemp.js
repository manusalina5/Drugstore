document.getElementById('buscarProducto').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 2) {
        fetch(`Controller/Productos/producto.controlador.php?action=buscarventa&q=${query}`) // Agregar direccion del controlador
            .then(response => response.json())
            .then(data => {
                mostrarSuregencias(data);
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('listaProductos').innerHTML = '';
    }
}
);

function mostrarSuregencias(productos) {
    let lista = document.getElementById('listaProductos');
    lista.innerHTML = '';

    productos.forEach(producto => {
        let item = document.createElement('button');
        item.classList.add('list-group-item', 'list-group-item-action');
        item.textContent = `${producto.nombre} - $${producto.precioVenta}`;
        item.setAttribute(`data-id`, producto.idProductos);
        item.setAttribute('data-precio', producto.precioVenta);
        item.setAttribute('data-codBarras', producto.codBarras);
        item.setAttribute('data-nivel_stock', producto.nivel_stock);
        item.setAttribute('data-stock', producto.cantidad);

        item.addEventListener('click', function () {
            seleccionarProducto(this);
        });

        lista.appendChild(item);
    });
}

function nivelStockStatus(nivel_stock, nivelStockElement) {
    switch (nivel_stock) {
        case 'Bajo':
            nivelStockElement.innerHTML = 'Bajo';
            nivelStockElement.style.color = '#6e151c';
            nivelStockElement.style.backgroundColor = '#f1aeb5';
            nivelStockElement.style.borderColor = '#f1aeb5';
            nivelStockElement.title = 'El nivel de stock de este producto es bajo';
            break;
        case 'Medio':
            nivelStockElement.innerHTML = 'Medio';
            nivelStockElement.style.color = '#664d4a';
            nivelStockElement.style.backgroundColor = '#fff3cd';
            nivelStockElement.style.borderColor = '#ffe69c';
            nivelStockElement.title = 'El nivel de stock de este producto es medio';
            break;
        case 'Alto':
            nivelStockElement.innerHTML = 'Alto';
            nivelStockElement.style.color = '#0a3622';
            nivelStockElement.style.backgroundColor = '#d1e7dd';
            nivelStockElement.style.borderColor = '#a3cfbb';
            nivelStockElement.title = 'El nivel de stock de este producto es alto';
            break;
        default:
            break;
    }
}

function seleccionarProducto(item) {
    let nombre = item.textContent.split(' - ')[0];  // Obtener el nombre del producto
    let precio = item.getAttribute('data-precio');
    let id = item.getAttribute('data-id');
    let codBarras = item.getAttribute('data-codBarras');
    let nivel_stock = item.getAttribute('data-nivel_stock');
    let stock = item.getAttribute('data-stock');

    // Rellenar los campos del formulario con los datos del producto seleccionado
    document.getElementById('buscarProducto').value = nombre;
    document.getElementById('idProducto').value = id;
    document.getElementById('nivel_stock').value = nivel_stock; 
    document.getElementById('stock').value = stock;

    // Elemento donde se mostrará el nivel de stock
    const nivelStockElement = document.getElementById('nivel_stock'); 

    nivelStockStatus(nivel_stock, nivelStockElement); //

    // Limpiar la lista de sugerencias
    document.getElementById('listaProductos').innerHTML = '';
}

