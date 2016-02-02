<?php

class rejestracja extends controller {
        protected $layout ;

        function __construct() {
                parent::__construct() ;
                $this->layout = new view('rejestracja') ;
		
        }


        function success() {
				$this->layout=new view('start');
                $this->layout->content = '<p class="success">Zostałeś zarejestrowany</p>';
                return $this->layout ;
        }

        function failed(){
				$this->layout=new view('start');
                $this->layout->content = '<p class="failed">Nie udało się zarejestrować!</p>' ;
                return $this->layout ;
        }



}

?>
