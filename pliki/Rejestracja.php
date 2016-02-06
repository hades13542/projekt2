<?php

/**
 * Klasa odpowiedzialna za rejestracje nowego uzytkownika, podbierajac dane z metody post oraz wyswietlanie komunikatu zwrotnego
 * @param $class_name
 */
function __autoload($class_name)
{
    include($class_name . '.php');
}


if (isset($_POST["submit"])) {

    $usr = new Uzytkownik();

    $sprawdz = $usr->rejestracja($_POST["login"], $_POST["haslo"], $_POST["haslo2"]);
    if ($sprawdz) {
        header("Location:../index.php?sub=rejestracja&action=success");
    } else {
        header("Location:../index.php?sub=rejestracja&action=failed");
    }

} else {
    header("Location:../index.php?sub=start&action=index");
}
