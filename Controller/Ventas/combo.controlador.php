<?php
require_once("Model/Ventas/combo.php");

class ComboControlador {
    
    public function __construct()
    {
        $action = $_POST['action'] ?? $_GET['action'] ?? null;
        if (isset($action)) {
            switch ($action) {
                case 'registro':
                    //
                    break;
                case 'editar':
                    //
                    break;
                case 'eliminar':
                    //
            }
        }
    }

    public function guardarCombo(){
        //
    }

}
