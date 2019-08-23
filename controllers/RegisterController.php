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
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $hoten = trim($_POST['hoten']);
        $ngaysinh = $_POST['ngaysinh'];
        $gioitinh = $_POST['gioitinh'];

        $user = [
            'username' => $username,
            'password' => $password,
            'confirm_password' => $confirm_password,
            'hoten' => $hoten
        ];
        
        $errors = $this->validation($user);

        if (empty($errors)) {
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
            require_once('views/register.php');
        }
    }

    public function validation($user)
    {
        $errors = [];
        $patternPassword = '/^\S*(?=\S{6,255})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
        $patternHoten = '/[A-Za-zÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚÝàáâãèéêìíòóôõùúýĂăĐđĨĩŨũƠơƯưẠ-ỹ ]{6,255}/';
        
        if (!filter_var($user['username'], FILTER_VALIDATE_EMAIL)) {
            $error = 'Username phải phải là email và lớn hơn 6 kí tự và nhỏ hơn 255  kí tự';
            array_push($errors, $error);
        }
        if ($this->isExistUsername($user['username'])) {
            $error = 'Username đã tồn tại';
            array_push($errors, $error);
        }
        if (!preg_match($patternPassword, $user['password'])) {
            $error = 'Password phải có ký tự viết hoa, viết thường, chữ số và lớn hơn 6 và nhỏ hơn 255 kí tự';
            array_push($errors, $error);
        }
        if (!preg_match($patternPassword, $user['confirm_password'])) {
            $error = 'Confirm password phải có ký tự viết hoa, viết thường, chữ số và lớn hơn 6 và nhỏ hơn 255 kí tự';
            array_push($errors, $error);
        }
        if ($user['password'] !== $user['confirm_password']) {
            $error = 'Confirm password không khớp';
            array_push($errors, $error);
        }
        if (!preg_match($patternHoten, $user['hoten'])) {
            $error = 'Họ tên phải lớn hơn 6 kí tự và nhỏ hơn 255  kí tự, không chứa số';
            array_push($errors, $error);
        }

        return $errors;
    }

    public function isExistUsername($username)
    {
        $query = 'SELECT * FROM nguoidung WHERE username = ?';
        $parameters = [$username];

        $result = DataProvider::getInstance()->excuteScalarQuery($query, $parameters);

        if (empty($result)) {
            return false;
        }
        return true;
    }
}
