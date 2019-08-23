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
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $user = ['username' => $username, 'password' => $password];

        $errors = $this->validation($user);

        if (empty($errors)) {
            $query = 'SELECT * FROM nguoidung WHERE username = ? AND password = ?';
            $parameters = [$username, md5($password)];

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
                $errorLogin = 'Username or password incorret';
                require_once('views/login.php');
            }
        } else {
            require_once('views/login.php');
        }
    }

    public function logout()
    {
        session_start();
        $user = $_SESSION['user'];

        if (!empty($user)) {
            unset($_SESSION['user']);
            header('Location: ?');
        }
    }

    public function validation($user)
    {
        $errors = [];
        $patternPassword = '/^[\w]{6,255}$/';

        if (!filter_var($user['username'], FILTER_VALIDATE_EMAIL)) {
            $error = 'Username phải phải là email';
            array_push($errors, $error);
        }
        if (!preg_match($patternPassword, $user['password'])) {
            $error = 'Password phải lớn hơn 6 và nhỏ hơn 255 kí tự';
            array_push($errors, $error);
        }

        return $errors;
    }
}
