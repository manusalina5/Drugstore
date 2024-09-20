document.addEventListener("DOMContentLoaded", function () {
    cargarTabla();

    document.getElementById("busqueda").addEventListener("input", function () {
        cargarTabla();
    });

    function cargarTabla(pagina = 1) {
        const busqueda = document.getElementById("busqueda").value;

        fetch(
            `Controller/Personas/Documento/tipodocumento.controlador.php?action=buscar&pagina=${pagina}&busqueda=${busqueda}`
        )
            .then((response) => response.json())
            .then((data) => {
                const tabla = document.getElementById("tablaTipoDocumentos");
                tabla.innerHTML = "";

                data.tipoDocumentos.forEach((tipodocumento) => {
                    const row = `
                    <tr>
                <td scope='row'>${tipodocumento.idtipoDocumentos}</td>
                <td scope='row'>${tipodocumento.valor}</td>
                <td scope='row'>
                    <!-- Formulario para editar tipo de documento -->
                    <form action='?page=editar_tipodocumento&modulo=personas&submodulo=documento&id=${tipodocumento.idtipoDocumentos}' method='GET' style='display:inline-block;'>
                        <input type='hidden' name='page' value='editar_tipodocumento'>
                        <input type='hidden' name='modulo' value='Personas'>
                        <input type='hidden' name='submodulo' value='Documento'>
                        <input type='hidden' name='id' value='${tipodocumento.idtipoDocumentos}'>
                        <button type='submit' class='btn btn-warning btn-sm'>
                            <i class='fi fi-rr-edit'></i>
                        </button>
                    </form>

                    <!-- Formulario para eliminar tipo de documento -->
                    <form action='Controller/Personas/Documento/tipodocumento.controlador.php' method='POST' style='display:inline-block;'>
                        <input type='hidden' name='action' value='eliminar'>
                        <input type='hidden' name='idtipodocumento' value='${tipodocumento.idtipoDocumentos}'>
                        <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm("¿Estás seguro de que deseas eliminar este tipo de documento?");'>
                            <i class='fi fi-rr-trash'></i>
                        </button>
                    </form>
                </td>
            </tr>
                    `;
                    tabla.insertAdjacentHTML("beforeend", row);
                });

                const paginacion = document.getElementById("paginacion");
                paginacion.innerHTML = "";
                for (let i = 1; i <= data.total_paginas; i++) {
                    const clase = i == pagina ? "active" : "";
                    const item = `<li class="page-item ${clase}">
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
