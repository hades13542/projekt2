<?php

class logowanie extends controller {
        protected $layout ;

        function __construct() {
                parent::__construct() ;
                $this->layout = new view('logowanie') ;
		
        }

        function success() {
				$this->layout=new view('start');
                $this->layout->content = '<p class="success">Pomyślnie zalogowano!</p>';
                return $this->layout ;
        }

        function failed(){
                $this->layout->content = '<p class="failed">Błędne hasło lub logowanie! Spróbuj ponownie.</p>' ;
                return $this->layout ;
        }



}

?>
