<?php 
    include "../config/konekcija.php";
    if(isset($_POST["id"])) {
        $id =  $_POST["id"];

        $upit = "DELETE from pitanje_odgovor where id_po = :id";
        $stmt = $konekcija->prepare($upit);
        $stmt->bindParam(":id", $id);
        $result = $stmt->execute();

        
        if(!$result){
            http_response_code(500);
        }
        else{
            http_response_code(200);
        }
        
    } else {
        http_response_code(500);
    }

?>