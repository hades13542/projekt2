<?php

/**
 * Klasa odpowiedzialna za logowanie nowego uzytkownika, podbierajac dane z metody post oraz wyswietlanie komunikatu zwrotnego
 * Tworzy nową sesje dla uzytkownika
 * @param $class_name
 */
function __autoload($class_name)
{
    include($class_name . '.php');
}

if (isset($_POST["submit"])) {
    $usr = new Uzytkownik();
    $usr->logowanie($_POST["login"], $_POST["haslo"]);
    $sprawdz = $usr->ustawSesje();
    if ($sprawdz) {
        header("Location:../index.php?sub=logowanie&action=success");
    } else {
        header("Location:../index.php?sub=logowanie&action=failed");
    }

} else {
    header("Location:../index.php?sub=start&action=index");
}


?>
