<?php 
    @session_start();
    ob_start();
    if($_SESSION["korisnik"]->uloga != "admin"){
        header("Location: index.php?page=home");
        exit;
    }
    include("models/functionAdmin.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Panel Baggage</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"/>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico"/>

    <!-- Google Web Fonts -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet"> -->
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <!-- <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet"> -->
    <!-- <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" /> -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <!-- Template Stylesheet -->
    <link href="css/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php?page=admin&adminPage=products" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>ADMIN PANEL</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    
                   
                </div>
                <div class="navbar-nav w-100">
                    <a href="?page=admin&adminPage=products" class="nav-item nav-link">Products</a>
                    <a href="?page=admin&adminPage=survey" class="nav-item nav-link">Survey</a>
                    <a href="?page=admin&adminPage=answers" class="nav-item nav-link">Answers to surveys</a>
                    <a href="?page=admin&adminPage=messages" class="nav-item nav-link">Messages</a>
                    <a href="?page=admin&adminPage=orders" class="nav-item nav-link">Orders</a>
                    <a href="?page=admin&adminPage=newsletter" class="nav-item nav-link">Newsletter</a>
                    <a href="?page=admin&adminPage=manageNavigation" class="nav-item nav-link">Manage navigation</a>
                    <a href="?page=admin&adminPage=manageColors" class="nav-item nav-link">Manage colors</a>
                    <a href="?page=admin&adminPage=manageCategories" class="nav-item nav-link">Manage categories</a>
                    <a href="?page=admin&adminPage=manageBrands" class="nav-item nav-link">Manage brands</a>
                    <a href="?page=admin&adminPage=managePromotions" class="nav-item nav-link">Manage promotions</a>
                    <a href="?page=admin&adminPage=gallery" class="nav-item nav-link">Gallery</a>
                    <a href="?page=admin&adminPage=users" class="nav-item nav-link">Users</a>

                </div>
            </nav>
        </div>