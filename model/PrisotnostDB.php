<?php
require_once("model/DBInit.php");

class PrisotnostDB {
    public static function add($userId, $terminId, $datum) {
        $db = DBInit::getInstance();
        $stmt = $db->prepare("INSERT INTO prisotnost (uporabnik_id, termin_id, datum) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $terminId, $datum]);
    }

    public static function dodajPrisotnost($studentId, $terminID) {
        $db = DBInit::getInstance();
        $datum = date("Y-m-d H:i:s");
        $stmt = $db->prepare("INSERT INTO prisotnost (uporabnik_id, termin_id, datum) VALUES (?, ?, ?)");
        $stmt->execute([$studentId, $terminID, $datum]);
    }

} 