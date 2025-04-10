<?php
    @session_start();

    if(isset($_GET['logovanje'])){
        if(isset($_SESSION["korisnik"])){
            echo true;
            http_response_code(200);
        }else{
            echo false;
            http_response_code(200);
        }
    }
?>