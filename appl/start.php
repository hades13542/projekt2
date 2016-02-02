<?php

class start extends controller
{
    protected $layout;
    protected $model;

    function __construct()
    {
        parent::__construct();
        $this->layout = new view('start');
        $this->layout->css = $this->css;
        $this->layout->menu = $this->menu;
    }


    function index()
    {
        $this->layout->content = '<p class="start">Strona startowa</p>';
        return $this->layout;
    }

    function logowanie()
    {
        if (file_exists('templates/logowanie.tpl')) {
            $szablon = file_get_contents('templates/logowanie.tpl');
        } else {
            $szablon = 'Nie można odnaleźć pliku! ';
        }
        $this->layout->content = $szablon;
        return $this->layout;
    }

    function rejestracja()
    {
        if (file_exists('templates/rejestracja.tpl')) {
            $szablon = file_get_contents('templates/rejestracja.tpl');
        } else {
            $szablon = 'Nie można odnaleźć pliku!';
        }

        $this->layout->content = $szablon;
        return $this->layout;
    }


    function zapis()
    {

        if (file_exists('templates/zapis.tpl')) {
            $szablon = file_get_contents('templates/zapis.tpl');
        } else {
            $szablon = 'Nie mozna odnaleźć pliku!';
        }
        $this->layout->content = $szablon;
        return $this->layout;
    }

    function wypisywanie()
    {

        session_start();
        $tablica = '<p class="start">Ostatnio zamówiłeś:</p>';
        $tablica .= '<table class="zamowienia">';

        if (isset($_SESSION['ident'])) {
            $login = trim($_SESSION['ident']);
            $db = new BazaDanych($login, 1);
            $tablica .= $db->wypisywanie($login);


        } else {
            $this->layout->content = "<p>Musisz się zalogować</p>";
            return $this->layout;
        }
        $tablica .= "</table>";


        $this->layout->content = $tablica;
        return $this->layout;

    }

    function wyloguj()
    {
        $uzyt = new Uzytkownik();
        $uzyt->usunSesje();
        $this->layout->content = '<p class="start">Wylogowałeś się z systemu</p>';
        return $this->layout;
    }

}

?>
