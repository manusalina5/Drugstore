const btnAumentarPrecio = document.getElementById('btnAumentarPrecio');

btnAumentarPrecio.onclick = function() { 
    const data = {
        tipoaumento : document.getElementById('tipoaumento').value,
        priceOptions : document.getElementById('priceOption').value,
        tipoMonto : document.getElementById('tipoMonto').value,
        montoActualizar : document.getElementById('montoActualizar').value,
        selectmarcarubro : document.getElementById('selectmarcarubro').value
    }

    fetch("Controller/Productos/producto.controlador.php?action=actualizarprecio", {
        method: "POST", // Tipo de petición
        headers: {
            'Content-Type': 'application/json' // Especifica que el cuerpo de la petición está en formato JSON
        },
        body: JSON.stringify(data) // Convierte el objeto `data` en una cadena JSON
    })
        .then(response => response.json()) // Convierte la respuesta en JSON
        .then(success => {
            if (!success) {
                Command: toastr["warning"]("Hay algunos campos vacíos", "No se pudo la operación");

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            } else {
                Command: toastr["success"]("Aumento realizado correctamente!", "Éxito");

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

                document.getElementById("cerrarModal").click();
                cargarProductos(pagina = 1);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
};




const select = document.getElementById('tipoaumento');
const listado = document.getElementById('listadorubromarca');
select.addEventListener('change', function(){
    let valor = select.value;
    if(valor == 'rubro'){
        obtenerRubros();
    }

    if(valor == 'marca'){
        obtenerMarcas();
    }
})


const priceOptions = document.getElementById('priceOption');
const mensajePriceOption = document.getElementById('mensajePriceOption');

priceOptions.addEventListener('change', function(){
    switch(priceOptions.value){
        case 'costo-utilidad':
            mensajePriceOption.innerHTML = 'Actualiza precio de costo, recalcula el de venta y mantiene la utilidad'; 
            break;
        case 'costo-precio':
            mensajePriceOption.innerHTML = 'Actualiza precio de costo, mantiene el de venta y recalcula la utilidad';
            break;
        case 'precioventa':
            mensajePriceOption.innerHTML = 'Actualiza precio de venta, mantiene el de costo y recalcula la utilidad'; 
            break;
        case 'utilidad':
            mensajePriceOption.innerHTML = 'Reemplaza la utilidad, mantiene el precio de costo y recalcula el de venta'; 
            break;
    }
});

const tipoMonto = document.getElementById('tipoMonto');
const mensajeTipoMonto = document.getElementById('mensajeTipoMonto');

tipoMonto.addEventListener('change', function() {
    const simboloMonto = document.getElementById('simboloMonto');
    switch (tipoMonto.value) {
        case 'fijo':
            mensajeTipoMonto.innerHTML = 'Actualiza agregando un monto fijo';
            simboloMonto.innerText = '$'; // Cambia al símbolo de monto fijo
            break;
        case 'porcentual':
            mensajeTipoMonto.innerHTML = 'Actualiza a traves de un valor porcentual';
            simboloMonto.innerText = '%'; // Cambia al símbolo de porcentaje
            break;
    }
});


function obtenerRubros(){
    fetch(`Controller/Productos/rubro.controlador.php?action=buscarselect`)
            .then(response => response.json())
            .then(data => {
                if (data !== false) {
                    let select = crearSelect();
                    data.forEach(rubro => {
                        let option = document.createElement('option');
                        option.innerHTML = 'Rubro - ' + rubro.nombre;
                        option.setAttribute('value',rubro.idRubros);
                        select.appendChild(option);
                    });
                } else {
                    //
                }
            })
            .catch(error => console.error('Error:', error));
    }


function obtenerMarcas(){
    fetch(`Controller/Productos/marca.controlador.php?action=buscarselect`)
    .then(response => response.json())
    .then(data => {
        if (data !== false) {
            let select = crearSelect();
                    data.forEach(marca => {
                        let option = document.createElement('option');
                        option.innerHTML = 'Marca - ' +  marca.nombre;
                        option.setAttribute('value',marca.idmarca);
                        select.appendChild(option);
                    });
        } else {
            //
        }
    })
    .catch(error => console.error('Error:', error));
}


function crearSelect(){
    listado.innerHTML = '';
    let select = document.createElement('select');
    select.classList.add('form-select','mb-3');
    select.setAttribute('name','selectmarcarubro');
    select.setAttribute('id','selectmarcarubro');
    listado.appendChild(select);
    return select;
}