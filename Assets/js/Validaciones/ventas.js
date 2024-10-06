// Buscar productos
let carrito = []; 

// script de la busqueda y seleccion del producto en buscar_productosventa.js

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
