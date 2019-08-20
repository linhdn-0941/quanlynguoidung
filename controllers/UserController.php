<?php
    namespace Controller;

    use Models\DataProvider;
    
    require_once('models/DataProvider.php');

    class UserController
    {
        private static $instance;

        public static function getInstance()
        {
            if (is_null(UserController::$instance)) {
                UserController::$instance = new UserController();
            }

            return UserController::$instance;
        }
        
        public function __construct()
        {
            session_start();
            $user = $_SESSION['user'];
    
            if (empty($user)) {
                header('Location: ?');
            }
        }

        public function index()
        {
            session_start();
            $user = $_SESSION['user'];
            require_once('views/user/index.php');
        }
    }
