<?php

session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

if( isset($_POST["kirim"]) ) {
    $ID_tiket_baru = mysqli_fetch_assoc(mysqli_query($conn, "SELECT ID FROM tiketkeluhan WHERE ID = (SELECT MAX(ID) FROM tiketkeluhan)"));
    $ID_tiket_baru = $ID_tiket_baru["ID"] + 1;

    $serangga_ID = $_POST["serangga"];
    $serangga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM jenisserangga WHERE ID = '$serangga_ID'"));
    $serangga = $serangga["nama"];
        
    $judul_pembasmian = "Pembasmian Sarang $serangga";
    $foto_sarang = $_FILES["foto-sarang"]["name"];
    $foto_sarang = "$ID_tiket_baru"."_".$foto_sarang;
    $foto_sarang_tmp = $_FILES["foto-sarang"]["tmp_name"];
    $foto_sarang_path = "images/foto_sarang/".$foto_sarang;
    move_uploaded_file($foto_sarang_tmp, $foto_sarang_path);

    $tanggal_dibuat = date("Y-m-d");
    $tempat_ID = $_POST["tempat"];
    $status_ID = 1;
    $koordinator_ID = 1;
    
    $pelanggan_ID = $_SESSION["ID"];
    $admin_ID = 1;
    
    //echo "<br><br><br><br><br><br>";
    //echo "$judul_pembasmian, $foto_sarang, $tanggal_dibuat, $tempat_ID, $status_ID, $koordinator_ID, $serangga_ID, $pelanggan_ID, $admin_ID";
    
    mysqli_query($conn, "INSERT INTO tiketkeluhan VALUES ('', '$judul_pembasmian', '$foto_sarang', '$tanggal_dibuat', '$tanggal_dibuat', NULL, NULL, NULL,
    $tempat_ID, $status_ID, $koordinator_ID, $serangga_ID, $pelanggan_ID, $admin_ID)");
    header("Location: pelanggan-index.php");
    echo "<script>alert('Keluhan berhasil dikirim, ditunggu ya🤗')</script>";
    
        //     <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">

        //     // $(document).ready(function(){

        //         swal("Good job!", "You clicked the button!", "success");

        //     // });

        //     </script>
        //     `;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    
    <title>Buat Keluhan</title>
    <style>
        *{
            /* border: 1px solid red; */
        }

        h1, h2, h3, h4, h5, h6, p, a, label {
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
        <h1 class="d-flex justify-content-center" style="margin:180px 0 65px 0; color:#544021;">Buat Keluhan</h1>

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3 row d-flex justify-content-center">

                <label for="jenis-tempat" class="col-sm-2 col-form-label" style="color:#544021;">Jenis Tempat</label>
                <!-- <div class="form-check form-check-inline col-sm-5"> -->
                <div class="col-sm-5">
                    <!-- <input name="jenis-serangga" type="text" class="form-control" id="jenis-serangga"> -->
                    <select class="form-select" aria-label="Default select example" name="tempat">
                        <option selected>Pilih Jenis Tempat</option>
                        <option value="1">Rumah</option>
                        <option value="2">Kantor</option>
                    </select>
                </div>
                <!-- <div class="col-sm-5">
                    <input name="jenis-tempat" type="text" class="form-control" id="jenis-tempat" value="">
                </div> -->
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="jenis-serangga" class="col-sm-2 col-form-label" style="color:#544021;">Jenis Serangga</label>
                <div class="col-sm-5">
                    <!-- <input name="jenis-serangga" type="text" class="form-control" id="jenis-serangga"> -->
                    <select class="form-select" aria-label="Default select example" name="serangga">
                    <option selected>Pilih Serangga</option>
                        <option value="1">Semut</option>
                        <option value="2">Rayap</option>
                        <option value="3">Nyamuk</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row d-flex justify-content-center">
                <label for="gambar" class="col-sm-2 col-form-label" style="color:#544021;">Foto Sarang Serangga</label>
                <div class="col-sm-5">
                    <input type="file" name="foto-sarang" class="form-control">
                </div>
            </div>
                
            <div class="d-flex justify-content-center" style="margin-top:75px;">
                <button class="btn" type="submit" name="kirim" style="background-color:#CDAC76; font-weight: 600; color:white; padding:10px 200px">Kirim</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>