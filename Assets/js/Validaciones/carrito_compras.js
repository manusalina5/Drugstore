// Buscar productos
let carrito = [];

// script de la busqueda y seleccion del producto en buscar_productosventa.js

document.getElementById('btnAgregarProducto').addEventListener('click', function () {
    let nombreProducto = document.getElementById('buscarProducto').value;
    let precioProducto = parseFloat(document.getElementById('precio').value);
    let precioNuevo = parseFloat(document.getElementById('precioNuevo').value);
    let cantidadProducto = parseInt(document.getElementById('cantidad').value);
    let idProducto = parseInt(document.getElementById('idProducto').value);

    // Verifica que se haya seleccionado un producto válido
    if (!nombreProducto || !precioProducto || cantidadProducto <= 0) {
        // Alerta

        Command: toastr["error"]("Por favor, selecciona un producto válido y asegúrate de ingresar la cantidad correcta.", "Producto invalido")

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        //Fin Alerta
        return;
    }

    // Agregar el producto al carrito
    agregarAlCarrito(idProducto, nombreProducto, precioProducto, precioNuevo, cantidadProducto);
});

function agregarAlCarrito(idProducto, nombre, precio, precioNuevo, cantidad) {
    let productoExistente = carrito.find(producto => producto.idProducto === idProducto);

    // Usar el nuevo precio si se ha introducido, o el precio base si no
    let precioUsado = precioNuevo || precio;

    if (productoExistente) {
        productoExistente.cantidad += cantidad;
        productoExistente.precio = precioUsado; // Actualiza el precio al nuevo si se ha ingresado
        productoExistente.subtotal = productoExistente.cantidad * productoExistente.precio;
    } else {
        carrito.push({
            idProducto: idProducto,
            nombre: nombre,
            precio: precio,
            precioNuevo: precioNuevo || precio, // Guarda el nuevo precio si existe
            cantidad: cantidad,
            subtotal: cantidad * precioUsado
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
                <td>$${producto.precioNuevo.toFixed(2)}</td>
                <td>$${producto.subtotal.toFixed(2)}</td>
                <td><button title='Eliminar del carrito' class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${producto.idProducto})">Borrar</button></td>
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
