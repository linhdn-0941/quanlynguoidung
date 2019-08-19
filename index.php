<?php
    use Controller\AdminController;
    use Controller\LoginController;
    use Controller\RegisterController;

    require_once('controllers/AdminController.php');
    require_once('controllers/LoginController.php');
    require_once('controllers/RegisterController.php');

    if ($_GET['controller']) {
        $controller = $_GET['controller'];
    } else {
        $controller = '';
    }

    if ($_GET['action']) {
        $action = $_GET['action'];
    } else {
        $action = '';
    }

    switch ($controller) {
        case 'admin':
            switch ($action) {
                case 'create':
                    AdminController::getInstance()->create();
                    break;

                case 'edit':
                    $id = $_GET['id'];
                    AdminController::getInstance()->edit($id);
                    break;

                default:
                    AdminController::getInstance()->index();
                    break;
            }
            break;

        case 'register':
            switch ($action) {
                case 'store':
                    RegisterController::getInstance()->store();
                    break;

                default:
                    RegisterController::getInstance()->index();
                    break;
            }
            break; 

        default:
            switch ($action) {
                case 'login':
                    LoginController::getInstance()->login();
                    break;

                default:
                    LoginController::getInstance()->index();
                    break;
            }
            break;
    }
