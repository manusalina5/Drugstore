<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}


class Documento
{
    private $idDocumento;
    private $valor;
    private $tipoDocumentosId;
    private $personaId;

    public function __construct($idDocumento = null, $valor = null, $tipoDocumentosId = null, $personaId = null){
        $this->idDocumento = $idDocumento;
        $this->valor = $valor;
        $this->tipoDocumentosId = $tipoDocumentosId;
        $this->personaId = $personaId;
    }

    public function guardar(){
        $conexion = new Conexion();
        $query = "INSERT INTO documento(valor, tipoDocumentos_idtipoDocumentos, Persona_idPersona) VALUES ('$this->valor', '$this->tipoDocumentosId', '$this->personaId')";
        return $conexion->insertar($query);
    }

    public function actualizar(){
        $conexion = new Conexion();
        $query = "UPDATE documento SET valor = '$this->valor', 
                tipoDocumentos_idtipoDocumentos = '$this->tipoDocumentosId', 
                Persona_idPersona = '$this->personaId'
                WHERE idDocumento = '$this->idDocumento'";
        return $conexion->actualizar($query);
    }

    public function eliminar(){
        $conexion = new Conexion();
        $query = "UPDATE documento SET estado = 0 WHERE idDocumento = '$this->idDocumento'";
        return $conexion->actualizar($query);
    }

    public function obtenerDocumento(){
        $conexion = new Conexion();
        $query = "SELECT valor, tipoDocumentos_idtipoDocumentos, Persona_idPersona FROM Documento WHERE estado = 1";
        $resultados = $conexion->consultar($query);
        $documento = array();
        if($resultados->num_rows >0){
            while($row = $resultados->fetch_assoc()){
                $documento[] = $row;
            }
        }
        return $documento;
    }       

    public function obtenerDocumentoPorId(){
        $conexion = new Conexion();
        $query = "SELECT td.idtipoDocumentos as idtipoDocumentos, td.valor as valorTipoDocumentos, p.idPersona as idPersona, d.idDocumento as idDocumento, d.valor as valorDocumento
                    FROM documento d
                    LEFT JOIN tipodocumentos td ON d.tipoDocumentos_idtipoDocumentos = td.idtipoDocumentos
                    LEFT JOIN persona p ON p.idPersona = d.Persona_idPersona
                    WHERE p.idPersona = '$this->personaId'";
        $resultado = $conexion->consultar($query);
        return $resultado->fetch_assoc();
    }

    public function existeDocumento(){
        $conexion = new Conexion();
        $query = "SELECT * FROM documento WHERE Persona_idPersona = '$this->personaId'";
        $resultado = $conexion->consultar($query);
        $num_rows = $resultado->num_rows;
        return $num_rows > 0;
    }
    
    public function getIdDocumento()
    {
        return $this->idDocumento;
    }


    public function setIdDocumento($idDocumento)
    {
        $this->idDocumento = $idDocumento;

        return $this;
    }


    public function getValor()
    {
        return $this->valor;
    }


    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }


    public function getTipoDocumentosId()
    {
        return $this->tipoDocumentosId;
    }


    public function setTipoDocumentosId($tipoDocumentosId)
    {
        $this->tipoDocumentosId = $tipoDocumentosId;

        return $this;
    }


    public function getPersonaId()
    {
        return $this->personaId;
    }


    public function setPersonaId($personaId)
    {
        $this->personaId = $personaId;

        return $this;
    }
}
