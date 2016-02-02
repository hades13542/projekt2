<?php
include ("BazaDanych.php");
class baza  {

        function zapis(){
                $data=$_POST['data'];
                $dane=json_decode($data,$assoc=true);
                session_start();
                $wynik='';

                if(isset($_SESSION['ident'])){
                        $login=trim($_SESSION['ident']);
                        $db= new BazaDanych($login, 1);
                        $wynik=  $db->zapis($dane['nazwa'],$dane['ilosc'],$dane['wersja']);
                        


                }else{
                        $wynik=(isset($_SESSION['ident']) ? 'true':'false');
                        http_response_code(401);
                }
                print $wynik  ;
        }





}



?>
