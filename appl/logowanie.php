<?php

/**
 * Obsluguje logowanie do serwisu, dziedziczy po controller
 * Class logowanie
 */
class logowanie extends controller {
    /**
     * @var view przechowuje widok
     */
        protected $layout ;

    /**
     * logowanie constructor.
     */
        function __construct() {
                parent::__construct() ;
                $this->layout = new view('logowanie') ;
		
        }

    /**
     * Wypisuje "Pomyslnie zalogowano!" po zalogowaniu poprawnymi danymi
     * @return view
     */
        function success() {
				$this->layout=new view('start');
                $this->layout->content = '<p class="success">Pomyślnie zalogowano!</p>';
                return $this->layout ;
        }

    /**
     * Wypisuje "Błędne hasło lub logowanie! Spróbuj ponownie." po podaniu błędnych danych
     * @return view
     */
        function failed(){
                $this->layout=new view('start');
                $this->layout->content = '<p class="failed">Błędne hasło lub logowanie! Spróbuj ponownie.</p>' ;
                return $this->layout ;
        }



}

?>
