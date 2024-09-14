<?php

include_once '../../../Model/Personas/Cliente/cliente.php';
include_once '../../../Model/Personas/persona.php';
include_once '../../../Model/Personas/Documento/tipoDocumento.php';
include_once '../../../Model/Personas/Documento/documento.php';
include_once '../../../Model/Personas/Contacto/tipoContacto.php';
include_once '../../../Model/Personas/Contacto/contacto.php';
include_once '../../../Model/Personas/Direccion/direccion.php';
include_once '../../../config/conexion.php';


// print_r($_POST);
// exit();

if (isset($_GET['action']) && $_GET['action'] == 'buscar') {
    $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';

    $registro_por_pagina = 10;
    $inicio = ($pagina - 1) * $registro_por_pagina;

    $clienteObj = new Cliente();
    $clientes = $clienteObj->buscarClientes($busqueda, $inicio, $registro_por_pagina);
    $total_paginas = Cliente::totalPaginasBusqueda($busqueda, $registro_por_pagina);

    echo json_encode([
        'clientes' => $clientes,
        'total_paginas' => $total_paginas
    ]);
    exit();
}

if (isset($_POST['action'])) {
    $cliente = new ClienteControlador();
    if ($_POST['action'] == 'registro') {
        $cliente->registrarcliente();
    } else if ($_POST['action'] == 'modificar') {
        $cliente->modificarcliente();
    } elseif ($_POST['action'] == 'eliminar') {
        $cliente->eliminarcliente();
    } else if ($_POST['action'] == 'modificarUser') {
        $cliente->modificarcliente();
    } else {
        echo "ERROR: Contactarse con el administrador";
    }
}


class ClienteControlador
{

    public function registrarcliente()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['observaciones'])
        ) {
            header('Location: ../../../index.php?error=missing_fields');
            exit();
        } else {
            $cliente = new Cliente(null, $_POST['observaciones'], null, $_POST['nombre'], $_POST['apellido']);
            $cliente->guardar();
            $idPersona = $cliente->getIdPersona();
            if ($idPersona) {
                $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
                $documento->guardar();
                $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
                $contacto->guardar();
                $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
                $direccion->guardar();
                header('Location: ../../../?page=listado_cliente&modulo=personas&submodulo=cliente&status=success');
            } else {
                header('Location: ../../../index.php?error=insert_failed');
            }
        }
    }

    public function modificarcliente()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idClientes']) ||
            empty($_POST['idPersona']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['observaciones'])
        ) {
            header('Location: ../../index.php?error=missing_fields');
            exit();
        } else {
            $idCliente = $_POST['idClientes'];
            $idPersona = $_POST['idPersona'];

            $cliente = new Cliente($idCliente, $_POST['observaciones'], $idPersona, $_POST['nombre'], $_POST['apellido']);
            $cliente->actualizar();

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
            if ($_POST['action'] == 'modificar') {
                header('Location: ../../../?page=listado_cliente&modulo=personas&submodulo=cliente&status=success');
            } else if ($_POST['action'] == 'modificarUser') {
                header('Location: ../../../?page=configuracion&modulo=usuarios&mensaje=Se actualizaron los datos correctamente&status=success');
            }
        }
    }

    public function eliminarcliente() {
        if (!empty($_POST['idCliente']) && !empty($_POST['idPersona'])) {
            $cliente = new Cliente($_POST['idCliente'], null, $_POST['idPersona'], null, null);
            $cliente->eliminar();
            header('Location: ../../../?page=listado_cliente&modulo=personas&submodulo=cliente&status=deleted');
        } else {
            header('Location: ../../index.php?error=missing_id');
        }
    }
}
