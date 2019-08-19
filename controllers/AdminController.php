<?php
    namespace Controller;

    use Models\DataProvider;
    require_once('models/DataProvider.php');

    class AdminController
    {
        private static $instance;

        public static function getInstance(){
            if(AdminController::$instance == null){
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

        }

        public function edit($id)
        {
            $query = '
                SELECT * FROM nguoidung WHERE id = ?
            ';
            $parameters = array($id);
            $user = DataProvider::getInstance()->excuteScalaQuery($query, $parameters);
            print_r($user);
        }

        public function update()
        {

        }

        public function destroy()
        {

        }
    }
?>
