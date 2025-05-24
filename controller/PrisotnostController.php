<?php
require_once("model/PrisotnostDB.php");
require_once("ViewHelper.php");

class PrisotnostController {

public static function prisotni() {
    if (isset($_SESSION["user"]) && $_SESSION["user"]["tip_uporabnika"] === "profesor") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $terminID = $_POST["terminID"];
            $studenti = $_POST["studenti"] ?? [];


            foreach ($studenti as $studentId) {
                PrisotnostDB::dodajPrisotnost($studentId, $terminID);
                echo "Student ID: " . htmlspecialchars($studentId) . "<br>";
            }

            ViewHelper::redirect(BASE_URL . "prof");
        } else {
            $studenti = UporabnikDB::getStudenti();
            $terminID = $_GET["terminID"];
            $termin = TerminDB::get($terminID);

            ViewHelper::render("view/prisotnost.php", ["studenti" => $studenti, "terminID" => $terminID, "termin" => $termin]);
        }


    }else {
        ViewHelper::redirect(BASE_URL);
    }
}
    

}