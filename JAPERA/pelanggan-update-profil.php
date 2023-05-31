<?php

session_start();
require 'functions.php';

$result = mysqli_fetch_assoc(mysqli_query($conn));

if( isset($_POST["register"]) ){
    
}

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
    <title>Halaman Registrasi</title>
    <style>
        h1, h2, h3, h4, h5, h6, p, a, label {
            text-decoration: none;
            color: white;
            font-family: 'Poppins', sans-serif;
        }

        label {
            color: black;
        }
    </style>
</head>
<body>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top" style="background-color: #7E643A;">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="images/j2.png" alt="Bootstrap" width="122" height="30" style="margin:10px 100px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="#">Beranda</a>
                </li>
            </ul>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#7E643A;">
                    <img src="images/person.png" alt="" width="50" height="50" style="margin:0px 100px">
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="pelanggan-update-profil.php">Profilku</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>    
            </div>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->

<!-- body -->
    <div class="body"style="margin: 5rem;">
            <h1 class="d-flex justify-content-center" style="margin:120px 0 65px 0; color:#544021;">SIGN UP</h1>

        <form action="" method="post">

            <div class="mb-3 row d-flex justify-content-center">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-5">
                    <input name="name" type="text" class="form-control" id="name" value="">
                </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-5">
                    <input name="username" type="text" class="form-control" id="username" value="">
                </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-5">
                    <input name="password" type="password" class="form-control" id="password">
                </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="password2" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                <div class="col-sm-5">
                    <input name="password2" type="password" class="form-control" id="password">
                </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-5">
                    <input name="address" type="text" class="form-control" id="address">
                </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-5">
                    <input name="email" type="email" class="form-control" id="email">
                </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-5">
                    <input name="telepon" type="text" class="form-control" id="telepon">
                </div>
            </div>
                            
            <div class="d-flex justify-content-center" style="margin-top:75px;">
                <button class="btn" type="submit" name="register" style="background-color:#CDAC76; font-weight: 600; color:white; padding:10px 200px">Perbarui</button>
            </div>

            <!-- <ul>
                <li>
                    <label for="name">Name : </label>
                    <input type="text" name="name" id="name" required>
                </li>
                <li>
                    <label for="username">Username : </label>
                    <input type="text" name="username" id="username" required>
                </li>
                <li>
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password"  required>
                </li>
                <li>
                    <label for="password2">Konfirmasi Password :</label>
                    <input type="password" name="password2" id="password2"  required>
                </li>
                <li>
                    <label for="address">Address :</label>
                    <input type="address" name="address" id="address"  required>
                </li>
                <li>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email"  required>
                </li>
                <li>
                    <label for="telepon">Nomor Telepon :</label>
                    <input type="text" name="telepon" id="telepon"  required>
                </li>
                <li>
                    <button type="submit" name="register">register</button>
                </li>
                <li>
                    <button type="submit"><a href="login.php">login</a></button>
                </li>
            </ul> -->
        </form>
    </div>
<!-- end body     -->

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