<?php
class DBInit {
    public static function getInstance() {
        static $db = null;
        static $MYSQL_HOST = getenv('MYSQL_HOST') ?: 'localhost';

        if ($db === null) {
            $dsn = "mysql:host=$MYSQL_HOST;dbname=dn3;charset=utf8mb4";
            $user = "root";
            $password = getenv('MYSQL_ROOT_PASSWORD') ?: '';
            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];

            try {
                $db = new PDO($dsn, $user, $password, $options);
            } catch (PDOException $e) {
                echo "Napaka pri povezavi z bazo: " . $e->getMessage();
                exit();
            }
        }

        return $db;
    }
}
