<?php 
    $korisnici = getAll("korisnik");
?>
            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Users:</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Surname</th>
                                        <th scope="col">Status</th>
                                        <th scope="col"></th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            foreach($korisnici as $k){
                                                $status ="";
                                                $klasa = "danger";
                                                $tekst = "Block";
                                                $link = "blockUser";

                                                if($k -> aktivan == 1){
                                                    $status = "Active";
                                                    $klasa = "danger";
                                                    $tekst = "Block";
                                                    $link = "blockUser";
                                                }else{
                                                    $status = "Blocked";
                                                    $klasa = "success";
                                                    $tekst = "Unblock";
                                                    $link = "unblockUser";
                                                }
                                                if($k->id_uloga ==1){
                                                    continue;
                                                }
                                                
                                                ?>
                                                <tr>
                                                    <td scope="row"><?= $k->id_korisnik ?></td>
                                                    <td><?= $k->mail ?></td>
                                                    <td><?= $k->ime ?></td>
                                                    <td><?= $k->prezime ?></td>
                                                    <td><?= $status ?></td>

                                                    <td><a href="models/<?= $link ?>.php?id=<?=$k->id_korisnik?>"><button type="button" class="btn obrisi btn-<?=$klasa?>"><?=$tekst?></button></a></td>
                                                </tr>
                                                <?php } ?>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
