<?php
    namespace Controller;

    use Models\DataProvider;
    
    require_once('models/DataProvider.php');

    class RegisterController
    {
        private static $instance;

        public static function getInstance()
        {
            if (is_null(RegisterController::$instance)) {
                RegisterController::$instance = new RegisterController();
            }

            return RegisterController::$instance;
        }

        public function index()
        {
            require_once('views/register.php');
        }

        public function store()
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $hoten = $_POST['hoten'];
            $ngaysinh = $_POST['ngaysinh'];
            $gioitinh = $_POST['gioitinh'];

            if ($password == $confirm_password) {
                $query = '
                        INSERT INTO nguoidung(username, password, vaitro_id, hoten, ngaysinh, gioitinh) 
                        VALUES(?, ?, ?, ?, ?, ?)
                ';
                $parameters = [$username, md5($password), 2, $hoten, $ngaysinh, $gioitinh];
                $result = DataProvider::getInstance()->excuteNonQuery($query, $parameters);

                if ($result) {
                    echo 'Register corret';
                } else {
                    echo 'Register incorret';
                }
            } else {
                echo 'Password not match';
            }
        }
    }
