<?php

class ViewHelper {

    // Render funkcija: vključi HTML/PHP view datoteko in preda spremenljivke
    public static function render($viewPath, $variables = []) {
        extract($variables);   // ključ 'ime' postane $ime itd.
        include($viewPath);    // npr. "view/termin-list.php"
    }

    // Redirect funkcija: preusmeri uporabnika na drug URL
    public static function redirect($url) {
        header("Location: " . $url);
        exit();  // končaj izvajanje skripte
    }
}
