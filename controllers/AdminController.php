<?php
    namespace Controller;

    use Models\DataProvider;
    
    require_once('models/DataProvider.php');

    class AdminController
    {
        private static $instance;

        public static function getInstance()
        {
            if(is_null(AdminController::$instance)) {
                AdminController::$instance = new AdminController();
            }
            return AdminController::$instance;
        }

        public function __construct()
        {
            session_start();
            $user = $_SESSION['user'];
    
            if (!empty($user)) {
                if ($user->vaitro_id !== '1') {
                    header('Location: ?controller=user');
                }
            } else {
                header('Location: ?');
            }  
        }

        public function index()
        {
            $query = '
                SELECT nguoidung.id, nguoidung.username, nguoidung.hoten, nguoidung.ngaysinh, nguoidung.gioitinh, vaitro.vaitro 
                FROM nguoidung INNER JOIN vaitro 
                ON nguoidung.vaitro_id = vaitro.id
            ';
            $users = DataProvider::getInstance()->excuteQuery($query);
            require_once('views/admin/index.php');
        }

        public function create()
        {
            require_once('views/admin/create.php');
        }

        public function store()
        {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);
            $vaitro = $_POST['vaitro'];
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
                $parameters = [$username, md5($password), $vaitro, $hoten, $ngaysinh, $gioitinh];
                $result = DataProvider::getInstance()->excuteNonQuery($query, $parameters);

                if ($result) {
                    header('Location: ?controller=admin');
                } else {
                    echo 'Stored incorret';
                }
            } else {
                require_once('views/admin/create.php');
            }
        }

        public function edit($id)
        {
            $query = 'SELECT * FROM nguoidung WHERE id = ?';
            $parameters = [$id];
            $user = DataProvider::getInstance()->excuteScalarQuery($query, $parameters);
            require_once('views/admin/edit.php');
        }
        
        public function update($id)
        {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm_password']);
            $vaitro = $_POST['vaitro'];
            $hoten = trim($_POST['hoten']);
            $ngaysinh = $_POST['ngaysinh'];
            $gioitinh = $_POST['gioitinh'];
            
            $user = [
                'username' => $username,
                'password' => $password,
                'confirm_password' => $confirm_password,
                'hoten' => $hoten
            ];
            
            $errors = $this->validation($user, false);

            if (empty($errors)) {
                $query = '
                    UPDATE nguoidung SET username = ? ,password = ?, vaitro_id = ?, hoten = ?, ngaysinh = ?, gioitinh = ?
                    WHERE id = ?
                ';
                $parameters = [$username, md5($password), $vaitro, $hoten, $ngaysinh, $gioitinh, $id];
                $result = DataProvider::getInstance()->excuteNonQuery($query, $parameters);
        
                if ($result) {
                    header('Location: ?controller=admin');
                } else {
                    echo 'Updated incorret';
                }
            } else {
                $query = 'SELECT * FROM nguoidung WHERE id = ?';
                $parameters = [$id];
                $user = DataProvider::getInstance()->excuteScalarQuery($query, $parameters);
                require_once('views/admin/edit.php');
            }
        }

        public function destroy($id)
        {
            $query = 'DELETE FROM nguoidung WHERE id = ?';
            $parameters = [$id];
            $result = DataProvider::getInstance()->excuteNonQuery($query, $parameters);

            if ($result) {
                header('Location: ?controller=admin');
            } else {
                echo 'Destroy incorret';
            }
        }

        public function validation($user, $create = true){
            $errors = [];
            $patternPassword = '/^\S*(?=\S{6,255})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/';
            $patternHoten = '/[A-Za-zÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚÝàáâãèéêìíòóôõùúýĂăĐđĨĩŨũƠơƯưẠ-ỹ ]{6,255}/';

            if ($create) {
                if (!filter_var($user['username'], FILTER_VALIDATE_EMAIL)) {
                    $error = 'Username phải là email và lớn hơn 6 kí tự và nhỏ hơn 255  kí tự';
                    array_push($errors, $error);
                }
                if ($this->isExistUsername($user['username'])) {
                    $error = 'Username đã tồn tại';
                    array_push($errors, $error);
                }
            } 
            if (!preg_match($patternPassword, $user['password'])) {
                $error = 'Password phải có ký tự viết hoa, viết thường, chữ số và lớn hơn 6 kí tự và nhỏ hơn 255  kí tự';
                array_push($errors, $error);
            }
            if (!preg_match($patternPassword, $user['confirm_password'])) {
                $error = 'Confirm password phải có ký tự viết hoa, viết thường, chữ số và lớn hơn 6 kí tự và nhỏ hơn 255  kí tự';
                array_push($errors, $error);
            }
            if ($user['password'] !== $user['confirm_password']) {
                $error = 'Password không khớp';
                array_push($errors, $error);
            }
            if (!preg_match($patternHoten, $user['hoten'])) {
                $error = 'Họ tên phải lớn hơn 6 kí tự và nhỏ hơn 255  kí tự, không chứa sô';
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
