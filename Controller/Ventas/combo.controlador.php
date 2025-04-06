<?php
require_once("../../Model/Ventas/combo.php");
require_once("../../Model/Ventas/detallecombo.php");

class ComboControlador
{

    public function __construct()
    {
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        if (isset($action)) {
            switch ($action) {
                case 'registro':
                    $this->guardarCombo();
                    break;
                case 'editar':
                    //
                    break;
                case 'eliminar':
                //
            }
        }
    }

    public function guardarCombo()
    {
        $json = file_get_contents('php://input');

        // Decodificar el JSON recibido
        $data = json_decode($json, true); 
        $errores = $this->validar($data);

        if(empty($errores)) {
            $combo = $this->crearObjetoCombo($data);
            $idCombo = $combo->guardarCombo();
            foreach($data as $clave => $valor) {
                if($clave === 'productos') {
                    foreach($valor as $producto) {
                        $detalleCombo = $this->crearObjetoDetalleCombo($producto,$idCombo);
                        
            }
        }
    }

    public function validar($data)
    {
        $errores = array();
        if (empty($data['nombre'])) {
            $errores[] = 'Error: Nombre vacio';
        }

        if (empty($data['valor'])) {
            $errores[] = 'Error: Valor vacio';
        }
        if (empty($data['tipovalor'])) {
            $errores[] = 'Error: Tipo de Valor vacio';
        }
        if (empty($data['fechavencimiento'])) {
            $errores[] = 'Error: Fecha Vencimiento vacio';
        }

        return $errores;
    }
    public function crearObjetoCombo($data)
    {
        $combo = new Combo();
        $combo->setNombreCombo($data['nombre']);
        $combo->setDescripcion($data['descripcion']);
        $combo->setValorDescuento($data['valor']);
        $combo->setIdTipoDescuento($data['tipovalor']);
        $combo->setFechaVencimiento($data['fechavencimiento']);
        return $combo;
    }

    public function crearObjetoDetalleCombo($data, $idCombo)
    {
        $detalleCombo = new DetalleCombo();
        $detalleCombo->setCantidad($data['cantidad']);
        $detalleCombo->setIdProducto($data['id']);
        $detalleCombo->setIdCombo($idCombo);
        return $detalleCombo;
    }



}

new ComboControlador();