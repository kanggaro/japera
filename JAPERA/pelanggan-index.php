<?php

session_start();

if( !isset($_SESSION["login"]) ){
    header("Location:login.php");
    exit;
}

require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>JAPERA - Solusi untuk Sarang Serangga</title>
    <style>
        *{
            /* border: 1px solid red; */
        }

        h1, h2, h3, h4, h5, h6, p, a {
            text-decoration: none;
            color: white;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #7E643A;">
        <div class="container-fluid">
            <a class="navbar-brand" href="pelanggan-index.php">
                <img src="images/j2.png" alt="Bootstrap" width="122" height="30" style="margin:10px 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="pelanggan-index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="pelanggan-keluhanku.php" style="margin-left: 30px;">Keluhanku</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#7E643A;">
                        <img src="images/person.png" alt="" width="50" height="50" style="margin:0px 100px">
                    </a>
                    <ul class="dropdown-menu">
                        <!--li> <a class="dropdown-item" href="pelanggan-update-profil.php">Profilku</a></li-->
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>    
                </div>
            </div>
        </div>
    </nav>
<!-- END NAVBAR -->
    
<!-- body -->
    <div class="row align-items-center justify-content-center" style="margin-top:8rem; margin-bottom: 3rem;">
        <div class="col">
            <img src="images/org.png" alt="" width="" height="" style="margin-left:150px">
        </div>

        <div class="col" style="margin-top: -50px; margin-left: -90px;">
            <h1 style="font-size:48px; font-weight:bold; color:#544021;">Sikat Tuntas </h1>
            <h1 style="font-size:48px; font-weight:bold; color:#544021;">Masalah Serangga</h1>
            <h1 style="font-size:48px; font-weight:bold; color:#544021;">Dengan Partner Terbaikmu</h1><br>
            
            <a class="btn btn-lg" style="background-color:#CDAC76; font-weight: 600; color:white;" href="pelanggan-buat-keluhan.php" >Buat Keluhan</a>
            <!-- <button type="submit"><a href="update.php?id=<?//= $id ?>">myprofile</a></button> -->
        </div>
    </div>
<!-- end body -->

<!-- footer -->
        <div class="row text-white" style="background-color:#7E643A; padding:50px 150px; margin-top:1.5rem;">
            <div class="col">
                <img src="images/Logo-JAPERA.png" alt="" style="width: 200px; margin-left: 20px;">
            </div>
            <div class="col">
                <h6 style="font-weight:250;">Teknik Kimia Street</h6>
                <h6 style="font-weight:250;">Highway ITS, Sukolilo, Surabaya 60111</h6>
                <h6 style="font-weight:250;">Fax : +62-31-5939363</h6>
                <h6 style="font-weight:250;">email : cs@japera.com</h6>
            </div>
            <div class="col" style="margin-right:-250px">
                    
                    <p>Ikuti kami melalui media sosial:</p>

                    <img src="images/Instagram.png" alt="">
                    <img src="images/Tiktok.png" alt="" style="margin:0 55px">
                    <img src="images/Facebook.png" alt="">

            </div>
        </div>
<!-- end footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>