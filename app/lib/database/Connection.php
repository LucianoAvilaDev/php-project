<?php

    abstract class Connection{
        private static $conn;
        public static function getConnection(){
            if(self::$conn == null){
                self::$conn = new PDO('mysql: host=localhost; dbname=php-project;', 'root', '');
            }

            return self::$conn;
        }
    }