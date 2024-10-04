<?php 
    $greske = [];
    
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
        $odgovorUpit = "SELECT * FROM odgovor WHERE id_odgovor = :id";
        $stm = $konekcija -> prepare($odgovorUpit);
        $stm -> bindParam(":id", $id);
        $stm -> execute();
        $odgovor = $stm -> fetch();
    }
   
?>
            <div class="container-fluid p-0">
            <h2 class="mb-4">Update pool</h2>
            <form method="post" action="models/updatePool.php?id=<?=$_GET["id"];?>" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">New pool name:</label>
                        <input type="text" class="form-control" value= "<?=$odgovor -> odgovor?>" id="label" name="label">
                        <?php
                            if(isset($_SESSION['greskaUpdate'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $_SESSION['greskaUpdate'] . "</p>";
                                unset($_SESSION['greskaUpdate']);
                            } 
                        ?>
                    </div>


                    <button type="submit" name="potvrdi" class="btn btn-success">Update color</button>
                </form>
            </div>
