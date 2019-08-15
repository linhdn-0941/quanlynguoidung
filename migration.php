<?php 
    class migration{
        public function __construct(){
            try {
                $connect = new PDO('mysql:host=localhost; db', 'admin', 'Admin@123');
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $createDB = 'CREATE DATABASE IF NOT EXISTS demo';
                $use = 'use demo';

                $createNguoidung = '
                    CREATE TABLE IF NOT EXISTS `nguoidung` (
                        `id` int(11) PRIMARY KEY AUTO_INCREMENT,
                        `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                        `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                        `vaitro_id` tinyint(4) NOT NULL,
                        `hoten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
                        `ngaysinh` date NOT NULL,
                        `gioitinh` tinyint(4) NOT NULL
                    )
                ';
                
                $createVaitro = '
                    CREATE TABLE IF NOT EXISTS `vaitro` (
                        `id` int(11) PRIMARY KEY AUTO_INCREMENT,
                        `vaitro` varchar(255) COLLATE utf8_unicode_ci NOT NULL
                    )
                ';
                
                $addVaitro = "
                        INSERT INTO vaitro(vaitro) VALUES('ADMIN');
                        INSERT INTO vaitro(vaitro) VALUES('MEMBER');
                ";

                $addNguoidungs = "
                    INSERT INTO nguoidung(username, password, vaitro_id, hoten, ngaysinh, gioitinh)
                    VALUES('admin@gmail.com', '" . md5('123456') . "', 1, 'Nguyen Van Nam', '1992-04-01', 1);

                    INSERT INTO nguoidung(username, password, vaitro_id, hoten, ngaysinh, gioitinh)
                    VALUES('member@gmail.com','" . md5('123456') . "', 2, 'Hoang Hieu', '1990-04-01', 1);
                ";

                $connect->beginTransaction();

                $connect->exec($createDB);
                $connect->exec($use);
                $connect->exec($createVaitro);
                $connect->exec($createNguoidung);
                $connect->exec($addVaitro);
                $connect->exec($addNguoidungs);

            } catch (PDOException $e) {
                $dropDB = 'DROP DATABASE IF EXISTS demo';
                echo $e->getMessage();
            }

            $connect = null;
        }

    }
    new migration();
?>