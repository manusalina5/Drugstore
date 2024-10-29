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
        $query = "INSERT INTO `usuario`
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
        $query = "UPDATE usuario SET username = '$this->userName', password =  '$passwordHash' WHERE idIsuarios = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function actualizarPass()
    {
        $conexion = new Conexion();
        $passwordHash = password_hash($this->pass, PASSWORD_DEFAULT);
        $query = "UPDATE usuario SET password =  '$passwordHash' WHERE idUsuario = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function reestablecerPass()
    {
        $conexion = new Conexion();
        $this->pass = 'drugstore123';
        $passwordHash = password_hash($this->pass, PASSWORD_DEFAULT);
        $query = "UPDATE usuario SET password = '$passwordHash' WHERE idUsuario = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function eliminar()
    {
        $conexion = new Conexion();
        $query = "UPDATE usuario SET estado = 0 WHERE idUsuario = '$this->idUsuario'";
        return $conexion->actualizar($query);
    }

    public function validarUsuario()
    {
        $conexion  = new Conexion();
        $query = "SELECT * FROM usuario WHERE username = '$this->userName'";
        return $conexion->consultar($query);
    }

    public function obtenerHash()
    {
        $conexion = new Conexion();
        $idUsuario = $this->idUsuario;
        $query = "SELECT password FROM usuario WHERE idUsuario = '$idUsuario'";
        $resultado = $conexion->consultar($query);
        $fila = $resultado->fetch_assoc();
        $hash = $fila['password'];
        return $hash;
    }

    // Funcion para listar los usuarios 

    public function obtenerUsuarios()
    {
        $conexion = new Conexion();
        $query = "SELECT idusuario, username, password, fechaalta, nombre
                    FROM usuario
                    LEFT JOIN perfiles ON perfiles.idperfiles = usuario.perfiles_idperfiles
                    WHERE usuario.estado = 1";
        $resultado = $conexion->consultar($query);
        $usuarios = [];
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $usuarios[] = $row;
            }
        }
        return $usuarios;
    }

    public function buscarUsuarios($busqueda, $inicio, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT u.username as username,
		u.fechaAlta as fechaAlta,
        p.nombre as perfil,
        pers.nombre as nombre,
        pers.apellido as apellido
			FROM usuario u
			LEFT JOIN perfiles p ON p.idperfiles = u.perfiles_idperfiles
			INNER JOIN empleado e ON e.idEmpleado = u.Empleado_idEmpleado
			INNER JOIN persona pers ON pers.idPersona = e.Persona_idPersona
			WHERE u.estado = 1 AND 
            (u.username LIKE '%$busqueda%' OR
            u.fechaAlta LIKE '%$busqueda%' OR
            p.nombre LIKE '%$busqueda%' OR
            pers.nombre LIKE '%$busqueda%' OR
            pers.apellido LIKE '%$busqueda%')
            LIMIT $inicio, $registro_por_pagina";
        $resultado = $conexion->consultar($query);
        $usuarios = array();
        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $usuarios[] = $row;
            }
            return $usuarios;
        }
    }

    public static function totalPaginasBusqueda($busqueda, $registro_por_pagina)
    {
        $conexion = new Conexion();
        $query = "SELECT COUNT(*)
			FROM usuario u
			LEFT JOIN perfiles p ON p.idperfiles = u.perfiles_idperfiles
			INNER JOIN empleado e ON e.idEmpleado = u.Empleado_idEmpleado
			INNER JOIN persona pers ON pers.idPersona = e.Persona_idPersona
			WHERE u.estado = 1 AND 
            (u.username LIKE '%$busqueda%' OR
            u.fechaAlta LIKE '%$busqueda%' OR
            p.nombre LIKE '%$busqueda%' OR
            pers.nombre LIKE '%$busqueda%' OR
            pers.apellido LIKE '%$busqueda%')";
        $resultado = $conexion->consultar($query);
        $total_registros = $resultado->fetch_array()[0];
        $total_paginas = ceil($total_registros / $registro_por_pagina);
        return $total_paginas;
    }

    public function obtenerIdEmpleado($idUsuario)
    {
        $conexion = new Conexion;
        $query = "SELECT Empleado_idEmpleado
                    FROM usuario
                    WHERE idUsuario = $idUsuario";
        $resultado = $conexion->consultar($query);
        $id = $resultado->fetch_array()[0];
        return $id;
    }

    public static function obtenerUserName($idEmpleado){
        $conexion = new Conexion;
        $query = "SELECT username FROM usuario WHERE Empleado_idEmpleado = $idEmpleado";
        $resultado = $conexion->consultar($query);
        $username = $resultado->fetch_array()[0];
        return $username;
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