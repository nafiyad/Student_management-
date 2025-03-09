<?php
// Start session if not already started
if(session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include controllers
require_once 'controllers/AuthController.php';
require_once 'controllers/StudentController.php';

// Get controller and action from URL
$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

// Route the request to the appropriate controller and action
switch($controller) {
    case 'auth':
        $authController = new AuthController();
        switch($action) {
            case 'register':
                $authController->register();
                break;
            case 'login':
                $authController->login();
                break;
            case 'logout':
                $authController->logout();
                break;
            default:
                $authController->login();
                break;
        }
        break;
    case 'student':
        $studentController = new StudentController();
        switch($action) {
            case 'index':
                $studentController->index();
                break;
            case 'create':
                $studentController->create();
                break;
            case 'delete':
                $studentController->delete();
                break;
            default:
                $studentController->index();
                break;
        }
        break;
    default:
        // Home page
        include 'views/home.php';
        break;
}
?> 