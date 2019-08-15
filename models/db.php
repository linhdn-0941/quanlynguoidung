<?php 
    class db{
        private $strConnect = 'mysql:host=localhost;dbname=demo;charset=utf8';
        private static $instance;

        public static function Instance(){
            if(db::$instance == null){
                db::$instance = new db();
            }
            return db::$instance;
        }

        // SELECT tra ve mang
        public function ExcuteQuery($query, $paras = null){
            try {
                $connect = new PDO($this->strConnect, 'admin', 'Admin@123');
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $connect->prepare($query);
                $stmt->setFetchMode(PDO::FETCH_ASSOC);

                if($paras != null){
                    for ($i = 0; $i < count($paras); $i++) { 
                        $stmt->bindParam($i + 1, $paras[$i]);
                    }
                }

                $stmt->execute();
                $result = array();

                while ($row = $stmt->fetch()) {
                    array_push($result, $row);
                }

                return $result;

            } catch (PDOException $e) {
                echo $query . PHP_EOL . $e->getMessage();
            }
        }

        // Insert, update, delete
        public function ExcuteNonQuery($query, $paras = null){
            try {
                $connect = new PDO($this->strConnect, 'admin', 'Admin@123');
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $connect->prepare($query);

                if($paras != null){
                    for ($i = 0; $i < count($paras); $i++) { 
                        $stmt->bindParam($i + 1, $paras[$i]);
                    }
                }

                $result = $stmt->execute();
  
                return $result;

            } catch (PDOException $e) {
                echo $query . PHP_EOL . $e->getMessage();
            }
        }

        // SELECT tra ve object
        public function ExcuteScalaQuery($query, $paras = null){
            try {
                $connect = new PDO($this->strConnect, 'admin', 'Admin@123');
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $connect->prepare($query);
                $stmt->setFetchMode(PDO::FETCH_OBJ);

                if($paras != null){
                    for ($i = 0; $i < count($paras); $i++) { 
                        $stmt->bindParam($i + 1, $paras[$i]);
                    }
                }

                $stmt->execute();

                $result = $stmt->fetch();

                return $result;

            } catch (PDOException $e) {
                echo $query . PHP_EOL . $e->getMessage();
            }
        }
        
    }


    //echo db::Instance()->ExcuteNonQuery('INSERT INTO nguoidung(username, password, vaitro_id, hoten, ngaysinh, gioitinh) VALUES(?, ?, ?, ?, ?, ?)',
    //                                    array('admin@gmail.com', '123456', 1, 'Admin', '199-01-01', 1));
    //echo md5('123456');
    //print_r(db::Instance()->ExcuteScalaQuery('SELECT * FROM nguoidung WHERE username= ? AND password= ? ', array('admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e')));
?>