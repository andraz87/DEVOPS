<?php
// controller/TerminController.php
require_once("model/TerminDB.php");

class TerminController {

    public static function seznam() {
        $termini = TerminDB::getAll();
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