<?php

include_once '../../Model/Usuario/usuarios.php';
include_once '../../config/conexion.php';

$form_data = array();

if(isset($_POST['action'])){
    if($_POST['action'] == 'ajax'){
        $usuario = new Usuario();
        $usuario->setUserName($_POST['nombre_usuario']);
        $resultado = $usuario->validarUsuario();
            if($resultado->num_rows > 0){
                // existe un usuario
                $form_data['data'] = 'error';
            }else{
                // NO existe un usuario
                $form_data['data'] = 'success';
            }
            echo json_encode($form_data);
    }   
}