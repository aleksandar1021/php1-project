<?php 
    $upitAnkete = "SELECT * FROM pitanje_odgovor po  JOIN korisnik k ON po.id_korisnik = k.id_korisnik";
    $stm = $konekcija->prepare($upitAnkete);
    $stm->execute();
    $ankete = $stm->fetchAll();

?>
            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Answers:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">User Email</th>
                                        <th scope="col">Question</th>
                                        <th scope="col">Answer</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            foreach($ankete as $index => $a){?>
                                                <tr>
                                                    <td scope="row"><?= $index+1 ?></td>
                                                    <td><?= $a->ime ?></td>
                                                    <td><?= $a->mail ?></td>
                                                    <td><?= $a->pitanje ?></td>
                                                    <td><?= $a->odgovor ?></td>
                                                    <td><a onclick="obrisi(<?= $a->id_po ?>, 'removeAnswer.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                    
                                                </tr>
                                                <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

   