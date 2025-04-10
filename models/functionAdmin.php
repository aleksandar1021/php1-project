<?php

     function getAll($tabela){
         global $konekcija;
         $upit = "SELECT * FROM $tabela";
         $stmt = $konekcija -> prepare($upit);
         $stmt -> execute();
         return $stmt -> fetchAll();
     }

     function getById($tabela, $idTabela, $id){
        global $konekcija;

        $upit ="SELECT * FROM $tabela WHERE $idTabela = :id";
		$stm = $konekcija->prepare($upit);
		$stm->bindParam(":id", $id);
		$stm->execute();
        $result = $stm->fetch();
        return $result;
     }

?>