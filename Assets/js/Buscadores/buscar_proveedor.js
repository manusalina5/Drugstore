document.addEventListener("DOMContentLoaded",function(){

    cargarTabla();

    document.getElementById("busqueda").addEventListener("input",function(){
        cargarTabla(); 
    });


function cargarTabla(pagina = 1) {
    const busqueda = document.getElementById('busqueda').value;

    fetch(`Controller/Personas/Proveedor/proveedor.controlador.php?action=buscar&pagina=${pagina}&busqueda=${busqueda}`)
    .then((response) => {
        if (!response.ok) {
            throw new Error('Error en la respuesta del servidor');
        }
        return response.json();
    })
        .then((data) => {
            const tabla = document.getElementById('tablaProveedores');
            tabla.innerHTML = "";

            data.proveedores.forEach((proveedor) => {
                const row = `
        <tr>
                <td scope='row'>${proveedor.idProveedor}</td>
                <td scope='row'>${proveedor.nombre}</td>
                <td scope='row'>${proveedor.apellido}</td>
                <td scope='row'>${proveedor.razonSocial}</td>
                <td scope='row'>${proveedor.tipodocumento}</td>
                <td scope='row'>${proveedor.documento}</td>
                <td scope='row'>${proveedor.tipocontacto}</td>
                <td scope='row'>${proveedor.contacto}</td>
                <td scope='row'>${proveedor.fechaAlta}</td>
                <td scope='row'>
                    <form action="?page=editar_proveedor&modulo=personas&submodulo=proveedor&id=${proveedor.idProveedor}" method="GET" style="display:inline-block;">
                        <input type="hidden" name="page" value="editar_proveedor">
                        <input type="hidden" name="modulo" value="Personas">
                        <input type="hidden" name="submodulo" value="proveedor">
                        <input type="hidden" name="idProveedor" value="${proveedor.idProveedor}">
                        <input type="hidden" name="idPersona" value="${proveedor.idPersona}">
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="fi fi-rr-edit"></i>
                        </button>
                    </form>
                    <form action="Controller/Personas/Proveedor/proveedor.controlador.php" method="POST" style="display:inline-block;">
                        <input type="hidden" name="action" value="eliminar">
                        <input type="hidden" name="idProveedor" value="${proveedor.idProveedor}">
                        <input type="hidden" name="idPersona" value="${proveedor.idPersona}">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');">
                            <i class="fi fi-rr-trash"></i>
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