<?php 
    @session_start();
    include("../config/konekcija.php");

    if(isset($_POST['mail'])){
        $mejl = $_POST["mail"];
        $lozinka = $_POST["password"];
      
        $upit = "SELECT * FROM korisnik k JOIN uloga u ON k.id_uloga = u.id_uloga where mail = :mejl";
        $stm = $konekcija -> prepare($upit);
        $stm -> bindParam(":mejl", $mejl);
        $stm->execute();
        $rezultat = $stm->fetch();
        
        //var_dump($rezultat);
        
        $kriptovana = sha1($lozinka);
        if($rezultat->aktivan == "1"){
            if(!$rezultat) {
                $greska = "The user is not found, try again.";
                echo($greska);
            } else {
                if($rezultat->lozinka != $kriptovana) {
                    $greska = "Passwords do not match, try again.";
                    echo($greska);
                }else{
                    $_SESSION['korisnik'] = $rezultat;
                    echo("redirect");
                } 
            }
        }else{
            $greska = "The user account has been blocked by the administrator.";
            echo($greska);
        }
       
        
    }

?>