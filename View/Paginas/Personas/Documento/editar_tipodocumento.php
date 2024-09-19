<?php
include_once 'Model/Personas/Documento/tipodocumento.php';
include_once 'config/conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; 
    $tipodocumento = new TipoDocumento();
    $tipodocumento->setId($id);
    $tipodocumentoData = $tipodocumento->obtenerTipoDocumentosPorId();
    // var_dump($tipodocumentoData);
}else{
    echo "El form esta vacio";
}
?>

<link rel="stylesheet" href="Assets/css/validaciones.css">

<div class="row">
    <div class="col"></div>
    <div class="col">
        <h1>Modificar Tipo de Documento</h1>
        <div class="alert alert-danger alert-dismissible fade show p-3 mb-4 no-alerta" role="alert" id="alert">
        </div>
        <form id="form" action="Controller/Personas/Documento/tipodocumento.controlador.php" method="POST" onsubmit="return validate(event)">
            <input type="hidden" name="action" value="modificar">
            <input type="hidden" name="idtipodocumento" value="<?php echo $tipodocumentoData['idtipodocumentos']; ?>">
            <div class="mb-3">
                <label for="valortipodocumento" class="form-label">Valor</label>
                <input type="text" class="form-control" id="valortipodedocumento" name="valortipodocumento" value="<?php echo $tipodocumentoData['valor']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Modificar</button>
        </form>
    </div>
    <div class="col"></div>
</div>

<script src="Assets/js/Validaciones/alta_tipodocumento.js"></script>