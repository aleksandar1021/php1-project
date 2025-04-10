<?php
    if(isset($_POST["id"])){
        include("../config/konekcija.php");
        $id = $_POST["id"];

        $konekcija->query("ALTER TABLE proizvod
                            ADD FOREIGN KEY (id_promocija) REFERENCES promocija(id_promocija)
                            ON DELETE SET NULL
                            ON UPDATE CASCADE");

        $upit = "DELETE from promocija WHERE id_promocija = :id";
        $stm = $konekcija -> prepare($upit);
        $stm -> bindParam(":id", $id);
        
        if($stm -> execute()){
            http_response_code(200);
        }else{
            http_response_code(500);
        }
    }
?>