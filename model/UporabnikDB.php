<?php
// model/UporabnikDB.php
require_once("model/DBInit.php");

class UporabnikDB {
    public static function getByUsername($username) {
        $db = DBInit::getInstance();

        $stmt = $db->prepare("SELECT * FROM uporabnik WHERE uporabnisko_ime = ?");
        $stmt->execute([$username]);

        return $stmt->fetch();
    }

    public static function updateTermin($uporabnikId, $novTerminId) {
    $db = DBInit::getInstance();
    $stmt = $db->prepare("UPDATE uporabnik SET termin_id = ? WHERE id = ?");
    $stmt->execute([$novTerminId, $uporabnikId]);
}

    public static function getTermin($uporabnikId) {
        $db = DBInit::getInstance();
        $stmt = $db->prepare("SELECT termin_id FROM uporabnik WHERE id = ?");
        $stmt->execute([$uporabnikId]);
        return $stmt->fetchColumn();
    }

    public static function getAll() {
        $db = DBInit::getInstance();
        $stmt = $db->query("SELECT * FROM uporabnik");
        return $stmt->fetchAll();
    }

    public static function steviloPrisotnosti($uporabnikId) {
        $db = DBInit::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM prisotnost WHERE uporabnik_id = ?");
        $stmt->execute([$uporabnikId]);
        return $stmt->fetchColumn();
    }

        public static function getStudenti() {
        $db = DBInit::getInstance();
        $stmt = $db->query("SELECT * FROM uporabnik WHERE tip_uporabnika = 'student'");
        return $stmt->fetchAll();
    }

        public static function setTerminNull($terminId) {
        $db = DBInit::getInstance();
        $stmt = $db->prepare("UPDATE uporabnik SET termin_id = NULL WHERE termin_id = ?");
        $stmt->execute([$terminId]);
    }

}