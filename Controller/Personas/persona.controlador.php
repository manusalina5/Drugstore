<?php

include_once '../../Model/Personas/persona.php';
include_once '../../Model/Personas/Documento/tipoDocumento.php';
include_once '../../Model/Personas/Documento/documento.php';
include_once '../../Model/Personas/Contacto/tipoContacto.php';
include_once '../../Model/Personas/Contacto/contacto.php';
include_once '../../Model/Personas/Direccion/direccion.php';
include_once '../../config/conexion.php';

if ($_GET['action'] == 'buscar') {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $registro_por_pagina = 5;
    $inicio = ($pagina - 1) * $registro_por_pagina;

    $personaObj = new Persona();
    $personas = $personaObj->buscarPersonas($busqueda, $inicio, $registro_por_pagina);
    $total_paginas = Persona::totalPaginasBusqueda($busqueda, $registro_por_pagina);

    echo json_encode([
        'personas' => $personas,
        'total_paginas' => $total_paginas
    ]);
    exit();
}


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

        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion'])
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
                $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
                $direccion->guardar();
                header('Location: ../../?page=listado_persona&modulo=personas&status=success');
            } else {
                header('Location: ../../index.php?error=insert_failed');
            }
        }
    }

    public function modificarPersona()
    {

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // exit();
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idPersona']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion'])
        ) {
            header('Location: ../../index.php?error=missing_fields');
            exit();
        } else {
            $persona = new Persona($_POST['idPersona'], $_POST['nombre'], $_POST['apellido']);
            $persona->actualizar();
            $idPersona = $_POST['idPersona'];

            $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
            if ($contacto->existeContacto()) {
                $contacto->actualizar();
            } else {
                $contacto->guardar();
            }

            $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
            if ($documento->existeDocumento()) {
                $documento->actualizar();
            } else {
                $documento->guardar();
            }

            $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
            if ($direccion->existeDireccion()) {
                $direccion->actualizar();
            } else {
                $direccion->guardar();
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
