<?php
session_start();

require_once("controller/UporabnikController.php");
require_once("controller/TerminController.php");
require_once("controller/PrisotnostController.php");
require_once("ViewHelper.php");

define("BASE_URL", rtrim(dirname($_SERVER["SCRIPT_NAME"]), "/") . "/index.php/");



// enostaven usmerjevalnik (router)
$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";
$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";




switch ($path) {

    // termini / domaca stran
    case "":
        UporabnikController::termin();
        break;
    case "login":
        UporabnikController::login();
        break;

    case "logout":
        UporabnikController::logout();
        break;

    case "prisotnost":
        UporabnikController::prisotnost();
        break;

    // termini
    case "prof":
        UporabnikController::prof();
        break;

    // dodaj termin
    case "dodaj":
        TerminController::dodaj();
        break;

    // uredi termin
    case "uredi":
        TerminController::uredi();
        break;
    case "izbrisi":
        TerminController::izbrisi();

    case "seznam":
        TerminController::seznam();
        break;
    case "prisotni":
        PrisotnostController::prisotni();
        break;




    default:
        http_response_code(404);
        echo "Stran ni najdena.";
        break;
}
