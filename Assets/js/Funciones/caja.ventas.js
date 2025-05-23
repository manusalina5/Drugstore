const estadoCaja = document.getElementById('estadoCaja');
const btnAbrirCaja = document.getElementById('btnAbrirCaja');
const btnCerrarCaja = document.getElementById('btnCerrarCaja');
const btnModalAbrirCaja = document.getElementById('btnModalAbrirCaja');
const btnModalCerrarCaja = document.getElementById('btnModalCerrarCaja');
const formModalAbrirCaja = document.getElementById('formModalAbrirCaja');
const formModalCerrarCaja = document.getElementById('formModalCerrarCaja');
const ventasDia = document.getElementById('ventasDia');
const saldoFinal = document.getElementById('saldoFinal');
const montoFinalModal = document.getElementById('montoFinal');


document.addEventListener('DOMContentLoaded', caja());

btnModalAbrirCaja.onclick = function(){
    formModalAbrirCaja.submit();
}

btnModalCerrarCaja.onclick = function(){
    formModalCerrarCaja.submit();
}

function caja(){
    obtenerEstadoCaja();
    obtenerInfoCaja();
}

function obtenerEstadoCaja(){
    fetch('Controller/Caja/caja.controlador.php?action=obtenerestado')
    .then(response => response.json())
    .then(data =>{
        if(data == 1){
            estadoCaja.innerHTML = 'ABIERTO';
            estadoCaja.setAttribute('class','text-success');
            btnAbrirCaja.style.display = 'none';
            btnCerrarCaja.style.display = 'block';
        }else if(data == false){
            estadoCaja.innerHTML = 'CERRADO';
            estadoCaja.setAttribute('class','text-danger');
            btnAbrirCaja.style.display = 'block';
            btnCerrarCaja.style.display = 'none';
        }
    });
}

function obtenerInfoCaja(){
    fetch('Controller/Caja/caja.controlador.php?action=obtenerinfo')
    .then(response => response.json())
    .then(data =>{
        if(data == false){
            console.log('Error: data = false');
        }else{
            console.log(data);
            let saldoInicial = document.getElementById('saldoInicial');
            saldoInicial.innerHTML = data[0].montoInicial;
            ventasDia.innerHTML = data[0].totalVentas;
            saldoFinal.innerHTML = data[0].total;
            montoFinalModal.value = data[0].total;
        }
    });
}