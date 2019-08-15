<?php 
    if($_GET['controller']){
        $controller = $_GET['controller'];
    }else{
        $controller = '';
    }

    if($_GET['action']){
        $action = $_GET['action'];
    }else{
        $action = '';
    }

    switch ($controller) {
        case 'value':
            # code...
            break;
        
        default:
            require_once('controllers/loginController.php');
            switch ($action) {
                case 'login':
                    loginController::Instance()->login();
                    break;

                case 'register':
                    loginController::Instance()->register()();
                    break;
                
                case 'store':
                    loginController::Instance()->store();
                    break;

                default:
                    loginController::Instance()->index();
                    break;
            }
            break;
    }
?>