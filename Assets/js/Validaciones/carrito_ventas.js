window.carrito = window.carrito || [];

function agregarAlCarrito(idProducto, nombre, precio, cantidad = 1, stock = 0) {
    // Validar cantidad
    cantidad = parseInt(cantidad);
    stock = parseInt(stock);
    if (isNaN(cantidad) || cantidad < 1) {
        alert('La cantidad debe ser al menos 1.');
        return;
    }
    if (isNaN(stock) || stock < 1) {
        stock = 99999; // Si no hay stock definido, permitir agregar sin límite
    }

    let productoExistente = window.carrito.find(p => p.idProducto === idProducto);

    if (productoExistente) {
        // Si el precio cambió, actualizarlo
        if (productoExistente.precio !== precio) {
            productoExistente.precio = precio;
        }
        // Sumar cantidad pero no superar el stock
        if (productoExistente.cantidad + cantidad <= stock) {
            productoExistente.cantidad += cantidad;
        } else {
            productoExistente.cantidad = stock;
            alert('No hay suficiente stock para agregar más de este producto.');
        }
        productoExistente.subtotal = productoExistente.cantidad * productoExistente.precio;
    } else {
        if (cantidad > stock) {
            alert('No hay suficiente stock para agregar esa cantidad.');
            cantidad = stock;
        }
        window.carrito.push({
            idProducto,
            nombre,
            precio,
            cantidad,
            stock,
            subtotal: cantidad * precio
        });
    }

    actualizarCarrito();

    // Volver a enfocar el campo de búsqueda
    if (document.getElementById('buscarProducto')) {
        document.getElementById('buscarProducto').value = '';
        document.getElementById('buscarProducto').focus();
    }
}

function actualizarCarrito() {
    let tbody = document.getElementById('carrito');
    if (!tbody) return; // Evitar errores si no existe la tabla
    tbody.innerHTML = '';
    let total = 0;

    window.carrito.forEach(p => {
        total += p.subtotal;

        tbody.innerHTML += `
            <tr>
                <td>${p.nombre}</td>
                <td>
                    <input type="number" class="form-control form-control-sm cantidad-carrito" 
                           data-id="${p.idProducto}" min="1" max="${p.stock}" value="${p.cantidad}">
                </td>
                <td>$${p.precio.toFixed(2)}</td>
                <td>$${p.subtotal.toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="eliminarDelCarrito(${p.idProducto})">🗑️</button>
                </td>
            </tr>
        `;
    });

    document.getElementById('totalCarrito').innerText = `$${total.toFixed(2)}`;

    // Disparar evento personalizado para actualizar el resumen del paso 3
    document.dispatchEvent(new CustomEvent('carritoActualizado', { detail: { total, carrito: window.carrito } }));

    document.querySelectorAll('.cantidad-carrito').forEach(input => {
        input.addEventListener('change', function () {
            let id = parseInt(this.dataset.id);
            let nuevaCantidad = parseInt(this.value);
            let prod = window.carrito.find(p => p.idProducto === id);

            if (prod && nuevaCantidad > 0 && nuevaCantidad <= prod.stock) {
                prod.cantidad = nuevaCantidad;
                prod.subtotal = prod.cantidad * prod.precio;
                actualizarCarrito();
            } else {
                this.value = prod.cantidad;
            }
        });
    });
}

function eliminarDelCarrito(idProducto) {
    window.carrito = window.carrito.filter(p => p.idProducto !== idProducto);
    actualizarCarrito();
}

// Permitir obtener el carrito desde otros scripts
function obtenerCarrito() {
    return window.carrito;
}
window.obtenerCarrito = obtenerCarrito;

// Permitir actualizar el carrito desde otros scripts
window.actualizarCarrito = actualizarCarrito;
