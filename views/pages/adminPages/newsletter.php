<?php 
    $upitPoruke = "SELECT n.mail, n.id_novosti, k.ime, k.prezime FROM novosti n JOIN korisnik k on k.id_korisnik = n.id_korisnik";
    $stm = $konekcija->prepare($upitPoruke);
    $stm->execute();
    $poruke = $stm->fetchAll();

?>

            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Subscribed to the newsletter:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Lastname</th>
                                        <th scope="col">Mail</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            //var_dump($proizvodi);
                                            foreach($poruke as $index => $p){?>
                                            <tr>
                                                <td scope="row"><?= $index + 1 ?></td>
                                                <td><?= $p->ime ?></td>
                                                <td><?= $p->prezime ?></td>
                                                <td><?= $p->mail ?></td>
                                                <td><a onclick="obrisi(<?= $p->id_novosti ?>, 'removeNewsletter.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            


           