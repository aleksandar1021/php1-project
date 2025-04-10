<?php
    if(isset($_GET['id'])){
        include("../config/konekcija.php");

        $id = $_GET['id'];

        $konekcija->query("ALTER TABLE pitanje_odgovor
                            ADD FOREIGN KEY (id_anketa) REFERENCES anketa(id_anketa)
                            ON DELETE SET NULL
                            ON UPDATE CASCADE");


        $konekcija->query("ALTER TABLE pitanje_odgovor
                            ADD FOREIGN KEY (id_odgovor) REFERENCES odgovor(id_odgovor)
                            ON DELETE SET NULL
                            ON UPDATE CASCADE");

        $upitAnkete = "DELETE from anketa WHERE id_anketa = :id";
        $stmt = $konekcija -> prepare($upitAnkete);
        $stmt -> bindParam(":id", $id);

        $upitOdgovori = "DELETE from odgovor WHERE id_anketa = :id2";
        $stmt1 = $konekcija -> prepare($upitOdgovori);
        $stmt1 -> bindParam(":id2", $id);


        if($stmt1 -> execute() && $stmt -> execute()){
            http_response_code(200);
        }else{
            http_response_code(500);
        }

        header("Location: ../index.php?page=admin&adminPage=survey");
    }

?>