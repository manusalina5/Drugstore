document.addEventListener("DOMContentLoaded",function(){

    cargarTabla();

    document.getElementById("busqueda").addEventListener("input",function(){
        cargarTabla(); 
    });


function cargarTabla(pagina = 1) {
    const busqueda = document.getElementById('busqueda').value;

    fetch(`Controller/Productos/rubro.controlador.php?action=buscar&pagina=${pagina}&busqueda=${busqueda}`)

        .then((response) => response.json())
        .then((data) => {
            const tabla = document.getElementById('tablaRubros');
            tabla.innerHTML = "";

            data.rubros.forEach((rubro) => {
                const row = `
            <tr>
                <td>${rubro.idRubros}</td>
                <td>${rubro.nombre}</td>
                <td>
                    <form action="?page=editar_rubro&modulo=productos&id=${rubro.idRubros}" method="GET" style="display:inline-block;">
                        <input type="hidden" name="page" value="editar_rubro">
                        <input type="hidden" name="modulo" value="productos">
                        <input type="hidden" name="id" value="${rubro.idRubros}">
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="fi fi-rr-edit"></i>
                        </button>
                    </form>
                    <form action="Controller/Productos/rubro.controlador.php" method="POST" style="display:inline-block;">
                        <input type="hidden" name="action" value="eliminar">
                        <input type="hidden" name="id" value="${rubro.idRubros}">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este rubro?');">
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