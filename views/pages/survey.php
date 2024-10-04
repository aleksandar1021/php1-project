<?php 
    @session_start(); 
    if(!isset($_SESSION['korisnik'])){
        header("Location: index.php");
    }
    
?>
</div>
<div class="row col-12 my-5">
    <div class=" mx-auto p-5 col-10 my-5 bg-light anketa">
        <?php 
            $upitAnketa = "SELECT * FROM anketa ORDER BY datum DESC LIMIT 0,1";
            $rez = $konekcija->query($upitAnketa);
            $result = $rez->fetch();
            if($result){
                $pitanje = $result->pitanje;
            }
        ?>
        <div id="modalKontakt">
            <div class="row2">
                <div id="closeModal2">X</div><br/>
            </div>
            <p id="ispis"></p>
        </div>  
        <h3 class="mb-3"><?=$result?$pitanje:""?></h3>

        <?php
            if($result){
                $idAnkete = $result->id_anketa;

                $odgovoriUpit = "SELECT * FROM odgovor WHERE id_anketa = $idAnkete";
                $rezOdgovori = $konekcija->query($odgovoriUpit);
                $resultOdgovori = $rezOdgovori->fetchAll();
                echo"<input id='skriven' type='hidden' value='$idAnkete'/>";
                foreach($resultOdgovori as $o){
                    echo "<p><input type='radio' class='ank' name='odgovor' value ='$o->id_odgovor'/> $o->odgovor</p>";
                }
            }else{
                echo("<p class='alert alert-danger'>There are currently no polls posted</p>");
            }
        ?>
    </div>
</div>