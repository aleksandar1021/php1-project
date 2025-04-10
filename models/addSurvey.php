<?php
    if(isset($_POST["potvrdi"])){
        session_start();
        include("../config/konekcija.php");
        $pitanje = $_POST["pitanje"];
        $odgovori = $_POST["odgovori"];
        
        $greske = [];

        if(!strlen($pitanje)){
            array_push($greske, "Enter question!");
        }
        foreach($odgovori as $o){
            if(!strlen($o)){
                array_push($greske, "Some of the questions were not entered!");
            }
        }

        if(!count($greske)){$unosPitanje = "INSERT INTO anketa(pitanje) VALUES(:pitanje)";
            $stm = $konekcija -> prepare($unosPitanje);
            $stm -> bindParam(":pitanje", $pitanje);
            $stm -> execute();
    
            $lastId = $konekcija -> lastInsertId();
    
            foreach($odgovori as $o){
                $upit = "INSERT INTO odgovor(odgovor, id_anketa) VALUES(:o, $lastId)";
                $stm1 = $konekcija -> prepare($upit);
                $stm1 -> bindParam(":o", $o);
                $stm1 -> execute();
            }
            $greske = [];
            http_response_code(200);
            header("Location: ../index.php?page=admin&adminPage=survey");
        }else{
            array_push($greske, "An error has occurred!");
            $_SESSION['greskeUnos'] = $greske;
            header("Location: ../index.php?page=admin&adminPage=addSurvey");
            http_response_code(400);
        }
        
    }
?>