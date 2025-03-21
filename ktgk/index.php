<?php
session_start();
require_once 'config/database.php';
require_once 'controllers/StudentController.php';
require_once 'controllers/CourseController.php';
require_once 'controllers/AuthController.php';

// Check if user is logged in
if (!isset($_SESSION['user_id']) && 
    (!isset($_GET['controller']) || $_GET['controller'] !== 'auth')) {
    header('Location: index.php?controller=auth&action=login');
    exit;
}

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'student';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch($controller) {
    case 'auth':
        $controller = new AuthController($conn);
        break;
    case 'course':
        $controller = new CourseController($conn);
        break;
    case 'registration':
        require_once 'controllers/RegistrationController.php';
        $controller = new RegistrationController($conn);
        break;
    default:
        $controller = new StudentController($conn);
        break;
}

switch($action) {
    case 'login':
        $controller->login();
        break;
    case 'logout':
        $controller->logout();
        break;
    case 'register':
        $controller->register();
        break;
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $controller->edit($id);
        break;
    case 'delete':
        $controller->delete($id);
        break;
    case 'detail':
        $controller->detail($id);
        break;
    default:
        $controller->index();
        break;
}
?>