document.addEventListener("DOMContentLoaded", function () {

    // Cargar la tabla al iniciar la página
    cargarTabla();

    // Cargar la tabla cuando se hace una búsqueda
    document.getElementById('busqueda').addEventListener('input', function () {
        cargarTabla();
    });

    function cargarTabla(pagina = 1) {
        // Obtener el valor de búsqueda
        const busqueda = document.getElementById('busqueda').value;

        // Hacer la petición con fetch
        fetch(`Controller/Usuario/usuario.controlador.php?action=buscar&pagina=${pagina}&busqueda=${busqueda}`)
            .then(response => {
                // Verificar que la respuesta sea correcta
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json(); // Convertir la respuesta a JSON
            })
            .then(data => {
                // Limpiar la tabla actual
                const tabla = document.getElementById('tablaUsuarios');
                tabla.innerHTML = '';

                // Insertar los nuevos productos
                data.usuarios.forEach(usuario => {
                    const row = `
                        <tr>
                            <td scope='row'>${usuario.username}</td>
                            <td scope='row'>${usuario.nombre}</td>
                            <td scope='row'>${usuario.apellido}</td>
                            <td scope='row'>${usuario.perfil}</td>
                            <td scope='row'>${usuario.fechaAlta}</td>
                            <td scope='row'>
                                <!-- Reestablecer contraseña -->
                                <form action='Controller/Usuario/usuario.controlador.php' method='POST' style='display:inline-block; margin-right: 10px;'>
                                    <input type='hidden' name='action' value='reestrablecerPass'>
                                    <input type='hidden' name='idUsuario' value='${usuario.idUsuario}'>
                                    <button type='submit' class='btn btn-warning btn-sm' onclick='return confirm("¿Estás seguro de que deseas reestablecer la contraseña?");'>
                                        <i class='fi fi-rr-refresh'> Reestablecer Contraseña</i>
                                    </button>
                                </form>
                                
                                <!-- Eliminar usuario -->
                                <form action='Controller/Usuario/usuario.controlador.php' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='action' value='eliminar'>
                                    <input type='hidden' name='idUsuario' value='${usuario.idUsuario}'>
                                    <input type='hidden' name='username' value='${usuario.username}'>
                                    <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que deseas eliminar el usuario?");'>
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
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        cargarTabla(this.getAttribute('data-pagina'));
                    });
                });
            })
            .catch(error => console.error('Error:', error));
    }

});
