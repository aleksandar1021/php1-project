<?php
    $upit = "SELECT * FROM anketa a ORDER BY a.datum DESC LIMIT 0,1";
    $stm = $konekcija -> prepare($upit);
    $stm -> execute();
    $anketa = $stm -> fetch();
    
    if($anketa){
        $id = strval($anketa -> id_anketa);
        $upitPitanja = "SELECT * FROM odgovor WHERE id_anketa = $id";
        $stm1 = $konekcija -> prepare($upitPitanja);
        $stm1 -> execute();
        $pitanja = $stm1 -> fetchAll();
    }

    
?>

<div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Current survey:</h6>
                            <a href="index.php?page=admin&adminPage=addSurvey"><button type="button" class="btn btn-primary mb-4">Add new survey</button></a>
                            <?php
                                if($anketa){?>
                                <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?= $anketa -> pitanje ?></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php 
                                            foreach($pitanja as $p){ ?>
                                            <tr>
                                                <td scope="row"><?= $p -> odgovor ?></td>
                                                <td><a onclick="obrisi(<?= $p->id_odgovor ?>, 'removePool.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                <td><a href="?page=admin&adminPage=updatePool&id=<?= $p->id_odgovor ?>"><button type="button" class="btn btn-success">Change</button></a></td>
                                            </tr>
                                            <?php } ?>
                                        
                                    
                                </tbody>
                            </table>
                            <a href="models/removeSurvey.php?id=<?= $anketa->id_anketa ?>"><button type="button" class="btn btn-danger">Remove survey</button></a>
                            <a href="index.php?page=admin&adminPage=addMorePool&id=<?= $anketa->id_anketa ?>"><button type="button" class="btn btn-success">Add more answers</button></a>
                            <?php } 
                            else {?>
                            <p class="alert alert-danger">There are currently no polls posted</p>
                            <?php } ?>
                            

                        </div>
                    </div>
                </div>

