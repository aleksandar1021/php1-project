<div id="modalKontakt">
    <div class="row2">
        <div id="closeModal2">X</div><br/>
    </div>
    <p id="ispis"></p>
</div>
<div class="banner-wthree-info container-fluid plavo">
            <div class="row">
                <div class="col-lg-5 banner-left-info">
                    <h3>The Largest Range <span>of HandBags</span></h3>
                    <a class="btn shop">Shop Now</a>
                </div>

                <div class="col-lg-7 banner-img">
                    <img src="images/bag.png" alt="part image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <section class="banner-bottom py-5">
        <div class="container py-md-5">


            <div class="row d-flex flex-column mb-5">
                <?php
                    $prvaSlika = getFirstImage();
                ?>
                <div class="col-lg-12 gallery-content-info text-center mt-lg-8">
                    <h3 class="title-wthree mb-2 ">OUR GALLERY</h3>
                    <p class="mb-5">Click on the image to see it in a larger format</p>
                </div>
                <div class="row col-lg-4 mx-auto">
                    <img id="glavna" src="images/gallery/<?= $prvaSlika -> src ?>" alt="<?= $prvaSlika -> naziv ?>" class="col-12">
                    <h3 data-naslov="<?= $prvaSlika->naziv ?>" id="naslov" class="mx-auto"><?= $prvaSlika->naziv ?></h3>
                </div>
                <div class="row col-lg-10 mx-auto d-flex flex-row justify-content-center">
                    <?php
                        $slike = getAll("galerija");
                        foreach($slike as $s): ?>
                            <div class="col-2">
                                <img data-naslov="<?= $s->naziv ?>" src="images/gallery/<?= $s -> src ?>" alt="<?= $s -> naziv ?>" class="col-12 slika">
                            </div>
                        
                    <?php endforeach ?>
                </div>
             

        </div>
    </section>

    <section class="collections mb-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 ab-content-img">

                </div>
                <div class="col-md-4 ab-content text-center p-lg-5 p-3 my-lg-5">
                    <h4>Travel Must Haves</h4>
                    <p>Our bags will make every trip easier, they are practical and can hold a lot of things.</p>
                    <a class="btn shop mt-3">Shop Now</a>

                </div>
            </div>
        </div>
    </section>
    <section class="banner-bottom py-5 bg-light mt-5">
        <div class="container py-md-3">
            <div class="row grids-wthree-info text-center">
                <div class="col-lg-4 ab-content">
                    <div class="ab-info-con">
                        <h4>Fast & Free Delivery</h4>
                        <p>We provide you with faster and safe delivery to your home by a verified courier service.</p>
                    </div>
                </div>
                <div class="col-lg-4 ab-content">
                    <div class="ab-info-con">
                        <h4>Safe & Secure Payments</h4>
                        <p>Payment is safe, it takes place on the site's platform.</p>
                    </div>
                </div>
                <div class="col-lg-4 ab-content">
                    <div class="ab-info-con">
                        <h4>100% Money Back Guarantee</h4>
                        <p>If you are not satisfied with the product, you can exchange it within 10 days or get your money back.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /banner-bottom -->
    <!--/collections -->
    <section class="banner-bottom py-5">
        <div class="container py-md-5">

            <h3 class="title-wthree mb-lg-5 mb-4 text-center">Safety Meets Style </h3>
            <div class="row text-center">


                <div class="col-md-4 content-gd-wthree">
                    <img src="images/c1.jpg" class="img-fluid" alt="" />
                </div>
                <div class="col-md-4 content-gd-wthree ab-content py-lg-5 my-lg-5">
                    <h4>Need Extra Space ?</h4>
                    <p>Our cords are designed for your every situation, everything fits in them comfortably, without overcrowding.</p>
                    <a class="btn shop mt-3">Shop Now</a>

                </div>
                <div class="col-md-4 content-gd-wthree">
                    <img src="images/c2.jpg" class="img-fluid" alt="" />
                </div>
            </div>

        </div>
    </section>
    <!-- //collections-->
    <!-- /mid-section -->
    <section class="mid-section">
        <div class="d-lg-flex p-0">
            <div class="col-lg-6 bottom-w3pvt-left p-lg-0">
                <img src="images/ab1.jpg" class="img-fluid" alt="" />
                <div class="pos-wthree">
                    <h4 class="text-wthree">Every Friday, 50% Off Any <br> Women's Bags</h4>
                    <a class="btn shop mt-3">Shop Now</a>
                </div>
            </div>
            <div class="col-lg-6 bottom-w3pvt-left bottom-w3pvt-right p-lg-0">
                <img src="images/ab2.jpg" class="img-fluid" alt="" />
                <div class="pos-w3pvt">
                    <h4 class="text-w3pvt">Every Friday, 30% Off Any <br> Men's Bags</h4>
                    <a class="btn shop mt-3">Shop Now</a>
                </div>
            </div>
        </div>
    </section>