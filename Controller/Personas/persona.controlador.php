<?php

include_once '../../Model/Personas/persona.php';
include_once '../../Model/Personas/Documento/tipoDocumento.php';
include_once '../../Model/Personas/Documento/documento.php';
include_once '../../Model/Personas/Contacto/tipoContacto.php';
include_once '../../Model/Personas/Contacto/contacto.php';
include_once '../../config/conexion.php';

if (isset($_POST['action'])) {
    $persona = new PersonaControlador();
    if ($_POST['action'] == 'registro') {
        $persona->registrarPersona();
    } else if ($_POST['action'] == 'modificar') {
        $persona->modificarPersona();
    } elseif ($_POST['action'] == 'eliminar') {
        $persona->eliminarPersona();
    } else {
        "ERROR: Contactarse con el administrador";
    }
}

class PersonaControlador
{
    public function registrarPersona()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // exit();
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto'])
        ) {
            header('Location: ../../index.php?error=missing_fields');
            exit();
        } else {
            $persona = new Persona(null, $_POST['nombre'], $_POST['apellido']);
            $idPersona = $persona->guardar();
            if ($idPersona) {
                $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
                $documento->guardar();
                $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
                $contacto->guardar();
                header('Location: ../../?page=listado_persona&modulo=personas&status=success');
            } else {
                header('Location: ../../index.php?error=insert_failed');
            }
        }
    }

    public function modificarPersona()
    {
    
        if (empty($_POST['nombre']) ||
            empty($_POST['apellido']) || 
            empty($_POST['idPersona']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto'])){
            header('Location: ../../index.php?error=missing_fields');
            exit();
        } else {
            $persona = new Persona($_POST['idPersona'], $_POST['nombre'], $_POST['apellido']);
            $persona->actualizar();
            $contacto = new Contacto(null,$_POST['contacto'],$_POST['idtipoContacto'],$_POST['idPersona']);
            if($contacto->existeContacto()){
                $contacto->actualizar();
            }else{
                $contacto->guardar();
            }
            $documento = new Documento(null,$_POST['documento'],$_POST['idtipoDocumentos'],$_POST['idPersona']);
            if($documento->existeDocumento()){
                $documento->actualizar();
            }else{
                $documento->guardar();
            }
            header('Location: ../../?page=listado_persona&modulo=personas&status=success');
        }
    }

    public function eliminarPersona()
    {
        if (!empty($_POST['idPersona'])) {
            $persona = new Persona($_POST['idPersona'], null, null);
            $persona->eliminar();
            header('Location: ../../?page=listado_persona&modulo=personas&status=deleted');
        } else {
            header('Location: ../../index.php?error=missing_id');
        }
    }
}
