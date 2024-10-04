<?php
    @session_start();
    include "../config/konekcija.php";

    if(isset($_POST['odgovor'])){
        $odgovor = $_POST['odgovor'];
        $id = $_POST['id'];
        $idk = $_SESSION['korisnik']->id_korisnik;
        
        $upitNadji = "SELECT * from pitanje_odgovor WHERE id_korisnik = :idk AND id_anketa = :id";
        $stm = $konekcija->prepare($upitNadji);
        $stm->bindParam(":idk" ,$idk);
        $stm->bindParam(":id" ,$id);
        $stm->execute();
        $brojRedova = $stm->rowCount();

        $upitPitanje = "SELECT pitanje FROM anketa WHERE id_anketa = :id";
        $stmPitanje = $konekcija -> prepare($upitPitanje);
        $stmPitanje -> bindParam(":id", $id);
        $stmPitanje -> execute();
        $pitanjeUnos = $stmPitanje -> fetch();

        $upitO = "SELECT odgovor FROM odgovor WHERE id_odgovor = :id";
        $stmO = $konekcija -> prepare($upitO);
        $stmO -> bindParam(":id", $odgovor);
        $stmO -> execute();
        $odgovorUnos = $stmO -> fetch();

        if($brojRedova==0){
            $insertUpit = "INSERT INTO pitanje_odgovor(id_odgovor, id_korisnik, id_anketa, pitanje, odgovor) VALUES (:idO,:idk,:id, :pitanje, :odgovor)";
            $stm = $konekcija->prepare($insertUpit);
            $stm->bindParam(":idO" ,$odgovor);
            $stm->bindParam(":idk" ,$idk);
            $stm->bindParam(":id" ,$id);
            $stm->bindParam(":pitanje" ,$pitanjeUnos -> pitanje);
            $stm->bindParam(":odgovor" ,$odgovorUnos -> odgovor);
            $stm->execute();
            echo "You have successfully answered the question";
            http_response_code(200);
        }
        else{
            echo "You have already answered this poll, when the administrator posts a new poll then you can vote again";
            http_response_code(200);
        }
    }
?>