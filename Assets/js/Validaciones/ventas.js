// Buscar productos
let carrito = []; 

document.getElementById('buscarProducto').addEventListener('input', function () {
    let query = this.value;

    if (query.length > 2) {
        fetch(`Controller/Productos/producto.controlador.php?action=buscarventa&q=${query}`) // Agregar direccion del controlador
            .then(response => response.json())
            .then(data => {
                mostrarSuregencias(data);
            })
            .catch(error => console.error('Error:', error));
    }else{
        document.getElementById('listaProductos').innerHTML = '';
    }
}
);

function mostrarSuregencias(productos) {
    let lista = document.getElementById('listaProductos');
    lista.innerHTML = '';
    
    productos.forEach(producto =>{
        let item = document.createElement('button');
        item.classList.add('list-group-item', 'list-group-item-action');
        item.textContent = `${producto.nombre} - $${producto.precioVenta}`;
        item.setAttribute(`data-id`, producto.idProductos);
        item.setAttribute('data-precio', producto.precioVenta);

        item.addEventListener('click', function(){
            seleccionarProducto(this);
        });

        lista.appendChild(item);
    });
}

function seleccionarProducto(item) {
    let nombre = item.textContent.split(' - ')[0];  // Obtener el nombre del producto
    let precio = item.getAttribute('data-precio');
    let id = item.getAttribute('data-id');
    
    // Rellenar los campos del formulario con los datos del producto seleccionado
    document.getElementById('buscarProducto').value = nombre;
    document.getElementById('precio').value = precio;
    document.getElementById('idProducto').value = id;

    // Limpiar la lista de sugerencias
    document.getElementById('listaProductos').innerHTML = '';
}

document.getElementById('btnAgregarProducto').addEventListener('click', function() {
    let nombreProducto = document.getElementById('buscarProducto').value;
    let precioProducto = parseFloat(document.getElementById('precio').value);
    let cantidadProducto = parseInt(document.getElementById('cantidad').value);
    let idProducto = parseInt(document.getElementById('idProducto').value);

    // Verifica que se haya seleccionado un producto válido
    if (!nombreProducto || !precioProducto || cantidadProducto <= 0) {
        alert('Por favor, selecciona un producto válido y asegúrate de ingresar la cantidad correcta.');
        return;
    }

    // Agregar el producto al carrito
    agregarAlCarrito(idProducto, nombreProducto, precioProducto, cantidadProducto);
});

function agregarAlCarrito(idProducto, nombre, precio, cantidad) {
    let productoExistente = carrito.find(producto => producto.idProducto === idProducto);

    if (productoExistente) {
        productoExistente.cantidad += cantidad;
        productoExistente.subtotal = productoExistente.cantidad * productoExistente.precio;
    } else {
        carrito.push({
            idProducto: idProducto,
            nombre: nombre,
            precio: precio,
            cantidad: cantidad,
            subtotal: cantidad * precio
        });
    }

    actualizarCarrito();
}

function actualizarCarrito() {
    let tbody = document.getElementById('carrito');
    tbody.innerHTML = '';
    let totalCarrito = 0;

    carrito.forEach(producto => {
        let fila = `
            <tr>
                <td>${producto.nombre}</td>
                <td>${producto.cantidad}</td>
                <td>$${producto.precio.toFixed(2)}</td>
                <td>$${producto.subtotal.toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${producto.idProducto})">Eliminar</button></td>
            </tr>
        `;
        tbody.innerHTML += fila;
        totalCarrito += producto.subtotal;
    });

    document.getElementById('totalCarrito').innerText = `$${totalCarrito.toFixed(2)}`;
}

function eliminarDelCarrito(idProducto) {
    carrito = carrito.filter(producto => producto.idProducto !== idProducto);
    actualizarCarrito();
}
