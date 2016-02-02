<?php

function __autoload($class_name){
                include ( $class_name.'.php') ;
}

if(isset($_POST["submit"])){
        $usr = new Uzytkownik();
        $usr->logowanie($_POST["login"],$_POST["haslo"]);
        $sprawdz=$usr->ustawSesje();
        if($sprawdz){
                header("Location:../index.php?sub=logowanie&action=success");
        }else{
                header("Location:../index.php?sub=logowanie&action=failed");
        }

}else{
        header("Location:../index.php?sub=start&action=index");
}



?>
