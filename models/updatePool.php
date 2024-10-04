<?php
    session_start();
    if(isset($_POST["potvrdi"])){
        include("../config/konekcija.php");
        $id = $_GET['id'];
        $newPool = $_POST['label'];

        $greska = "";

        if(!strlen($newPool)){
            $greska = "Enter pool!";
            $_SESSION['greskaUpdate'] = $greska;
            header("Location: ../index.php?page=admin&adminPage=updatePool&id=$id");
            exit;
        }

        $upit = "UPDATE odgovor SET odgovor = :newPool WHERE id_odgovor = :id";
        $stmt = $konekcija -> prepare($upit);
        $stmt -> bindParam("id", $id);
        $stmt -> bindParam("newPool", $newPool);
        
        if($stmt -> execute()){
            http_response_code(200);
            header("Location: ../index.php?page=admin&adminPage=survey");
        }else{
            http_response_code(500);
            header("Location: ../index.php?page=admin&adminPage=updatePool&id=$id");
        }
    }
?>