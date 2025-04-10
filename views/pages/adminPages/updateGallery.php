<?php 
    $greske = [];
    $naziv = "";
    $id = "";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $upitNaziv = "SELECT naziv FROM galerija WHERE id_galerija = :id";
        $stmt = $konekcija -> prepare($upitNaziv);
        $stmt -> bindParam(":id", $id);
        $stmt -> execute();
        $res = $stmt -> fetch();
        $naziv = $res -> naziv;
    }
    if(isset($_POST["potvrdi"])) {

        $greske = [];

        if(!isset($_POST['label'])) {
            $greske['label'] = "Name is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Name is required!";
            }
        }

        if($_FILES["slika"]["error"] == UPLOAD_ERR_NO_FILE) {
            $greske["slika"] = "Image is required!";
        }else {
            
                $dozvoljeniTipovi = ["image/jpeg", "image/png", "image/jpg"];
                $slikaFajl = $_FILES["slika"];

                $tipSlike = $slikaFajl["type"];
                $velicina = $slikaFajl["size"];
                $tmpPutanja = $slikaFajl["tmp_name"];

                if(!in_array($tipSlike, $dozvoljeniTipovi)) {
                    $greske[] = "File type not allowed. Allowed types are: jpg, jpeg, png.";
                }

                if($velicina > 2000000) {
                    $greske[] = "The file must not exceed 2mb.";
                }

                $tipFajla = explode(".", $slikaFajl["name"])[1];
                
                $noviNazivSlike = time() . uniqid() . "." . $tipFajla;

                
                $novaPutanjaSlike = "images/gallery/" . $noviNazivSlike;
				
                $premestaj = move_uploaded_file($tmpPutanja, $novaPutanjaSlike);

                if(!$premestaj) {
                    $greske[] = "Error uploading image.";   
                }
        }
        

         if(!count($greske)) {

            $label = $_POST["label"];
		
            $upitProizvod = "UPDATE galerija SET src = :noviNazivSlike, naziv = :label WHERE id_galerija = :id";
            
            $stmt = $konekcija->prepare($upitProizvod);
            $stmt->bindParam(":label", $label);
            $stmt->bindParam(":noviNazivSlike", $noviNazivSlike);
            $stmt->bindParam(":id", $id);
            

            if(!$stmt->execute()) {
                $errors["greske"] = "An error has occurred.";
            } else {
                $errors["success"] = "Successful entry.";
				header("Location: index.php?page=admin&adminPage=gallery");
                exit;
            }
		}
        var_dump($errors);

     }
?>

            <div class="container-fluid p-0">
            <h2 class="mb-4">Edit image</h2>
                <form method="post" action="index.php?page=admin&adminPage=updateGallery&id=<?= $id ?>" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">New label for product:</label>
                        <input type="text" class="form-control" id="label" name="label" value="<?=$naziv?>">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Select new image for gallery:</label><br/>
                        <input type="file" name="slika" class="form-control-file mb-3" id="exampleFormControlFile1">
                        <?php
                            if(isset($greske['slika'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['slika'] . "</p>";
                            } 
                        ?>
                    </div>
                    <button type="submit" name="potvrdi" class="btn btn-success">Edit picture</button>

                </form>
            </div>



          