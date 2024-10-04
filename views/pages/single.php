<?php 
    @session_start(); 
    $id = $_GET["id"];
    $upitProizvod = "SELECT opis, naziv, slika, naziv_brend, boja, naziv_kategorija 
                 FROM proizvod p 
                 JOIN brend b on p.id_brend = b.id_brend 
                 JOIN proizvod_boja pb ON p.id_proizvod = pb.id_proizvod 
                 JOIN boja bo ON pb.id_boja = bo.id_boja
                 JOIN kategorija k ON p.id_kategorija = k.id_kategorija 
                 WHERE p.id_proizvod = $id";
    $rez = $konekcija->query($upitProizvod);
    $proizvod = $rez->fetch();

    $cena = "SELECT cena FROM cena c JOIN proizvod p on c.id_proizvod = p.id_proizvod WHERE p.id_proizvod = $id ORDER BY datum desc LIMIT 0,1";
    $result2 = $konekcija->query($cena);
    $trenutna = $result2->fetch();

    $upitPopust = "SELECT procenat FROM popust po JOIN proizvod p on po.id_proizvod = p.id_proizvod WHERE p.id_proizvod = $id  ORDER BY datum_popust desc LIMIT 0,1";
    $popust = $konekcija->query($upitPopust);
    $pop = $popust->fetch();
?>
</div>
    </div>
    <!-- //banner-->
    <!--/banner-bottom -->
    <div id="modalKontakt">
        <div class="row2">
            <div id="closeModal2">X</div><br/>
        </div>
        <p id="ispis"></p>
    </div>
    <section class="banner-bottom py-5">
        <div class="container py-md-5">
            <!-- product right -->
            <div class="left-ads-display wthree">
                <div class="row">
                    <div class="desc1-left col-md-6" >
                        <img id="slika" src="images/<?=$proizvod->slika?>" class="img-fluid" alt="<?=$proizvod->naziv?>">
                    </div>
                    
                    <div class="desc1-right col-md-6 pl-lg-3">
                        <h1 id="naziv"></h1>                        
                        <h2 class="mt-2">Brand:</h2>
                        <h3 class="mt-1 dodatak" id="brand"><?=$proizvod->naziv_brend?></h3>
                        <h2 class="mt-2 ">Color:</h2>
                        <h3 class="mt-1 dodatak" id="color"><?=$proizvod->boja?></h3>
                        <h2 class="mt-2 ">Intended for:</h2>
                        <h3 class="mt-1 dodatak" id="za"><?=$proizvod->naziv_kategorija?></h3>
                        <h2 class="mt-2 ">Price:</h2>
                        <div id="cene">
                            <?php 
                                if($pop->procenat>0){
                                    $saPopustomCena = round($trenutna->cena - ($trenutna->cena * ($pop->procenat/100)));
                                    echo "<del class='mt-2 dodatak' id='stara'>$trenutna->cena &euro;</del>";
                                    echo  "<h3 class='mt-2 dodatak' id='nova'>$saPopustomCena &euro;</h3>";
                                }
                                else{
                                    echo "<span class='mt-2 dodatak' id='stara'>$trenutna->cena &euro;</span>";
                                }
                            ?>
                        </div>
                        <button id="add-to-cart-button">Add to cart</button>
                        
                    </div>

                    <div id="dodato">
                        <p>The product has been added to the cart</p>
                    </div>


                </div>
                <div class="sub-para-w3pvt my-5">
                    <h2 class="shop-sing mb-4 mb-3">Description:</h2>
                    <p id="opis"><?=$proizvod->opis?></p>
                </div>


               
    </section>
    <!-- /banner-bottom -->