<?php


class LoginControlador{
    public function ingresar(){
        $usuario = new Usuario();
        $usuario->setUserName($_POST['nombre_usuario']);
        $usuario->setPass($_POST['pass']);
        $resultado = $usuario->validarUsuario();
        if ($resultado->num_rows > 0){
            echo 'Logueado';
        }else{
            echo 'no logueado';
        }
    }
}