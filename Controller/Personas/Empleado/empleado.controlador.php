<?php

include_once '../../../Model/Personas/Empleado/empleado.php';
include_once '../../../Model/Personas/persona.php';
include_once '../../../Model/Personas/Documento/tipoDocumento.php';
include_once '../../../Model/Personas/Documento/documento.php';
include_once '../../../Model/Personas/Contacto/tipoContacto.php';
include_once '../../../Model/Personas/Contacto/contacto.php';
include_once '../../../Model/Personas/Direccion/direccion.php';
include_once '../../../config/conexion.php';

if (isset($_GET['action']) && $_GET['action'] == 'buscar') {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $registro_por_pagina = 10;
    $inicio = ($pagina - 1) * $registro_por_pagina;

    $empleadoObj = new Empleado();
    $empleados = $empleadoObj->buscarEmpleados($busqueda, $inicio, $registro_por_pagina);
    $total_paginas = Empleado::totalPaginasBusqueda($busqueda, $registro_por_pagina);

    echo json_encode([
        'empleados' => $empleados,
        'total_paginas' => $total_paginas
    ]);
    exit();
}

if (isset($_POST['action'])) {
    $empleado = new EmpleadoControlador();
    switch ($_POST['action']) {
        case 'registro':
            $empleado->registrarEmpleado();
            break;
        case 'registroModal':
            $empleado->registrarEmpleadoModal();
            break;
        case 'modificar':
            $empleado->modificarEmpleado();
            break;
        case 'eliminar':
            $empleado->eliminarEmpleado();
            break;
        case 'modificarUser':
            $empleado->modificarEmpleado();
            break;
        default:
            echo "ERROR: Contactarse con el administrador";
            break;
    }
}

class EmpleadoControlador
{
    public function registrarEmpleado()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['legajo'])
        ) {
            header('Location: ../../../index.php?error=missing_fields');
            exit();
        } else {
            $empleado = new Empleado(null, $_POST['legajo'],null, $_POST['nombre'], $_POST['apellido']);
            $empleado->guardar();
            $idPersona = $empleado->getIdPersona();
            if ($idPersona) {
                $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
                $documento->guardar();
                $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
                $contacto->guardar();
                $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
                $direccion->guardar();
                header('Location: ../../../?page=listado_empleado&modulo=personas&submodulo=empleado&status=success');
            } else {
                header('Location: ../../../index.php?error=insert_failed');
            }
        }
    }

        public function registrarEmpleadoModal()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['legajo'])
        ) {
            header('Location: ../../../index.php?error=missing_fields');
            exit();
        } else {
            $empleado = new Empleado(null, $_POST['legajo'],null, $_POST['nombre'], $_POST['apellido']);
            $empleado->guardar();
            $idPersona = $empleado->getIdPersona();
            if ($idPersona) {
                $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
                $documento->guardar();
                $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
                $contacto->guardar();
                $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
                $direccion->guardar();
                header('Location: ../../../?page=registro&modulo=usuarios&status=success');
            } else {
                header('Location: ../../../index.php?error=insert_failed');
            }
        }
    }

    public function modificarEmpleado()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idEmpleado']) ||
            empty($_POST['idPersona']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['legajo'])
        ) {
            header('Location: ../../index.php?error=missing_fields');
            exit();
        } else {
            $idEmpleado = $_POST['idEmpleado'];
            $idPersona = $_POST['idPersona'];

            $empleado = new Empleado($idEmpleado,$_POST['legajo'],$idPersona,$_POST['nombre'],$_POST['apellido']);
            $empleado->actualizar();

            $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
            if ($documento->existeDocumento()) {
                $documento->actualizar();
            } else {
                $documento->guardar();
            }

            $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
            if ($contacto->existeContacto()) {
                $contacto->actualizar();
            } else {
                $contacto->guardar();
            }

            $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
            if ($direccion->existeDireccion()) {
                $direccion->actualizar();
            } else {
                $direccion->guardar();
            }
            if($_POST['action']== 'modificar'){
                header('Location: ../../../?page=listado_empleado&modulo=personas&submodulo=empleado&status=success');
            }else if($_POST['action']== 'modificarUser'){
                header('Location: ../../../?page=configuracion&modulo=usuarios&mensaje=Se actualizaron los datos correctamente&status=success');
            }
            
        }
    }

    public function eliminarEmpleado()
    {
        if (!empty($_POST['idEmpleado']) && !empty($_POST['idPersona'])) {
            $empleado = new Empleado($_POST['idEmpleado'], null, $_POST['idPersona'], null, null);
            $empleado->eliminar();
            header('Location: ../../../?page=listado_empleado&modulo=personas&submodulo=empleado&status=deleted');
        } else {
            header('Location: ../../index.php?error=missing_id');
        }
    }
}
