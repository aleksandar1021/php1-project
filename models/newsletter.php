<?php 
    @session_start();
    include("config/konekcija.php");
    if(isset($_POST["mejl"])){
        $mejl = $_POST["mejl"];
        $id = $_SESSION['korisnik']->id_korisnik;

        $upit = "INSERT INTO novosti (id_korisnik,mail) VALUES ($id, :mejl)";

        $stm = $konekcija->prepare($upit);
        $stm -> bindParam(":mejl",$mejl);
        $result = $stm->execute();
        http_response_code(200);
    }
?>