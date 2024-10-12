document.addEventListener("DOMContentLoaded", function() {

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
        fetch(`Controller/Ventas/ventas.controlador.php?action=buscar&pagina=${pagina}&busqueda=${busqueda}`)
            .then(response => {
                // Verificar que la respuesta sea correcta
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json(); // Convertir la respuesta a JSON
            })
            .then(data => {
                // Limpiar la tabla actual
                const tabla = document.getElementById('tablaVentas');
                tabla.innerHTML = '';

                // Insertar las nuevas ventas
                data.ventas.forEach(venta => {
                    const row = `
                        <tr>
                            <td scope='row'>${venta.idVenta}</td>
                            <td>${venta.fechaVenta}</td>
                            <td>${venta.horaVenta}</td>
                            <td>${venta.totalVenta}</td>
                            <td>${venta.metodoPago}</td>
                            <td>${venta.Empleado}</td>
                            <td>${venta.Cliente}</td>
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

});
