<?php
    namespace Models;
    
    use PDO;
    use PDOException;

    class DataProvider
    {
        private $connectString = 'mysql:host=localhost;dbname=demo;charset=utf8';
        private static $instance;
        
        public static function getInstance()
        {
            if(DataProvider::$instance == null){
                DataProvider::$instance = new DataProvider();
            }
            return DataProvider::$instance;
        }

        public function excuteQuery($query, $parameters = null)
        {
            try {
                $connect = new PDO($this->connectString, 'admin', 'Admin@123');
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $statement = $connect->prepare($query);
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                if ($parameters != null) {
                    for ($i = 0; $i < count($parameters); $i++) { 
                        $statement->bindParam($i + 1, $parameters[$i]);
                    }
                }

                $statement->execute();
                $result = [];

                while ($item = $statement->fetch()) {
                    array_push($result, $item);
                }

                return $result;
            } catch (PDOException $e) {
                echo $query . PHP_EOL . $e->getMessage();
            }
        }

        public function excuteNonQuery($query, $parameters = null)
        {
            try {
                $connect = new PDO($this->connectString, 'admin', 'Admin@123');
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $connect->prepare($query);

                if ($parameters != null) {
                    for ($i = 0; $i < count($parameters); $i++) { 
                        $statement->bindParam($i + 1, $parameters[$i]);
                    }
                }

                $result = $statement->execute();

                return $result;
            } catch (PDOException $e) {
                echo $query . PHP_EOL . $e->getMessage();
            }
        }

        public function excuteScalarQuery($query, $parameters = null)
        {
            try {
                $connect = new PDO($this->connectString, 'admin', 'Admin@123');
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $statement = $connect->prepare($query);
                $statement->setFetchMode(PDO::FETCH_OBJ);

                if ($parameters != null) {
                    for ($i = 0; $i < count($parameters); $i++) { 
                        $statement->bindParam($i + 1, $parameters[$i]);
                    }
                }

                $statement->execute();
                $result = $statement->fetch();

                return $result;
            } catch (PDOException $e) {
                echo $query . PHP_EOL . $e->getMessage();
            }
        }
    }
