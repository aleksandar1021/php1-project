<?php 
    $greske = [];
    if(isset($_POST["potvrdi"])) {

        if(!isset($_POST['label'])) {
            $greske['label'] = "Name is required!";
        }else {
            if(!$_POST["label"]) {
                $greske['label'] = "Name is required!";
            }
        }

        if($_POST["brand"] =="0") {
            $greske["brand"] = "Brand is required!";
        }

        if($_POST["prom"] =="-1") {
            $greske["prom"] = "Promotion is required!";
        }

		if($_POST["cat"] == "0") {
            $greske["cat"] = "Brand is required!";
        }

        if($_POST["boja"] == "0") {
            $greske["boja"] = "Color is required!";
        }

        

        if(!isset($_POST["price"])) {
            $greske["price"] = "Price is required!";
        }else {
            if(!$_POST["price"]) {
                $greske["price"] = "Price is required!";
            }
        }

       

        if(!isset($_POST["opis"])) {
            $greske["opis"] = "Description is required!";
        }else {
            if(!$_POST["opis"]) {
                $greske["opis"] = "Description is required!";
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

                
                $novaPutanjaSlike = "images/" . $noviNazivSlike;
				
                $premestaj = move_uploaded_file($tmpPutanja, $novaPutanjaSlike);

                if(!$premestaj) {
                    $greske[] = "Error uploading image.";   
                }
            
				
        }
        

         if(!count($greske)) {

            $label = $_POST["label"];
            $opis =  $_POST["opis"];
            $idKat = $_POST["cat"];
            $idBoje = $_POST["boja"];
            $idBrand = $_POST["brand"];
			$cena=$_POST["price"];
            $popust = $_POST["discount"];
			$promocija=$_POST["prom"];
            
			
			
			$upitProizvod="";
            if($promocija>0){
                $upitProizvod = "INSERT INTO proizvod (naziv, opis, id_brend, slika, id_kategorija, id_promocija) VALUES (:naziv, :opis, :id_brend, :slika, :id_kategorija, :id_promocija)";
            }
            else{
                $upitProizvod = "INSERT INTO proizvod (naziv, opis, id_brend, slika, id_kategorija) VALUES (:naziv, :opis, :id_brend, :slika, :id_kategorija)";
            }
            $stmt = $konekcija->prepare($upitProizvod);
            $stmt->bindParam(":naziv", $label);
            $stmt->bindParam(":opis", $opis);
            $stmt->bindParam(":id_brend", $idBrand);
            $stmt->bindParam(":slika", $noviNazivSlike);
            $stmt->bindParam(":id_kategorija", $idKat);
            if($promocija>0){
                $stmt->bindParam(":id_promocija", $promocija); 
            }
            $result = $stmt->execute();
            
            $lastInsertedId=$konekcija->lastInsertId();

			$upitSnizenje="INSERT INTO popust(procenat,id_proizvod) VALUES (:procenat, :id_proizvod)";
            $stmt1 = $konekcija->prepare($upitSnizenje);
            $stmt1->bindParam(":procenat", $popust);
            $stmt1->bindParam(":id_proizvod", $lastInsertedId);
            $result1 = $stmt1->execute();

			$upitCena="INSERT INTO cena(cena, id_proizvod) VALUES (:cena, :id_proizvod)";
            $stmt2 = $konekcija->prepare($upitCena);
            $stmt2->bindParam(":cena", $cena);
            $stmt2->bindParam(":id_proizvod", $lastInsertedId);
            $result2 = $stmt2->execute();

			$upitProizvodBoja="INSERT INTO proizvod_boja(id_proizvod ,id_boja) VALUES (:id_proizvod,:id_boja)";
            $stmt3 = $konekcija->prepare($upitProizvodBoja);
            $stmt3->bindParam(":id_proizvod", $lastInsertedId);
            $stmt3->bindParam(":id_boja", $idBoje);
            $result3 = $stmt3->execute();

            if(!$result) {
                $errors["greske"] = "An error has occurred.";
            } else {
                $errors["success"] = "Successful entry.";
				header("Location: index.php?page=admin&adminPage=products");
                exit;
            }
		}

     }
?>

            <div class="container-fluid p-0">
            <h2 class="mb-4">Insert new product</h2>
                <form method="post" action="index.php?page=admin&adminPage=addProducts" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Label for product:</label>
                        <input type="text" class="form-control" id="label" name="label" placeholder="Product label">
                        <?php
                            if(isset($greske['label'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['label'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select brand:</label>
                        <select class="form-control" id="brand" name="brand">
                            <?php 
                                $upitBrend ="SELECT * FROM brend";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select brand</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_brend'>$b->naziv_brend</option>";
                                }
                            ?>
                        </select>
                        <?php
                            if(isset($greske['brand'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['brand'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select category:</label>
                        <select class="form-control" id="cat" name="cat">
                        <?php 
                                $upitBrend ="SELECT * FROM kategorija";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select category</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_kategorija'>$b->naziv_kategorija</option>";
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['cat'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['cat'] . "</p>";
                            } 
                        ?>
                    </div>
                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select promotion:</label>
                        <select class="form-control" id="prom" name="prom">
                        <?php 
                                $upitBrend ="SELECT * FROM promocija";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='-1'>Select promotion</option>";
                                echo "<option value='0'>Without promotion</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_promocija'>$b->promocija</option>";
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['prom'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['prom'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlSelect1">Select color:</label>
                        <select class="form-control" id="boja" name="boja">
                        <?php 
                                $upitBrend ="SELECT * FROM boja";
                                $rez = $konekcija->query($upitBrend);
                                $brendovi = $rez->fetchAll();
                                echo "<option hidden value='0'>Select color</option>";
                                foreach($brendovi as $b){
                                    echo "<option value='$b->id_boja'>$b->boja</option>";
                                }
                        ?>
                        </select>
                        <?php
                            if(isset($greske['boja'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['boja'] . "</p>";
                            } 
                        ?>
                    </div>

                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Insert price of product:</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Product price">
                        <?php
                            if(isset($greske['price'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['price'] . "</p>";
                            } 
                        ?>
                    </div>


                    <div class="form-group mb-3">
                        <label for="exampleFormControlInput1">Insert discount for product:</label>
                        <input type="text" class="form-control" id="discount" name="discount" placeholder="Product discount">
                      
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Select image for product:</label><br/>
                        <input type="file" name="slika" class="form-control-file mb-3" id="exampleFormControlFile1">
                        <?php
                            if(isset($greske['slika'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['slika'] . "</p>";
                            } 
                        ?>
                    </div>
                    
                    
                    <div class="form-group mb-5">
                        <label for="exampleFormControlTextarea1">Product description:</label>
                        <textarea name="opis" class="form-control" id="exampleFormControlTextarea1" rows="7"></textarea>
                        <?php
                            if(isset($greske['opis'])){
                                echo "<p class = 'alert-danger p-2 mt-3'>" . $greske['opis'] . "</p>";
                            } 
                        ?>
                    </div>

                    <button type="submit" name="potvrdi" class="btn btn-danger">Insert product</button>

                </form>
            </div>



          