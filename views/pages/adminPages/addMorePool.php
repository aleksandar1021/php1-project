<div class="container-fluid p-0">
    <h2 class="mb-4">Insert more pools:</h2>
    <form method="post" action="models/addMorePool.php?id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="exampleFormControlInput1">Answers:</label>
            <input type="text" class="form-control mb-4" name="odgovori[]" placeholder="Enter answer">

            <div id="dodatniOdgovori"></div>

            <button type="button" name="dodaj" class="btn btn-success" id="dodaj">Add another answer for survey</button>

        </div>
        <?php
            if(isset($_SESSION["greskeUnos"])){
                $ispis = "<p class='alert alert-danger'>";
                foreach($_SESSION["greskeUnos"] as $g){
                    $ispis .= $g."<br>";
                }
                $ispis .= "<p>";
                echo($ispis);
                unset($_SESSION['greskeUnos']);
            }
        ?>

        <button type="submit" name="potvrdi" class="btn btn-danger">Update survey</button>
    </form>
</div>

