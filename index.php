<?php
// Enrutador Principal
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Se inicia el motor de sesiones de PHP
session_start();

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'paciente';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Sistema de seguridad (Protección de Rutas)
// Si no hay un ID de usuario en la sesión Y el controlador no es el "login", se bloquea.
if (!isset($_SESSION['usuario_id']) && $controller !== 'login') {
    header("Location: ?controller=login&action=index");
    exit();
}

// Se construye el nombre del archivo del controlador y la clase
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = 'controllers/' . $controllerName . '.php';

// Se verifica si el archivo del controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Se instancia el controlador
    $controllerInstance = new $controllerName();
    
    // Se verifica si el método (acción) existe dentro del controlador
    if (method_exists($controllerInstance, $action)) {
        // Se ejecuta la acción (ej: index, crear, guardar)
        $controllerInstance->$action();
    } else {
        // Si la acción no existe, se muestra un error
        echo "Error: La acción '$action' no existe en el controlador '$controllerName'.";
    }
} else {
    // Si el archivo del controlador no existe, se muestra un error
    echo "Error: El controlador '$controllerName' no existe.";
}
?>