<?php

include_once '../../../Model/Personas/Proveedor/proveedor.php';
include_once '../../../Model/Personas/persona.php';
include_once '../../../Model/Personas/Documento/tipoDocumento.php';
include_once '../../../Model/Personas/Documento/documento.php';
include_once '../../../Model/Personas/Contacto/tipoContacto.php';
include_once '../../../Model/Personas/Contacto/contacto.php';
include_once '../../../Model/Personas/Direccion/direccion.php';
include_once '../../../config/conexion.php';

// print_r($_POST);
// exit();

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'buscar':
            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
        
            $registro_por_pagina = 10;
            $inicio = ($pagina - 1) * $registro_por_pagina;
        
            $proveedorObj = new Proveedor();
            $proveedores = $proveedorObj->buscarProveedores($busqueda, $inicio, $registro_por_pagina);
            # $total_paginas = Proveedor::totalPaginasBusqueda($busqueda, $registro_por_pagina);
            $total_paginas = 1;
            header('Content-Type: application/json');
            echo json_encode([
                'proveedores' => $proveedores,
                'total_paginas' => $total_paginas
            ]);
            exit();
        case 'buscarcompra':
            $proveedor = new ProveedorControlador();
            $proveedor->listadoProveedorCompra();
            break;
    }

}

if (isset($_POST["action"])) {
    $proveedor = new ProveedorControlador();
    switch ($_POST["action"]) {
        case 'registro':
            $proveedor->registrarProveedor();
            break;
        case 'modificar':
            $proveedor->modificarProveedor();
            break;
        case 'eliminar':
            $proveedor->eliminarProveedor();
            break;
        case 'registro_proveedor':
            $proveedor->registrarProveedorCompra();
            break;
    }
}

class ProveedorControlador
{


    public function registrarProveedor()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['razonSocial'])
        ) {
            header('Location: ../../../index.php?error=missing_fields');
            exit();
        } else {
            $proveedor = new Proveedor(null, $_POST['razonSocial'], null, $_POST['nombre'], $_POST['apellido']);
            $proveedor->guardar();
            $idPersona = $proveedor->getIdPersona();
            if ($idPersona) {
                $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
                $documento->guardar();
                $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
                $contacto->guardar();
                $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
                $direccion->guardar();
                header('Location: ../../../?page=listado_proveedor&modulo=personas&submodulo=proveedor&status=success');
            } else {
                header('Location: ../../../index.php?error=insert_failed');
            }
        }
    }

    public function modificarProveedor()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idProveedor']) ||
            empty($_POST['idPersona']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['razonSocial'])
        ) {
            header('Location: ../../..//index.php?error=missing_fields');
        } else {
            $idProveedor = $_POST['idProveedor'];
            $idPersona = $_POST['idPersona'];

            $proveedor = new Proveedor($idProveedor, $_POST['razonSocial'], $idPersona, $_POST['nombre'], $_POST['apellido']);
            $proveedor->actualizar();

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

            header('Location: ../../../?page=listado_proveedor&modulo=personas&submodulo=proveedor&status=success');
        }
    }


    public function eliminarProveedor()
    {
        if (!empty($_POST['idProveedor']) && !empty($_POST['idPersona'])) {
            $proveedor = new Proveedor($_POST['idProveedor'], null, $_POST['idPersona'], null, null);
            $proveedor->eliminar();
            header('Location: ../../../?page=listado_proveedor&modulo=personas&submodulo=proveedor&status=deleted');
        } else {
            header('Location: ../../index.php?error=missing_id');
        }
    }

    public function registrarProveedorCompra()
    {
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['idtipoContacto']) ||
            empty($_POST['contacto']) ||
            empty($_POST['direccion']) ||
            empty($_POST['razonSocial'])
        ) {
            echo json_encode([
                'success' => false,
                'message' => 'Faltan campos por completar'
            ]);
            exit(); // Detén la ejecución después de la respuesta
        } else {
            $proveedor = new Proveedor();
            $proveedor->setNombre($_POST['nombre']);
            $proveedor->setApellido($_POST['apellido']);
            $proveedor->setRazonSocial($_POST['razonSocial']);
            $idProveedor = $proveedor->guardar();
            $idPersona = $proveedor->getIdPersona();
            $nombreapellido = $_POST['nombre'] . ' ' . $_POST['apellido'];

            if ($idPersona) {
                $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
                $documento->guardar();
                $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
                $contacto->guardar();
                $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
                $direccion->guardar();
                $razonSocial = $proveedor->getRazonSocial();

                echo json_encode([
                    'success' => true,
                    'message' => 'Se registró correctamente el proveedor',
                    'proveedorId' => $idProveedor,
                    'nombreapellido' => $nombreapellido,
                    'razonSocial' => $razonSocial
                ]);
                exit(); // Detén la ejecución después de la respuesta
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al registrar el proveedor'
                ]);
                exit(); // Detén la ejecución después de la respuesta
            }
        }
    }

    public function listadoProveedorCompra(){
        if(isset($_GET['q'])){
            $query = $_GET['q'];
            $proveedores = Proveedor::obtenerProveedores($query);
            echo json_encode($proveedores);
        }
        exit();
    }
}

