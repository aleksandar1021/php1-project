<?php 
    $upit = "SELECT *, k.datum as dat FROM kupovina k JOIN korisnik ko ON ko.id_korisnik = k.id_korisnik JOIN proizvod p ON k.id_proizvod = p.id_proizvod";
    $stm = $konekcija->prepare($upit);
    $stm->execute();
    $kupovine = $stm->fetchAll();

?>
        <div>
        
            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Orders:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product name</th>
                                        <th scope="col">Id product</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price per piece</th>
                                        <th scope="col">Total price</th>
                                        <th scope="col">Date</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach($kupovine as $index => $k){?>
                                            <tr>
                                                <td><?= $index+1 ?></td>
                                                <td scope="row"><?= $k->naziv ?></td>
                                                <td scope="row"><?= $k-> id_proizvod?></td>
                                                <td><?= $k->mail ?></td>
                                                <td><?= $k->kolicina ?></td>
                                                <td><?= $k->cena_komad ?>&euro;</td>
                                                <td><?= $k->ukupna_cena ?>&euro;</td>
                                                <td><?= $k->dat ?></td>
                                                <td><a onclick="obrisi(<?= $k->id_kupovina ?>, 'removeOrder.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
                                            </div>




