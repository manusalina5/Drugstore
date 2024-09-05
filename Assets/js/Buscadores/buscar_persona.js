document.addEventListener('DOMContentLoaded', function() {
    // Cargar la tabla y la paginación al cargar la página
    cargarTabla();

    // Añadir el evento input al campo de búsqueda
    document.getElementById('busqueda').addEventListener('input', function() {
        cargarTabla();
    });

    function cargarTabla(pagina = 1) {
        var busqueda = document.getElementById('busqueda').value;

        // Crear una solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'Controller/Personas/persona.controlador.php?action=buscar&pagina=' + pagina + '&busqueda=' + busqueda, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Obtener la respuesta JSON
                var respuesta = JSON.parse(xhr.responseText);

                // Actualizar la tabla
                var tabla = document.getElementById('tablaPersonas');
                tabla.innerHTML = '';
                respuesta.personas.forEach(function(persona) {
                    var row = '<tr>' +
                        '<td scope="row">' + persona.idPersona + '</td>' +
                        '<td scope="row">' + persona.nombre + '</td>' +
                        '<td scope="row">' + persona.apellido + '</td>' +
                        '<td scope="row">' +
                            '<form action="?page=editar_persona&modulo=personas&id=' + persona.idPersona + '" method="GET" style="display:inline-block;">' +
                            '<input type="hidden" name="page" value="editar_persona">' +
                            '<input type="hidden" name="modulo" value="Personas">' +
                            '<input type="hidden" name="idPersona" value="' + persona.idPersona + '">' +
                            '<button type="submit" class="btn btn-warning btn-sm"><i class="fi fi-rr-edit"></i></button>' +
                            '</form>' +
                            ' ' +
                            '<form action="Controller/Personas/persona.controlador.php" method="POST" style="display:inline-block;">' +
                            '<input type="hidden" name="action" value="eliminar">' +
                            '<input type="hidden" name="idPersona" value="' + persona.idPersona + '">' +
                            '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Estás seguro de que deseas eliminar esta persona?\');"><i class="fi fi-rr-trash"></i></button>' +
                            '</form>' +
                        '</td>' +
                        '</tr>';
                    tabla.insertAdjacentHTML('beforeend', row);
                });

                // Actualizar la paginación
                var paginacion = document.getElementById('paginacion');
                paginacion.innerHTML = '';
                for (var i = 1; i <= respuesta.total_paginas; i++) {
                    var clase = (i == pagina) ? 'active' : '';
                    var item = '<li class="page-item ' + clase + '">' +
                        '<a class="page-link" href="#" data-pagina="' + i + '">' + i + '</a>' +
                        '</li>';
                    paginacion.insertAdjacentHTML('beforeend', item);
                }

                // Añadir eventos a los enlaces de paginación
                document.querySelectorAll('#paginacion .page-link').forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        cargarTabla(this.getAttribute('data-pagina'));
                    });
                });
            }
        };
        xhr.send();
    }
});