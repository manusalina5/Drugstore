document.addEventListener("DOMContentLoaded", cargarProductos());

function cargarProductos(){
    // Cargar la tabla al iniciar la página
    cargarTabla();

    // Cargar la tabla cuando se hace una búsqueda
    document.getElementById('busqueda').addEventListener('input', function(){
        cargarTabla();
    });

    function cargarTabla(pagina = 1) {
        // Obtener el valor de búsqueda
        const busqueda = document.getElementById('busqueda').value;

        // Hacer la petición con fetch
        fetch(`Controller/Productos/producto.controlador.php?action=buscar&pagina=${pagina}&busqueda=${busqueda}`)
            .then(response => {
                // Verificar que la respuesta sea correcta
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json(); // Convertir la respuesta a JSON
            })
            .then(data => {
                // Limpiar la tabla actual
                const tabla = document.getElementById('tablaProductos');
                tabla.innerHTML = '';

                // Insertar los nuevos productos
                data.productos.forEach(producto => {
                    const row = `
                        <tr>
                            <td scope='row'>${producto.nombre}</td>
                            <td scope='row'>${producto.codBarras}</td>
                            <td scope='row'>${producto.cantidad}</td>
                            <td scope='row'>${producto.cantidadMin}</td>
                            <td scope='row'>${producto.utilidad + ' %'}</td>
                            <td scope='row'>${producto.precioCosto}</td>
                            <td scope='row'>${producto.precioVenta}</td>
                            <td scope='row'>${producto.marca}</td>
                            <td scope='row'>${producto.rubro}</td>
                            <td scope='row'>
                                <form action='?page=editar_producto&modulo=productos&id=${producto.idProductos}' method='GET' style='display:inline-block;'>
                                    <input type='hidden' name='page' value='editar_producto'>
                                    <input type='hidden' name='modulo' value='productos'>
                                    <input type='hidden' name='idProductos' value='${producto.idProductos}'>
                                    <button type='submit' class='btn btn-warning btn-sm'>
                                        <i class='fi fi-rr-edit'></i>
                                    </button>
                                </form>
                                <form action='Controller/Productos/producto.controlador.php' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='action' value='eliminar'>
                                    <input type='hidden' name='idProductos' value='${producto.idProductos}'>
                                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que deseas eliminar este producto?");'>
                                        <i class='fi fi-rr-trash'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `;
                    tabla.insertAdjacentHTML('beforeend', row);
                });

                // Limpiar la paginación actual
                const paginacion = document.getElementById('paginacion');
                paginacion.innerHTML = '';

                // Insertar la nueva paginación
                for (let i = 1; i <= data.total_paginas; i++) {
                    const clase = (i == pagina) ? 'active' : '';
                    const item = `
                        <li class="page-item ${clase}">
                            <a class="page-link" href="#" data-pagina="${i}">${i}</a>
                        </li>`;
                    paginacion.insertAdjacentHTML('beforeend', item);
                }

                // Añadir eventos a los enlaces de paginación
                document.querySelectorAll('#paginacion .page-link').forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        cargarTabla(this.getAttribute('data-pagina'));
                    });
                });
            })
            .catch(error => console.error('Error:', error));
    }
}