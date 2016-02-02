<?php
class BazaDanych{

        private $dsn = 'sqlite:../sql/' ;
        private $dbName;
		protected $db ;
		private $sth ;



         function sprawdz($login,$pass){
                        $p='haslo';
                        $query="SELECT haslo FROM uzytkownicy WHERE login="."'".$login."'";
                        $this->sth = $this->db->prepare($query);
                        $this->sth->execute();
                        $p=$this->sth->fetch() ;
                        if( $pass==$p['haslo'] && $login==$this->dbName){
                                        return true;
                        }
                        return false;
          }

		
		 function zapis($nazwa,$ilosc,$wersja){
                 $sprawdz=is_numeric($ilosc);
            
                # $sprawdz&=ctype_alpha($nazwa);

                 if($sprawdz){
                                $query='INSERT INTO zapis (login,nazwa,ilosc,wersja) VALUES (:login, :nazwa, :ilosc,:wersja);';
                                $this->sth = $this->db->prepare($query);
                                $this->sth->bindValue(':login',$this->dbName,PDO::PARAM_STR);
                                $this->sth->bindValue(':nazwa',$nazwa,PDO::PARAM_STR);
                                $this->sth->bindValue(':ilosc',$ilosc,PDO::PARAM_STR);
								$this->sth->bindValue(':wersja',$wersja,PDO::PARAM_STR);

                                $wynik = $this->sth->execute() ;
								if($wynik){
									$odpowiedz='<p class="start">Dodano zamówienie</p>';
								}else
									$odpowiedz='<p class="start">Nie udało się dodać danych do bazy danych!</p>';
                         
                         return $odpowiedz;
                }else{
                        return '<p class="start">Niepoprawne dane</p>';
                }
         }

		 function wypisywanie($login){
                $query="SELECT * FROM zapis WHERE login="."'".$login."'";
                $this->sth = $this->db->prepare($query);
                $this->sth->execute();
                $dane=$this->sth->fetchAll();
				$i=1;
				$tablica="";
                        if($dane){
                                $tablica.='<tr><td>Lp.</td><td>Nazwa</td><td>Ilość</td><td>Standard</td></tr>';
								foreach ($dane as $wiersz){
                                                $tablica.="<tr><td>".$i."</td><td>".$wiersz['nazwa']."</td><td>".$wiersz['ilosc']."</td><td>".$wiersz['wersja']."</td></tr>";
                                                $i+=1;
                                }

                        }else{
                                $tablica="<tr><td>Nie udalo się pobrać danych</td></tr>";
                        }
				return $tablica;
         }

         function sprawdzLogin($login){

                        $query="SELECT * FROM uzytkownicy WHERE login="."'".$login."'";
                        $this->sth = $this->db->prepare($query);
                        $this->sth->execute();

                        if( $this->sth->fetch() ){
                                        return false;
                        }
                        return true;

         }
		function dodaj($login,  $pass, $pass2){
                        $sprawdz=false;
						if($pass==$pass2){
							if($this->sprawdzLogin($login)){
                                $query = "INSERT INTO uzytkownicy (login,haslo) VALUES (:login, :haslo)";
                                $this->sth = $this->db->prepare($query);
                                $this->sth->bindValue(':login',$login,PDO::PARAM_STR);
                                $this->sth->bindValue(':haslo',$pass,PDO::PARAM_STR);
                                $sprawdz=$this->sth->execute();
							}
						}
					
			return $sprawdz;

         }



    function __construct($login, $warunek){
						
                        $this->dbName = $login;
						
                        if($warunek==0){
                                $this->db = new PDO ('sqlite:../sql/baza.db') ;
                                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
                        }else if($warunek==1){
                                $this->db = new PDO ('sqlite:sql/zapis.db') ;
								$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
						}
    }


}


?>


