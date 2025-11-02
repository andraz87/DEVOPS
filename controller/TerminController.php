<?php
// controller/TerminController.php
require_once("model/TerminDB.php");
require_once(__DIR__ . '/../service/RedisService.php');
require_once("model/UporabnikDB.php");

class TerminController {

    public static function seznam() {
        $cacheKey = 'termini_all';
        $termini = null;
        try {
            $termini = RedisService::get($cacheKey);
        } catch (\Exception $e) {
            $termini = null;
        }
        if ($termini === null) {
            $termini = TerminDB::getAll();
            try {
                RedisService::set($cacheKey, $termini, 300);
            } catch (\Exception $e) {
                // ignore cache errors
            }
        }
        ViewHelper::render("view/seznam.php", ["termini" => $termini]);
    }

    public static function dodaj() {
        if (isset($_SESSION["user"]) && $_SESSION["user"]["tip_uporabnika"] === "profesor") {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                "naslov" => $_POST["naslov"],
                "zacetek" => $_POST["zacetek"],
                "konec" => $_POST["konec"],
                "dan" => $_POST["dan"],
                "lokacija" => $_POST["lokacija"],
                "kapaciteta" => (int)$_POST["kapaciteta"]
            ];

            TerminDB::insert($data);
            // invalidate termini cache
            try { RedisService::delete('termini_all'); } catch (\Exception $e) {}
            ViewHelper::redirect("prof");
        } else {
            ViewHelper::render("view/dodaj.php");
        }
        } else {
            ViewHelper::redirect(BASE_URL);
        }
    }


    

    public static function izbrisi() {
        if (isset($_SESSION["user"]) && $_SESSION["user"]["tip_uporabnika"] === "profesor") {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $terminID = $_POST["termin_id"];
                TerminDB::del($terminID);
                UporabnikDB::setTerminNull($terminID);
                // invalidate termini cache
                try { RedisService::delete('termini_all'); } catch (\Exception $e) {}
            }
            ViewHelper::redirect(BASE_URL . "prof");
        }
        else {
            ViewHelper::redirect(BASE_URL);
        }
    }

    public static function uredi() {
        if (isset($_SESSION["user"]) && $_SESSION["user"]["tip_uporabnika"] === "profesor") {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = [
                "naslov" => $_POST["naslov"],
                "zacetek" => $_POST["zacetek"],
                "konec" => $_POST["konec"],
                "dan" => $_POST["dan"],
                "lokacija" => $_POST["lokacija"],
                "kapaciteta" => (int)$_POST["kapaciteta"],
                "terminID" => $_POST["terminID"]
            ];
            TerminDB::uredi($data);
            // invalidate termini cache
            try { RedisService::delete('termini_all'); } catch (\Exception $e) {}
            ViewHelper::redirect(BASE_URL . "prof");
        }
        else {
            $terminID = $_GET["terminID"];
            $data = TerminDB::get($terminID);
            ViewHelper::render("view/uredi.php", $data);
        }
    }
        else {
            ViewHelper::redirect(BASE_URL);
        }
    }
}