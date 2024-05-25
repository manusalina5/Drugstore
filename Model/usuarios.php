<?php

require_once('config/conexion.php');

class Usuario
{
    private $id;
    private $userName;
    private $email;
    private $pass;

    public function __construct($id = '', $userName = '', $email = '', $pass = '')
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function guardar()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO usuarios(userName, email, pass) VALUES ('$this->userName', '$this->email', '$this->pass')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE usuarios SET userName = '$this->userName', email = '$this->email', pass = '$this->pass'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE usuarios SET estado = 0 WHERE id = '$this->id'";
        return $conexion->actualizar($query);
    }

    public function validarUsuario()
    {
        $conexion  = new Conexion();
        $query = "SELECT * FROM usuarios WHERE username = '$this->userName' AND pass = '$this->pass'";
        return $conexion->consultar($query);
    }


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getUserName()
    {
        return $this->userName;
    }


    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getPass()
    {
        return $this->pass;
    }


    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }
}
