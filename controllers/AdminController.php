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
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $vaitro = $_POST['vaitro'];
            $hoten = $_POST['hoten'];
            $ngaysinh = $_POST['ngaysinh'];
            $gioitinh = $_POST['gioitinh'];

            if ($password == $confirm_password) {
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
                echo 'Password not match';
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
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $vaitro = $_POST['vaitro'];
            $hoten = $_POST['hoten'];
            $ngaysinh = $_POST['ngaysinh'];
            $gioitinh = $_POST['gioitinh'];
            
            if ($password == $confirm_password) {
                $query = '
                        UPDATE nguoidung SET username = ? , password = ?, vaitro_id = ?, hoten = ?, ngaysinh = ?, gioitinh = ?
                        WHERE id = ?
                ';
                $parameters = [$username, md5($password), $vaitro, $hoten, $ngaysinh, $gioitinh, $id];
                $result = DataProvider::getInstance()->excuteNonQuery($query, $parameters);
       
                if ($result) {
                    header('Location: ?controller=admin');
                } else {
                    echo 'updated incorret';
                }
            } else {
                echo 'Password not match';
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
                echo 'updated incorret';
            }
            
        }
    }
?>
