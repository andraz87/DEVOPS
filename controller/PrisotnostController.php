<?php
require_once("model/PrisotnostDB.php");
require_once("ViewHelper.php");
require_once(__DIR__ . '/../service/RedisService.php');

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
            $terminID = $_GET["terminID"] ?? null;

            // students on and off the term
            $studentiNaTerminu = UporabnikDB::uporabnikiNaTerminu($terminID);
            $studentiKiNisoNaTerminu = UporabnikDB::uporabnikiKiNisoNaTerminu($terminID);

            // Try to get termin from cache
            $termin = null;
            $cacheKey = 'termin_' . $terminID;
            try {
                $termin = RedisService::get($cacheKey);
            } catch (\Exception $e) {
                $termin = null;
            }
            if ($termin === null) {
                $termin = TerminDB::get($terminID);
                try { RedisService::set($cacheKey, $termin, 300); } catch (\Exception $e) {}
            }

            ViewHelper::render("view/prisotnost.php", ["studentiNaTerminu" =>  $studentiNaTerminu,"studentiKiNisoNaTerminu" => $studentiKiNisoNaTerminu , "terminID" => $terminID, "termin" => $termin]);
        }


    }else {
        ViewHelper::redirect(BASE_URL);
    }
}
    

}