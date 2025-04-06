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

function buscarCliente() {
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

if(isset($_GET['action'])){
    switch($_GET['action']){
        case 'buscar':
            buscarCliente();
            break;
        case 'buscarventa':
            $cliente = new ClienteControlador();
            $cliente->listadoClientesVenta();
            break;
    }
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
    } else if ($_POST['action'] == 'registro_venta') {
        $cliente->registrarClienteVenta();
    } else if ($_POST['action'] == 'validarDocumento'){
        $cliente->validarDocumento();
    }
    else {
        echo "ERROR: Contactarse con el administrador";
    }
}


class ClienteControlador
{

    public function registrarcliente()
    {
        // Validar campos obligatorios básicos
        if (
            empty($_POST['nombre']) ||
            empty($_POST['apellido']) ||
            empty($_POST['idtipoDocumentos']) ||
            empty($_POST['documento']) ||
            empty($_POST['direccion'])
        ) {
            header('Location: ../../../index.php?error=missing_fields');
            exit();
        }
    
        // Validar si los contactos están correctamente definidos
        if (empty($_POST['idtipoContacto']) || empty($_POST['contacto']) || 
            !is_array($_POST['idtipoContacto']) || !is_array($_POST['contacto']) || 
            count($_POST['idtipoContacto']) !== count($_POST['contacto'])) {
            header('Location: ../../../index.php?error=contacto invalido');
            exit();
        }
    
        // Crear instancia de Cliente y guardarlo
        $cliente = new Cliente(null, $_POST['observaciones'], null, $_POST['nombre'], $_POST['apellido']);
        $cliente->guardar();
        $idPersona = $cliente->getIdPersona();
    
        if ($idPersona) {
            // Registrar el documento
            $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
            $documento->guardar();
    
            // Registrar múltiples contactos
            foreach ($_POST['idtipoContacto'] as $index => $tipoContactoId) {
                $contactoValor = $_POST['contacto'][$index];
                $contacto = new Contacto(null, $contactoValor, $tipoContactoId, $idPersona);
                $contacto->guardar();
            }
    
            // Registrar la dirección
            $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
            $direccion->guardar();
    
            // Redirigir con éxito
            header('Location: ../../../?page=listado_cliente&modulo=personas&submodulo=cliente&status=success');
        } else {
            // Error al registrar cliente
            header('Location: ../../../index.php?error=insert_failed');
        }
    }
    

    public function registrarClienteVenta()
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
            echo json_encode([
                'success' => false,
                'message' => 'Faltan campos por completar'
            ]);
            exit(); // Detén la ejecución después de la respuesta
        } else {
            $cliente = new Cliente(null, $_POST['observaciones'], null, $_POST['nombre'], $_POST['apellido']);
            $idCliente = $cliente->guardar();
            $idPersona = $cliente->getIdPersona();
            $nombreapellido = $_POST['nombre'] . ' ' . $_POST['apellido'];

            if ($idPersona) {
                $documento = new Documento(null, $_POST['documento'], $_POST['idtipoDocumentos'], $idPersona);
                $documento->guardar();
                $contacto = new Contacto(null, $_POST['contacto'], $_POST['idtipoContacto'], $idPersona);
                $contacto->guardar();
                $direccion = new Direccion(null, $_POST['direccion'], $idPersona);
                $direccion->guardar();

                echo json_encode([
                    'success' => true,
                    'message' => 'Se registró correctamente el cliente',
                    'clienteId' => $idCliente,
                    'nombreapellido' => $nombreapellido
                ]);
                exit(); // Detén la ejecución después de la respuesta
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Error al registrar el cliente'
                ]);
                exit(); // Detén la ejecución después de la respuesta
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
            empty($_POST['direccion'])
        ) {
            header('Location: ../../index.php?error=missing_fields');
            exit();
        } else {
            $idCliente = $_POST['idClientes'];
            $idPersona = $_POST['idPersona'];

            if (empty($_POST['idtipoContacto']) || empty($_POST['contacto']) || 
            !is_array($_POST['idtipoContacto']) || !is_array($_POST['contacto']) || 
            count($_POST['idtipoContacto']) !== count($_POST['contacto'])) {
            header('Location: ../../../index.php?error=contacto invalido');
            exit();
        }

            $cliente = new Cliente($idCliente, $_POST['observaciones'], $idPersona, $_POST['nombre'], $_POST['apellido']);
            $cliente->actualizar();

            foreach($_POST['idtipoContacto'] as $index => $tipoContactoId){
                $contactoValor = $_POST['contacto'][$index];
                $contacto = new Contacto(null, $contactoValor, $tipoContactoId, Persona_idPersona: $idPersona);
                if ($contacto->existeContacto()) {
                    $contacto->actualizar();
                } else {
                    $contacto->guardar();
                }
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
            if ($_POST['action'] == 'modificar') {
                header('Location: ../../../?page=listado_cliente&modulo=personas&submodulo=cliente&status=success');
            } else if ($_POST['action'] == 'modificarUser') {
                header('Location: ../../../?page=configuracion&modulo=usuarios&mensaje=Se actualizaron los datos correctamente&status=success');
            }
        }
    }

    public function eliminarcliente()
    {
        if (!empty($_POST['idCliente']) && !empty($_POST['idPersona'])) {
            $cliente = new Cliente($_POST['idCliente'], null, $_POST['idPersona'], null, null);
            $cliente->eliminar();
            header('Location: ../../../?page=listado_cliente&modulo=personas&submodulo=cliente&status=deleted');
        } else {
            header('Location: ../../index.php?error=missing_id');
        }
    }

    public function listadoClientesVenta(){
        if(isset($_GET['q'])){
            $query = $_GET['q'];
            $clienteModel = new Cliente();
            $clientes = $clienteModel->obtenerClientes($query);

            echo json_encode($clientes);
        }
        exit();
    }

    public function validarDocumento() {
        // Asegurarse de enviar los headers antes de cualquier salida
        header('Content-Type: application/json');
        
        // Obtener y validar los datos de entrada
        $tipodocumento = isset($_POST['tipodocumento']) ? $_POST['tipodocumento'] : null;
        $valor = isset($_POST['valor']) ? $_POST['valor'] : null;
        
        if (!$tipodocumento || !$valor) {
            echo json_encode([
                'success' => false,
                'message' => 'Datos incompletos'
            ]);
            exit();
        }

        try {
            $documento = new Documento(null, $valor, $tipodocumento, null);
            $existe = $documento->validarDocumento();
            
            echo json_encode([
                'success' => !$existe,
                'message' => $existe ? 'El documento ya existe' : ''
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => 'Error al validar el documento: ' . $e->getMessage()
            ]);
        }
        exit();
    }
    

}
