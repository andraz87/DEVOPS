<?php
// model/TerminDB.php
require_once("model/DBInit.php");
require_once "model/RedisInit.php";

class TerminDB {
    public static function getAll() {
        $redis = RedisInit::getInstance();
        $cacheKey = "termin_all"     ;

        $cached = $redis->get($cacheKey);
        if ($cached !== false) {
            return json_decode($cached, true);
        }


        $db = DBInit::getInstance();
        $stmt = $db->query("SELECT * FROM termin WHERE seIzvaja = TRUE  ORDER BY dan, zacetek");
        $result = $stmt->fetchAll();

        $redis->set($cacheKey, json_encode($result), 3600);
        return $result;
    }

    public static function insert($data) {
        $db = DBInit::getInstance();
        $stmt = $db->prepare("INSERT INTO termin (naslov, zacetek, konec, dan, lokacija, kapaciteta, seIzvaja)
                            VALUES (?, ?, ?, ?, ?, ?, TRUE)");
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
        $stmt = $db->prepare("UPDATE termin SET seIzvaja = FALSE WHERE id = ?");
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
