<?php
    namespace Controller;

    use Models\DataProvider;
    require_once('models/DataProvider.php');

    class LoginController
    {
        private static $instance;

        public static function getInstance()
        {
            if (is_null(LoginController::$instance)) {
                LoginController::$instance = new LoginController();
            }

            return LoginController::$instance;
        }

        public function index()
        {
            require_once('views/login.php');
        }

        public function login()
        {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $query = 'SELECT * FROM nguoidung WHERE username = ? AND password = ?';
            $parameters = [$username, $password];

            $user = DataProvider::getInstance()->excuteScalarQuery($query, $parameters);

            if (!empty($user)) {
                session_start();
                $_SESSION['user'] = $user;
                if ($user->vaitro_id === '1') {
                    header('Location: ?controller=admin');
                } else {
                    header('Location: ?controller=user');
                }
            } else {
                echo 'login incorret';
            }
        }
    }
