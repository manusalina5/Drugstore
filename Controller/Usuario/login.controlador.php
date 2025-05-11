<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../../Model/Usuario/usuarios.php';
include_once '../../Model/Usuario/perfiles.php';
include_once '../../config/conexion.php';

session_start();

if (isset($_POST['action'])) {
    $login_controller = new LoginControlador();
    if ($_POST['action'] == 'login') {
        $login_controller->ingresar();
    }
}

if (isset($_GET['action'])) {
    $login_controller = new LoginControlador();
    switch ($_GET['action']) {
        case 'verificarUsuario':
            $login_controller->verificarUsuario();
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
            break;
    }
}

class LoginControlador
{
    public function ingresar()
    {
        $usuario = new Usuario();
        $perfil = new Perfil();
        $usuario->setUserName($_POST['nombre_usuario']);
        $resultado = $usuario->validarUsuario();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                if (password_verify($_POST['pass'], $row['password'])) {
                    if (password_verify('drugstore123', $row['password'])) {
                        // Redirigir a la página de actualización de contraseña con un formulario POST
                        echo '<form id="redirectForm" method="POST" action="../../index.php?page=actualizar_pass&modulo=usuarios">';
                        echo '<input type="hidden" name="user_id" value="' . $row['idUsuario'] . '">';
                        echo '<input type="hidden" name="username" value="' . $row['username'] . '">';
                        echo '<input type="hidden" name="mensaje" value="Debe actualizar la contraseña">';
                        echo '<input type="hidden" name="status" value="warning">';
                        echo '</form>';
                        echo '<script type="text/javascript">document.getElementById("redirectForm").submit();</script>';
                        exit;
                    } else {
                        // Inicializar variables de sesión si la contraseña no es la predeterminada
                        $_SESSION['nombre_usuario'] = $row['username'];
                        $perfilData = $perfil->obtenerPerfilesPorId($row['perfiles_idperfiles']);
                        $_SESSION['idPerfil'] = $perfilData['idPerfiles'];
                        $_SESSION['nombre_perfil'] = $perfilData['nombre'];
                        $_SESSION['user_id'] = $row['idUsuario'];
                        $idEmpleado = $usuario->obtenerIdEmpleado($row['idUsuario']);
                        $_SESSION['idEmpleado'] = $idEmpleado;
                        header('Location: ../../index.php');
                        exit;
                    }
                } else {
                    header('Location: ../../index.php?mensaje=Usuario o password no correcto&status=danger');
                    exit;
                }
            }
        } else {
            header('Location: ../../index.php?mensaje=Usuario o password no correcto&status=danger');
            exit;
        }
    }

    public function verificarUsuario()
    {
        $data = json_decode(file_get_contents("php://input"), true);



        if (!isset($data['nombre_usuario']) || empty($data['nombre_usuario'])) {
            echo json_encode(['success' => false, 'message' => 'El nombre de usuario es obligatorio']);
            return;
        }

        $usuario = new Usuario();
        $usuario->setUserName($data['nombre_usuario']);
        $resultado = $usuario->validarUsuario();

        if ($resultado->num_rows > 0) {
            echo json_encode(['success' => true, 'message' => 'Usuario válido']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Usuario no encontrado']);
        }
    }
}
