<?php

include_once '../../Model/Personas/persona.php';
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
        if (empty($_POST['nombre']) || empty($_POST['apellido'])) {
            header('Localation: ../../index?');
            exit();
        } else {
            $persona = new Persona(null, $_POST['nombre'], $_POST['apellido']);
            $persona->guardar();
            header('Location: ../../?page=listado_persona&modulo=personas');
        }
    }

    public function modificarPersona()
    {
        if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['idPersona'])) {
            header('Localation: ../../index?');
            exit();
        } else {
            $persona = new Persona($_POST['idPersona'], $_POST['nombre'], $_POST['apellido']);
            $persona->actualizar();
            header('Location: ../../?page=listado_persona&modulo=personas');
        }
    }

    public function eliminarPersona(){
        if(!empty($_POST['idPersona'])){
            $persona = new Persona($_POST['idPersona'], null,null);
            $persona->eliminar();
            header('Location: ../../?page=listado_persona&modulo=personas');
        }
    }

}
