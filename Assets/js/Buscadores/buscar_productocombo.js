// cargarProductos.js

document.addEventListener("DOMContentLoaded", function () {
    const formStep1 = document.getElementById("form-step1");
    const step2Content = document.getElementById("step2-content");
    const nextStepBtn = document.getElementById("next-step");
    const progressBar = document.getElementById("progress-bar");
    const selectedProductsContainer = document.getElementById("selected-products-container");
    let selectedProducts = [];

    // Cambiar a paso 2 y mostrar su contenido
    nextStepBtn.addEventListener("click", function () {
        formStep1.style.display = "none";
        step2Content.style.display = "block";
        progressBar.style.width = "100%";
        progressBar.innerText = "Paso 2 de 2";
        cargarListaProductos();
    });

    // Eventos para el buscador y ordenamiento
    document.getElementById('busqueda').addEventListener('input', () => cargarListaProductos());
    document.getElementById('ordenarPor').addEventListener('change', () => cargarListaProductos());
    document.getElementById('tipoOrden').addEventListener('change', () => cargarListaProductos());

    // Función para cargar la lista de productos
    function cargarListaProductos(pagina = 1) {
        const busqueda = document.getElementById('busqueda').value;
        const ordenarPor = document.getElementById('ordenarPor').value;
        const tipoOrden = document.getElementById('tipoOrden').value;

        fetch(`Controller/Productos/producto.controlador.php?action=buscar&pagina=${pagina}&busqueda=${encodeURIComponent(busqueda)}&ordenarPor=${ordenarPor}&tipoOrden=${tipoOrden}`)
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById("product-list-container");
                container.innerHTML = data.productos.map(producto => `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <input type="checkbox" onchange="seleccionarProducto(${producto.idProductos}, '${producto.nombre}', ${producto.precioVenta})">
                            <span>${producto.nombre} - $${producto.precioVenta}</span>
                        </div>
                    </li>
                `).join('');

                // Crear la paginación
                const paginacion = document.getElementById('paginacion');
                paginacion.innerHTML = '';
                for (let i = 1; i <= data.total_paginas; i++) {
                    const clase = (i == pagina) ? 'active' : '';
                    const item = `
                        <li class="page-item ${clase}">
                            <a class="page-link" href="#" data-pagina="${i}">${i}</a>
                        </li>`;
                    paginacion.insertAdjacentHTML('beforeend', item);
                }

                // Evento de click en la paginación
                document.querySelectorAll('#paginacion .page-link').forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        cargarListaProductos(this.getAttribute('data-pagina'));
                    });
                });
            })
            .catch(error => console.error('Error cargando productos:', error));
    }

    // Función para seleccionar productos y añadir cantidad
    window.seleccionarProducto = function (id, nombre, precio) {
        const productoIndex = selectedProducts.findIndex(p => p.id === id);
        if (productoIndex === -1) {
            selectedProducts.push({ id, nombre, precio, cantidad: 1 }); // Cantidad inicial de 1
        } else {
            selectedProducts.splice(productoIndex, 1);
        }
        mostrarProductosSeleccionados();
    };

    // Mostrar productos seleccionados en el panel derecho
    function mostrarProductosSeleccionados() {
        selectedProductsContainer.innerHTML = selectedProducts.map(producto => `
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>${producto.nombre} - $${producto.precio}</span>
                <div class="d-flex align-items-center">
                    <input type="number" min="1" value="${producto.cantidad}" 
                        class="form-control form-control-sm me-2" 
                        style="width: 70px;" 
                        onchange="actualizarCantidad(${producto.id}, this.value)">
                    <button type="button" onclick="eliminarProducto(${producto.id})" class="btn btn-danger btn-sm">Eliminar</button>
                </div>
            </li>
        `).join('');
    }

    // Función para actualizar la cantidad de un producto
    window.actualizarCantidad = function (id, nuevaCantidad) {
        const productoIndex = selectedProducts.findIndex(p => p.id === id);
        if (productoIndex !== -1 && nuevaCantidad > 0) {
            selectedProducts[productoIndex].cantidad = parseInt(nuevaCantidad);
        }
    };

    // Función para eliminar un producto del panel de seleccionados
    window.eliminarProducto = function (id) {
        selectedProducts = selectedProducts.filter(producto => producto.id !== id);
        mostrarProductosSeleccionados();
    };

    // Exportar la lista de productos seleccionados
    window.getSelectedProducts = function() {
        return selectedProducts;
    };
});
