<?php 
    class loginController{
        private static $instance;

        public static function Instance(){
            if (loginController::$instance == null) {
                loginController::$instance = new loginController();
            }

            return loginController::$instance;
        }
        public function __construct()
        {
            require_once('models/db.php');
        }

        public function index(){
            require_once('views/login.php');
        }

        public function login(){
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            $query = '
                SELECT * FROM nguoidung WHERE nguoidung.username = ? AND nguoidung.password = ?
            ';
            $paras = array($username, $password);

            $result = db::Instance()->ExcuteScalaQuery($query, $paras);

            if (!empty($result)) {
                session_start();
                $_SESSION['user'] = $result;

                if ($result->vaitro_id == 1) {
                    require_once('views/admin/index.php');
                }else{
                    echo 'member';
                }
            } else {
                echo 'login incorret';
            }
        }

        public function register(){
            require_once('views/register.php');
        }

        public function store(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $hoten = $_POST['hoten'];
            $ngaysinh = $_POST['ngaysinh'];
            $gioitinh = $_POST['gioitinh'];

            if ($password == $confirm_password) {
                $query = '
                    INSERT INTO nguoidung(username, password, vaitro_id, hoten, ngaysinh, gioitinh) VALUES(?, ?, ?, ?, ?, ?)
                ';
                $paras = array($username, md5($password), 2, $hoten, $ngaysinh, $gioitinh);
                $result = db::Instance()->ExcuteNonQuery($query, $paras);

                if($result == 1){
                    echo 'Register corret';
                }else{
                    echo 'Register incorret';
                }
            }else{
                echo 'Password not match';
            }
        }
    }
?>