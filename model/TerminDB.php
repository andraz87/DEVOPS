<?php
// model/TerminDB.php
require_once("model/DBInit.php");

class TerminDB {
    public static function getAll() {
        $db = DBInit::getInstance();
        $stmt = $db->query("SELECT * FROM termin");
        return $stmt->fetchAll();
    }

    public static function insert($data) {
        $db = DBInit::getInstance();
        $stmt = $db->prepare("INSERT INTO termin (naslov, zacetek, konec, dan, lokacija, kapaciteta) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data["naslov"],
            $data["zacetek"],
            $data["konec"],
            $data["dan"],
            $data["lokacija"],
            $data["kapaciteta"]
        ]);
    }

    public static function del($terminID) {
        $db = DBInit::getInstance();
        $stmt = $db->prepare("DELETE FROM termin WHERE id = ?");
        $stmt->execute([$terminID]);
    }


    public static function prostaMesta($termin_id) {
        $db = DBInit::getInstance();

        $stmt = $db->prepare("SELECT kapaciteta - (
            SELECT COUNT(*) FROM uporabnik WHERE termin_id = ?
        ) AS prosta_mesta FROM termin WHERE id = ?");
        
        $stmt->execute([$termin_id, $termin_id]);
        return $stmt->fetchColumn();
    }

    public static function uredi($data) {
                $db = DBInit::getInstance();
        $stmt = $db->prepare("UPDATE termin 
            SET naslov = ?, zacetek = ?, konec = ?, dan = ?, lokacija = ?, kapaciteta = ? 
            WHERE id = ?");
        $stmt->execute([
            $data["naslov"],
            $data["zacetek"],
            $data["konec"],
            $data["dan"],
            $data["lokacija"],
            $data["kapaciteta"],
            $data["terminID"]
        ]);
    }

    public static function get($terminID) {
    $db = DBInit::getInstance();
    $stmt = $db->prepare("SELECT * FROM termin WHERE id = ?");
    $stmt->execute([$terminID]);
    return $stmt->fetch();
}





}