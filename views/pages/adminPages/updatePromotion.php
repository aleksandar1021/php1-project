<?php 
    $greske = [];
    
    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    }else{
        header("Location: index.php?page=admin&adminPage=managePromotions");
    }

    $id = $_GET["id"];

    $promocija = getById("promocija", "id_promocija", $id);

    if(isset($_POST["potvrdi"]))
    {
        if(!isset($_POST['label'])) {
            $greske['label'] = "Name is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Name is required!";
            }
        }

        if(!count($greske)) {

           
            $label = $_POST["label"];
            
			$upit="UPDATE promocija SET promocija = :promocija WHERE id_promocija = :id";
            $stm1 = $konekcija->prepare($upit);
            $stm1->bindParam(":id", $id);
            $stm1->bindParam(":promocija", $label);
            $result = $stm1->execute();
            
            if(!$result) {
                $errors["greske"] = "An error has occurred.";
            } else {
                $errors["success"] = "Successful entry.";
				header("Location: ?page=admin&adminPage=managePromotions");
            }
			
		}
    }  
?>
            <div class="container-fluid p-0">
            <h2 class="mb-4">Update color</h2>
            <form method="post" action="?page=admin&adminPage=updatePromotion&id=<?=$_GET["id"];?>" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">New promotion name:</label>
                        <input type="text" class="form-control" value= "<?=$promocija->promocija?>" id="label" name="label">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>


                    <button type="submit" name="potvrdi" class="btn btn-success">Update color</button>
                </form>
            </div>
