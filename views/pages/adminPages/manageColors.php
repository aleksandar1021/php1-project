<?php 
    $boje = getAll("boja");

?>
            <div class="container-fluid p-0">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Colors:</h6>
                            <a href="?page=admin&adminPage=addColor"><button type="button" class="btn btn-primary mb-4">Add new color</button></a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Color</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            foreach($boje as $index => $p){?>
                                                <tr>
                                                    <td scope="row"><?= $index + 1?></td>
                                                    <td><?= $p->boja ?></td>
                                                    <td><a onclick="obrisi(<?= $p->id_boja ?>, 'removeColor.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                    <td><a href="?page=admin&adminPage=updateColor&id=<?= $p->id_boja ?>"><button type="button" class="btn btn-success">Change</button></a></td>
                                                </tr>
                                                <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

