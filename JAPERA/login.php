<?php
session_start();

//redirect ke beranda user/admin, jika uda login 
if( isset($_SESSION["login"]) ){

    if($_SESSION["type"] == "admin"){
        header("Location: admin-index.php");
        exit;
    }elseif($_SESSION["type"] == "koordinator"){
        header("Location: pembasmi-index.php");
        exit;
    }elseif($_SESSION["type"] == "pelanggan"){
        header("Location: pelanggan-index.php");
        exit;
    }
}

require 'functions.php';

if( isset($_POST["login"]) ){

    $username = $_POST["username"];
    $password = $_POST["password"];

    // $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    // $result = mysqli_query($conn, $sql);

    $result_pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan WHERE username = '$username'");
    $result_koordinator = mysqli_query($conn, "SELECT * FROM koordinatorpembasmi WHERE username = '$username'");
    $result_admin = mysqli_query($conn, "SELECT * FROM pegawaiadmin WHERE username = '$username'");
    // $id = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username' AND password = '$password'");
    // $_SESSION["id"] = $id;

    if(mysqli_num_rows($result_pelanggan) == 1){
        $row = mysqli_fetch_assoc($result_pelanggan);
        if ( password_verify($password, $row["password"]) ){

            //set session
            $_SESSION["login"] = $username;
            $_SESSION["type"] = "pelanggan";
            $_SESSION["ID"] = $row["ID"];
            header("Location: pelanggan-index.php");
            exit;
            
            // header("Location:index.php");
            // exit; 
        }
    }elseif(mysqli_num_rows($result_koordinator) == 1) {
        $row = mysqli_fetch_assoc($result_koordinator);
        if ( $password == $row["password"] ){

            //set session
            $_SESSION["login"] = $username;
            $_SESSION["type"] = "koordinator";
            $_SESSION["ID"] = $row["ID"];
            $_SESSION["nama"] = $row["nama"];
            header("Location: pembasmi-index.php");
            exit;
            
            // header("Location:index.php");
            // exit; 
        }
        
    }elseif(mysqli_num_rows($result_admin) == 1){
        $row = mysqli_fetch_assoc($result_admin);
        if ( $password == $row["password"] ){

            //set session
            $_SESSION["login"] = $username;
            $_SESSION["type"] = "admin";
            $_SESSION["ID"] = $row["ID"];
            $_SESSION["nama"] = $row["nama"];
            header("Location: admin-index.php");
            exit;
            
            // header("Location:index.php");
            // exit; 
        }
    }

    $error = true;

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
    <title>Halaman Login</title>
    <style>
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
        <a class="navbar-brand" href="index.html">
            <img src="images/j2.png" alt="Bootstrap" width="122" height="30" style="margin:10px 100px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="index.html">Beranda</a>
                </li>
            </ul>
            <div class="dropdown" style="display: none;">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#7E643A;">
                    <img src="images/person.png" alt="" width="50" height="50" style="margin:0px 100px">
                </a>
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>    
            </div>
        </div>
    </div>
</nav>
<!-- END NAVBAR -->

<!-- body -->
    <div class="body"style="margin: 10rem;">
        <h1 class="d-flex justify-content-center" style="margin:180px 0 65px 0; color:#544021;">LOGIN</h1>

        <div class="d-flex justify-content-around">
            <?php if( isset($error) ) :?>
                <p style="color:red">username/password salah</p>
    
            <?php endif; ?>
        </div>

        <form action="" method="post">
            
            <!--?php 
                echo print_r();
            ?-->
                
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
                
            <p class="d-flex justify-content-center fst-italic" style="color:black;">Belum punya akun? daftar&nbsp<a href="registrasi.php" style="color:#CDAC76;">disini</a> </p>
            
            <div class="d-flex justify-content-center" style="margin-top:75px;">
                <button class="btn" type="submit" name="login" style="background-color:#CDAC76; font-weight: 600; color:white; padding:10px 200px">Login</button>
            </div>
        </form>
    </div>
<!-- body     -->

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