<?php 
    $upitPoruke = "SELECT * FROM kontakt";
    $stm = $konekcija->prepare($upitPoruke);
    $stm->execute();
    $poruke = $stm->fetchAll();

?>
               
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Messages:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name and lastname</th>
                                        <th scope="col">Mail</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Adress</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach($poruke as $index => $p){?>
                                            <tr>
                                                <td scope="row"><?= $index+1 ?></td>
                                                <td><?= $p->ime_prezime ?></td>
                                                <td><?= $p->k_mail ?></td>
                                                <td><?= $p->telefon ?></td>
                                                <td><?= $p->tip_korisnika ?></td>
                                                <td><?= $p->poruka ?></td>
                                                <td><?= $p->adresa?></td>
                                                <td><a onclick="obrisi(<?= $p->id_kontakt ?>, 'removeContact.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>