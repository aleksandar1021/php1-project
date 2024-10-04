<?php
    if(isset($_POST["id"])){
        include("../config/konekcija.php");
        $id = $_POST["id"];

        $upit = "DELETE from kontakt WHERE id_kontakt = :id";
        $stm = $konekcija -> prepare($upit);
        $stm -> bindParam(":id", $id);
        
        if($stm -> execute()){
            http_response_code(200);
        }else{
            http_response_code(500);
        }
    }
?>