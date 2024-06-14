<?php

include_once 'config/conexion.php';


class Usuario
{
    private $id;
    private $userName;
    private $pass;
    private $fechaAlta;
    private $idEmpleado;
    private $idPerfiles;

    public function __construct($id = '', $userName = '', $pass = '',$fechaAlta = '', $idEmpleado = '', $iPerfiles = '')
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->idPerfiles = $iPerfiles;
        $this->fechaAlta = $fechaAlta;
    }

    public function guardar()
    {
        $conexion = new Conexion();
        $query = "INSERT INTO `usuarios`
                (`username`,
                `password`,
                `fechaAlta`,
                `Empleado_idEmpleado`,
                `perfiles_idperfiles`)
                VALUES
                ('$this->userName','$this->pass','$this->fechaAlta','$this->idEmpleado','$this->idPerfiles')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $query = "UPDATE usuarios SET username = '$this->userName', password =  '$this->fechaAlta',Empleado_idEmpleado = '$this->idEmpleado',perfiles_idperfiles ='$this->idPerfiles'";
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

    public function obtenerHash()
    {
        $conexion = new Conexion();
        $username = $this->userName;
        $query = "SELECT pass FROM usuarios WHERE username = '$username'";
        $resultado = $conexion->consultar($query);
        $fila = $resultado->fetch_assoc();
        $hash = $fila['pass'];
        return $hash;
    }

    // Funcion para listar los usuarios 

    public function obtenerUsuarios()
    {
        $conexion = new Conexion();
        $query = "SELECT idusuario, username, password, fechaalta FROM usuarios";
        $resultado = $conexion->consultar($query);
        $usuarios = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }
        return $usuarios;
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
