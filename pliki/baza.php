<?php
include("BazaDanych.php");

/**
 * Class baza
 */
class baza
{

    /**
     *Fukcnja zapisująca podane dane z tabelii składania zamówień jeśli zalogowano, jeśli nie zwraca kod 401
     */
    function zapis()
    {
        $data = $_POST['data'];
        $dane = json_decode($data, $assoc = true);
        session_start();
        $wynik = '';

        if (isset($_SESSION['ident'])) {
            $login = trim($_SESSION['ident']);
            $db = new BazaDanych($login, 1);
            $wynik = $db->zapis($dane['nazwa'], $dane['ilosc'], $dane['wersja']);


        } else {
            $wynik = (isset($_SESSION['ident']) ? 'true' : 'false');
            http_response_code(401);
        }
        print $wynik;
    }


}
?>
