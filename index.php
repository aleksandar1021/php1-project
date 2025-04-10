<?php 
    @session_start();
    $page = isset($_GET["page"]) ? $_GET["page"] : 0;
    include("const/const.php");
    if($page != "admin"){
        include("views/fixed/header.php");
    }
    if($page){
        if(in_array($_GET["page"], stranice)){
            include "views/pages/" . $_GET["page"] . ".php";
        }
    }
    else{
        include "views/pages/home.php";
    }
    if($page != "admin"){
        include("views/fixed/footer.php");
    }
    
?>
      

