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
        if (empty($_POST['nombre_usuario']) || empty($_POST['pass'])) {
            header('Location: ../../index.php?mensaje=Complete todos los campos&status=warning');
            exit;
        }

        $username = trim($_POST['nombre_usuario']);
        $password = $_POST['pass'];

        $usuario = new Usuario();
        $perfil = new Perfil();

        $usuario->setUserName($username);
        $resultado = $usuario->validarUsuario();

        if ($resultado->num_rows === 0) {
            $this->redirigirConError('Usuario o password no correcto');
        }

        $datosUsuario = $resultado->fetch_assoc();

        if (!password_verify($password, $datosUsuario['password'])) {
            $this->redirigirConError('Usuario o password no correcto');
        }

        if (password_verify('drugstore123', $datosUsuario['password'])) {
            $this->redirigirAActualizacion($datosUsuario);
        }

        // Login exitoso: inicializar sesión
        $_SESSION['nombre_usuario'] = $datosUsuario['username'];
        $_SESSION['user_id'] = $datosUsuario['idUsuario'];

        $perfilData = $perfil->obtenerPerfilesPorId($datosUsuario['perfiles_idperfiles']);
        $_SESSION['idPerfil'] = $perfilData['idPerfiles'];
        $_SESSION['nombre_perfil'] = $perfilData['nombre'];

        $idEmpleado = $usuario->obtenerIdEmpleado($datosUsuario['idUsuario']);
        $_SESSION['idEmpleado'] = $idEmpleado;

        header('Location: ../../index.php');
        exit;
    }

    // Función auxiliar para redirigir con error
    private function redirigirConError($mensaje)
    {
        header('Location: ../../index.php?mensaje=' . urlencode($mensaje) . '&status=danger');
        exit;
    }

    // Función auxiliar para redirigir al cambio de contraseña
    private function redirigirAActualizacion($usuario)
    {
        echo '<form id="redirectForm" method="POST" action="../../index.php?page=actualizar_pass&modulo=usuarios">';
        echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($usuario['idUsuario']) . '">';
        echo '<input type="hidden" name="username" value="' . htmlspecialchars($usuario['username']) . '">';
        echo '<input type="hidden" name="mensaje" value="Debe actualizar la contraseña">';
        echo '<input type="hidden" name="status" value="warning">';
        echo '</form>';
        echo '<script>document.getElementById("redirectForm").submit();</script>';
        exit;
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
