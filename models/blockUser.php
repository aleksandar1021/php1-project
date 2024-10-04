<?php
    if(isset($_GET['id'])){
        include("../config/konekcija.php");
        $id = $_GET['id'];

        $upit = "UPDATE korisnik SET aktivan = 0 WHERE id_korisnik = :id";
        $stmt = $konekcija -> prepare($upit);
        $stmt -> bindParam(":id", $id);
        
        if($stmt -> execute()){
            http_response_code(200);
            header("Location: ../index.php?page=admin&adminPage=users");
        }else{
            http_response_code(500);
            header("Location: ../index.php?page=admin&adminPage=users");
        }
    }

?>