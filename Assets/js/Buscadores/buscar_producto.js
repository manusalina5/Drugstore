document.addEventListener("DOMContentLoaded", function() {
    
    cargarTabla();

    document.getElementById('busqueda').addEventListener('input', function(){
        cargarTabla();
    });

    function cargarTabla(pagina = 1){
        var busqueda = document.getElementById('busqueda').value;

        var xhr = new XMLHttpRequest();

        xhr.open('GET', 'Controller/Productos/producto.controlador.php?action=buscar&pagina=' + pagina + '&busqueda=' + busqueda, true);
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText); // Verificar la respuesta
                var respuesta = JSON.parse(xhr.responseText);

                var tabla = document.getElementById('tablaProductos');
                tabla.innerHTML = '';

                respuesta.productos.forEach(function(producto){
                    var row =  "<tr>" +
                        "<td scope='row'>" + producto.idProductos + "</td>" +
                        "<td scope='row'>" + producto.nombre + "</td>" +
                        "<td scope='row'>" + producto.codBarras + "</td>" +
                        "<td scope='row'>" + producto.cantidad + "</td>" +
                        "<td scope='row'>" + producto.cantidadMin + "</td>" +
                        "<td scope='row'>" + producto.precioCosto + "</td>" +
                        "<td scope='row'>" + producto.precioVenta + "</td>" +
                        "<td scope='row'>" + producto.marca + "</td>" +
                        "<td scope='row'>" + producto.rubro + "</td>" +
                        "<td scope='row'>" +
                    "<form action='?page=editar_producto&modulo=productos&id=" + producto.idProductos + "' method='GET' style='display:inline-block;'>"
                        "<input type='hidden' name='page' value='editar_producto'>" +
                        "<input type='hidden' name='modulo' value='productos'>"+
                        "<input type='hidden' name='idProductos' value='" + producto.idProductos + "'>" +
                        "<button type='submit' class='btn btn-warning btn-sm'><i class='fi fi-rr-edit'></i>" +
                        "</button>"+
                    "</form>"+
                    "<form action='Controller/Productos/producto.controlador.php' method='POST' style='display:inline-block;'>" +
                        "<input type='hidden' name='action' value='eliminar'> " +
                        "<input type='hidden' name='idProductos' value='"+ producto.idProductos +"'>" +
                        "<button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar esta producto?\");'>"+
                            "<i class='fi fi-rr-trash'></i>"+
                        "</button>"
                    "</form></td>"+
                    "</tr>";
                tabla.insertAdjacentHTML('beforeend',row);

                });

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