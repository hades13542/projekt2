<?php

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
