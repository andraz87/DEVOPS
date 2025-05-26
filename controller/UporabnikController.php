<?php
// controller/UporabnikController.php
require_once("model/UporabnikDB.php");

class UporabnikController {

public static function login() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = UporabnikDB::getByUsername($_POST["username"]);
        $password = $_POST["password"];

        if ($user && $password === $user["geslo"]) {
            $_SESSION["user"] = $user;

            if ($user["tip_uporabnika"] === "profesor") {
                ViewHelper::redirect(BASE_URL . "prof");
            } else {
                ViewHelper::redirect(BASE_URL);
            }
        } else {
            ViewHelper::render("view/login-form.php", [
                "errorMessage" => "Napačno uporabniško ime ali geslo."
            ]);
        }
    } else {
        ViewHelper::render("view/login-form.php", []);
    }
}

    public static function logout() {
        session_destroy();
        ViewHelper::redirect(".");
    }

    public static function termin() {

        $terminId = $_POST["termin_id"] ?? null;
        
        if (isset($_SESSION["user"])) {
            $user = $_SESSION["user"];
            if ($user["tip_uporabnika"] === "student") {
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (TerminDB::prostaMesta($terminId) > 0) {
                    
                    $uporabnikId = $_SESSION["user"]["id"];
                    $terminId = $_POST["termin_id"];
                    UporabnikDB::updateTermin($uporabnikId, $terminId);
                    $_SESSION["user"] = UporabnikDB::getByUsername($user["uporabnisko_ime"]);
                    }
                    else {
                        $username = $_SESSION["user"]["uporabnisko_ime"];
                        $termini = TerminDB::getAll();
                        ViewHelper::render("view/home-page.php", [
                            "username" => $username,
                            "termini" => $termini,
                            "errorMessage" => "Ni več prostih mest za ta termin."
                        ]);
                        return;
                    }
                }
                $termini = TerminDB::getAll();
                $username = $_SESSION["user"]["uporabnisko_ime"];
                ViewHelper::render("view/home-page.php", ["termini" => $termini, "username" => $username]);
            }
            else {
                ViewHelper::redirect(BASE_URL . "prof");
            }
        }
        else {
            ViewHelper::redirect(BASE_URL . "login");
        }
    }


    public static function prof() {
        if (isset($_SESSION["user"])) {
            $user = $_SESSION["user"];
            if ($user["tip_uporabnika"] === "profesor") {
                $termini = TerminDB::getAll();
                $username = $_SESSION["user"]["uporabnisko_ime"];
                ViewHelper::render("view/prof.php" , ["termini" => $termini, "username"=> $username]);
            }
            else {
                ViewHelper::redirect(BASE_URL);
            }
        }
        else {
            ViewHelper::redirect(BASE_URL . "login");
        }
    }

    public static function prisotnost() {
        ViewHelper::render("view/prisotnost-form.php");
    }

    public static function registracija() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $ime = $_POST["ime"];
            $priimek = $_POST["priimek"];
            $tip_uporabnika = $_POST["tip_uporabnika"];

            if (UporabnikDB::getByUsername($username)) {
                ViewHelper::render("view/registracija-form.php", [
                    "errorMessage" => "Uporabniško ime že obstaja."
                ]);
            } else {
                UporabnikDB::create($username, $password, $ime, $priimek, $tip_uporabnika);
                ViewHelper::redirect(BASE_URL . "login");
            }
        } else {
            ViewHelper::render("view/registracija.php", []);
        }
    }

}   
