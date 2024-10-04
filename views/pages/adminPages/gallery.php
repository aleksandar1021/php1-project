<div class="row g-4">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Pictures:</h6>
                            <a href="index.php?page=admin&adminPage=addImage"><button type="button" class="btn btn-primary mb-4">Add new picture</button></a>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            $upitSlike = "SELECT * FROM galerija";
                                            $stmt = $konekcija -> prepare($upitSlike);
                                            $stmt -> execute();
                                            $slike = $stmt -> fetchAll();

                                            foreach($slike as $index => $s){
                                               
                                                
                                            ?>
                                            <tr>
                                                <td scope="row"><?= $index +1 ?></td>
                                                <td><img width="100" src="images/gallery/<?= $s->src ?>"/></td>
                                                <td><?= $s->naziv ?></td>
                                                <td><a onclick="obrisi(<?= $s->id_galerija ?>,'removePicture.php')"><button type="button" class="btn obrisi btn-danger">Remove</button></a></td>
                                                <td><a href="index.php?page=admin&adminPage=updateGallery&id=<?= $s->id_galerija?>"><button type="button" class="btn btn-success">Change</button></a></td>
                                            </tr>
                                            <?php } ?>
                                        
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

