<?php

$rutaAbsoluta = $_SERVER['DOCUMENT_ROOT'] . '/Drugstore/config/conexion.php';

if (file_exists($rutaAbsoluta)) {
    include_once $rutaAbsoluta;
} else {
    echo "Error: Archivo de configuración no encontrado en: " . $rutaAbsoluta;
}

class Usuario
{
    private $idUsuario;
    private $userName;
    private $pass;
    private $idEmpleado;
    private $idPerfiles;

    public function __construct($idUsuario = '', $userName = '', $pass = '', $idEmpleado = '', $iPerfiles = '')
    {
        $this->idUsuario = $idUsuario;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->idEmpleado = $idEmpleado;
        $this->idPerfiles = $iPerfiles;
    }

    public function guardar()
    {
        $conexion = new Conexion();
        $passwordHash = password_hash($this->pass, PASSWORD_DEFAULT);
        $query = "INSERT INTO `usuarios`
                (`username`,
                `password`,
                `fechaAlta`,
                `Empleado_idEmpleado`,
                `perfiles_idperfiles`)
                VALUES
                ('$this->userName','$passwordHash',now(),'$this->idEmpleado','$this->idPerfiles')";
        return $conexion->insertar($query);
    }

    public function actualizar()
    {
        $conexion = new Conexion();
        $passwordHash = password_hash($this->pass, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET username = '$this->userName', password =  '$passwordHash' WHERE idIsuarios = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function actualizarPass()
    {
        $conexion = new Conexion();
        $passwordHash = password_hash($this->pass, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET password =  '$passwordHash' WHERE idUsuario = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function reestablecerPass()
    {
        $conexion = new Conexion();
        $this->pass = 'drugstore123';
        $passwordHash = password_hash($this->pass, PASSWORD_DEFAULT);
        $query = "UPDATE usuarios SET password = '$passwordHash' WHERE idUsuario = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE usuarios SET estado = 0 WHERE id = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function validarUsuario()
    {
        $conexion  = new Conexion();
        $query = "SELECT * FROM usuarios WHERE username = '$this->userName'";
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


    public function getIdUsuario()
    {
        return $this->idUsuario;
    }


    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

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

// $usuario = new Usuario($idUsuario = '', $userName = 'manusalinasfsa', $pass = 'hola123', $idEmpleado = '2', $iPerfiles = '1');
// $usuario->guardar();