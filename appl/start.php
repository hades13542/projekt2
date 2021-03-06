<?php

/**
 * Class start obslugująca poczatkowy widok oraz zmianę widoków w zależności od wywołanej opcji z menu
 */
class start extends controller
{
    /**
     * @var view przechowuje aktualny widok
     */
    protected $layout;
    /**
     * @var
     */
    protected $model;

    /**
     * start constructor inicjalizuje poczatkowy widok oraz dodaje CSS
     */
    function __construct()
    {
        parent::__construct();
        $this->layout = new view('start');
        $this->layout->css = $this->css;
    }


    /**
     * @return view
     */
    function index()
    {
        $this->layout->content = '<p class="start">Strona startowa<br><br><a href="dokumentacja.pdf">Dokumentacja</a></p>';
        return $this->layout;
    }

    /**
     * Zmienia widok na formularz do logowania
     * @return view
     */
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

    /**
     * Zmienia widok na formularz do rejestracji
     * @return view
     */
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


    /**
     * Zmienia widok na formularz do dodawania zamówien
     * @return view
     */
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

    /**
     * Zmienia widok na tabelę z złożonymi zamowieniami, jeśli zalogowany. Jeśli użytkownik nie jest zalogowany wypisuje komunikat.
     * @return view
     */
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

    /**
     * Obsługuje wylogowanie użytkownika
     * @return view
     */
    function wyloguj()
    {
        $uzyt = new Uzytkownik();
        $uzyt->usunSesje();
        $this->layout->content = '<p class="start">Wylogowałeś się z systemu</p>';
        return $this->layout;
    }

}

?>
