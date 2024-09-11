document.addEventListener("DOMContentLoaded", function () {
    // Cargar la tabla al iniciar la página
    cargarTabla();

    // Cargar la tabla cuando se hace una búsqueda
    document.getElementById("busqueda").addEventListener("input", function () {
        cargarTabla();
    });

    function cargarTabla(pagina = 1) {
        // Obtener el valor de búsqueda
        const busqueda = document.getElementById("busqueda").value;

        // Hacer la petición con fetch
        fetch(
            `Controller/Personas/Empleado/empleado.controlador.php?action=buscar&pagina=${pagina}&busqueda=${busqueda}`
        )
            .then((response) => {
                // Verificar que la respuesta sea correcta
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.json(); // Convertir la respuesta a JSON
            })
            .then((data) => {
                // Limpiar la tabla actual
                const tabla = document.getElementById("tablaEmpleados");
                tabla.innerHTML = "";

                // Insertar los nuevos empleados
                data.empleados.forEach((empleado) => {
                    const row = `
                        <tr>
                        <td scope='row'>${empleado.idEmpleado}</td>
                        <td scope='row'>${empleado.nombre}</td>
                        <td scope='row'>${empleado.apellido}</td>
                        <td scope='row'>${empleado.legajo}</td>
                        <td scope='row'>${empleado.tipodocumento}</td>
                        <td scope='row'>${empleado.documento}</td>
                        <td scope='row'>${empleado.tipocontacto}</td>
                        <td scope='row'>${empleado.contacto}</td>
                        <td scope='row'>${empleado.fechaAlta}</td>
                        <td scope='row'>
                            <!-- Formulario de edición -->
                            <form action='?page=editar_empleado&modulo=personas&submodulo=empleado&id=${empleado.idEmpleado}' method='GET' style='display:inline-block;'>
                                <input type='hidden' name='page' value='editar_empleado'>
                                <input type='hidden' name='modulo' value='Personas'>
                                <input type='hidden' name='submodulo' value='Empleado'>
                                <input type='hidden' name='idEmpleado' value='${empleado.idEmpleado}'>
                                <input type='hidden' name='idPersona' value='${empleado.idPersona}'>
                                <button type='submit' class='btn btn-warning btn-sm'>
                                    <i class='fi fi-rr-edit'></i>
                                </button>
                            </form>

                            <!-- Formulario de eliminación -->
                            <form action='Controller/Personas/Empleado/empleado.controlador.php' method='POST' style='display:inline-block;'>
                                <input type='hidden' name='action' value='eliminar'>
                                <input type='hidden' name='idEmpleado' value='${empleado.idEmpleado}'>
                                <input type='hidden' name='idPersona' value='${empleado.idPersona}'>
                                <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que deseas eliminar este empleado?");'>
                                    <i class='fi fi-rr-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>


                    `;
                    tabla.insertAdjacentHTML("beforeend", row);
                });

                // Limpiar la paginación actual
                const paginacion = document.getElementById("paginacion");
                paginacion.innerHTML = "";

                // Insertar la nueva paginación
                for (let i = 1; i <= data.total_paginas; i++) {
                    const clase = i == pagina ? "active" : "";
                    const item = `
                        <li class="page-item ${clase}">
                            <a class="page-link" href="#" data-pagina="${i}">${i}</a>
                        </li>`;
                    paginacion.insertAdjacentHTML("beforeend", item);
                }

                // Añadir eventos a los enlaces de paginación
                document.querySelectorAll("#paginacion .page-link").forEach((link) => {
                    link.addEventListener("click", function (e) {
                        e.preventDefault();
                        cargarTabla(this.getAttribute("data-pagina"));
                    });
                });
            })
            .catch((error) => console.error("Error:", error));
    }
});
