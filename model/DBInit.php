<?php
class DBInit {
    public static function getInstance() {
        static $db = null;

        if ($db === null) {
            $dsn = "mysql:host=localhost;dbname=dn3;charset=utf8";
            $user = "root";
            $password = "";

            try {
                $db = new PDO($dsn, $user, $password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Napaka pri povezavi z bazo: " . $e->getMessage();
                exit();
            }
        }

        return $db;
    }
}
