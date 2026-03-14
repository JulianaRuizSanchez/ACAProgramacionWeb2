<?php
require_once 'config/database.php';
require_once 'models/Usuario.php';

class LoginController {
    
    // Muestra la vista del login
    public function index() {
        require_once 'views/login/index.php';
    }

    // Procesa el formulario
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = (new Database())->getConnection();
            $usuario = new Usuario($db);
            
            $correo = $_POST['correo'] ?? '';
            $password = $_POST['password'] ?? '';
            
            $auth = $usuario->autenticar($correo, $password);
            
            if($auth) {
                // Inicia sesión y guardar datos del usuario
                session_start();
                $_SESSION['usuario_id'] = $auth['id'];
                $_SESSION['usuario_nombre'] = $auth['nombre'];
                
                // Redirige al sistema (CRUD)
                header("Location: index.php");
                exit();
            } else {
                // Si falla, se devuelve al login con una variable de error
                header("Location: ?controller=login&action=index&error=1");
                exit();
            }
        }
    }

    // Cierra la sesión
    public function logout() {
        session_start();
        session_destroy();
        header("Location: ?controller=login&action=index");
        exit();
    }
}
?>