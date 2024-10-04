<?php
    if(isset($_POST["potvrdi"])){
        session_start();
        include("../config/konekcija.php");
       
        $odgovori = $_POST["odgovori"];
        $id = $_GET['id'];
        
        $greske = [];

        foreach($odgovori as $o){
            if(!strlen($o)){
                array_push($greske, "Some of the questions were not entered!");
            }
        }

        if(!count($greske)){
            foreach($odgovori as $o){
                $upit = "INSERT INTO odgovor(odgovor, id_anketa) VALUES(:o, :id)";
                $stm1 = $konekcija -> prepare($upit);
                $stm1 -> bindParam(":o", $o);
                $stm1 -> bindParam(":id", $id);
                $stm1 -> execute();
            }
            $greske = [];
            http_response_code(200);
            header("Location: ../index.php?page=admin&adminPage=survey");
        }else{
            array_push($greske, "An error has occurred!");
            $_SESSION['greskeUnos'] = $greske;
            http_response_code(400);
            header("Location: ../index.php?page=admin&adminPage=addMorePool&id=$id");
           
        }
        
    }
?>