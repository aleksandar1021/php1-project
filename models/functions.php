<?php
    include("config/konekcija.php");

    function getAll($tabela){
        global $konekcija;
        $upit = "SELECT * FROM $tabela";
        $stmt = $konekcija -> prepare($upit);
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    function ispisNavigacije(){
        global $konekcija;
        if(isset($_SESSION["korisnik"])){
            if($_SESSION["korisnik"]->uloga=="korisnik"){
                $upit = "SELECT * from navigacija WHERE text <> 'Admin panel'";
            }
            else if($_SESSION["korisnik"]->uloga=="admin"){
                $upit = "SELECT * from navigacija";
            }
        }
        else{
            $upit = "SELECT * from navigacija WHERE text <> 'Shop' AND  text <> 'Admin panel' AND  text <> 'Survey'";
        }
        
        $rez = $konekcija -> query($upit);
        $result = $rez -> fetchAll();
        return $result;
        
    }

    function ispisChcBrend($tabela){
        global $konekcija;
        $upit = "SELECT * from $tabela";

        $rez = $konekcija->query($upit);
        $result = $rez->fetchAll();

        foreach($result as $r){
            echo"<input class='ml-2 chc' name='marka' type='checkbox' value='$r->id_brend'/> $r->naziv_brend<br/>";
        }
    }
    function ispisChcBoja($tabela){
        global $konekcija;
        $upit = "SELECT * from $tabela";

        $rez = $konekcija->query($upit);
        $result = $rez->fetchAll();

        foreach($result as $r){
            echo"<input class='ml-2 chc' name='boja' type='checkbox' value='$r->id_boja'/> $r->boja<br/>";
        }
    }

    function ispisChcKategorija($tabela){
        global $konekcija;
        $upit = "SELECT * from $tabela";

        $rez = $konekcija->query($upit);
        $result = $rez->fetchAll();

        foreach($result as $r){
            echo"<input class='ml-2 chc' name='kat' type='checkbox' value='$r->id_kategorija'/> $r->naziv_kategorija<br/>";
        }
    }

    function getFirstImage(){
        global $konekcija;

        $upit = "SELECT * FROM galerija ORDER BY naziv DESC LIMIT 0,1";
        $stmt = $konekcija -> prepare($upit);
        $stmt -> execute();
        return $stmt -> fetch();
    }

?>