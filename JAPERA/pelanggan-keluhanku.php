<?php

session_start();
require 'functions.php';
error_reporting(0);

if ( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

if ( isset($_POST["detail-keluhan"])) {
    $_SESSION["ID_tiket_keluhan"] = $_POST["detail-keluhan"];
    header("Location:pelanggan-detail-keluhan.php");
    exit;
}

if ( isset($_POST["ulasan"])) {

}

$pelanggan_ID = $_SESSION["ID"];
$result_proses = mysqli_query($conn, "SELECT * FROM tiketkeluhan WHERE status_ID != 5 AND pelanggan_ID = $pelanggan_ID ORDER BY ID DESC");
$result_selesai = mysqli_query($conn, "SELECT * FROM tiketkeluhan WHERE status_ID == 5 AND pelanggan_ID = $pelanggan_ID ORDER BY ID DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Keluhanku</title>
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
                        <!--li> <a class="dropdown-item" href="myprofile.php">My Profile</a></li-->
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>    
                </div>
            </div>
        </div>
    </nav>
<!-- END NAVBAR -->

    <h1 class="d-flex justify-content-center" style="margin:135px 0 25px 0; color:#544021;">KELUHANKU</h1>

    <div class="container mb-3">
        <h2 style="color:#544021;">Dalam Proses</h2>
    </div>
    
    <form action="" method="post">
        <?php

            if (mysqli_num_rows($result_proses) > 0) {
                while($data = mysqli_fetch_assoc($result_proses)) {
                    $ID_tiket = $data["ID"];
                    $serangga_ID = $data["serangga_ID"];
                    $serangga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM jenisserangga WHERE ID = $serangga_ID"));
                    $serangga = $serangga["nama"];
                    $tanggal_dibuat = $data["tanggal_dibuat"];
                    $status_ID = $data["status_ID"];
                    $status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM statuspembasmian WHERE ID = $status_ID"));
                    $status = $status["nama"];
    
                    echo "  <div class=\"container mb-3\" style=\"background-color:#CDAC76; border-radius:20px;\">";
                    echo "      <div class=\"row gx-4\">";
                    echo "          <div class=\"col  d-flex align-items-center justify-content-center\">";
                    echo "              <img src=\"images/".$serangga.".png\" alt=\"\" height=\"140px\">";
                    echo "          </div>";
                    echo "          <div class=\"col d-flex align-items-center justify-content-center\">";
                    echo "              <p class=\"p-3\" style=\"font:500 28px Poppins, sans-serif;\">";
                    echo "                  Pembasmian Sarang ".$serangga;
                    echo "              </p>";
                    echo "          </div>";
                    echo "          <div class=\"col  d-flex align-items-center justify-content-center\">";
                    echo "              <div class=\"col \">";
                    echo "                  <div class=\"row mt-5 p-2 d-flex justify-content-center\" style=\"font:500 16px Poppins, sans-serif; text-align: center;\">".substr($tanggal_dibuat, 0, 10)."</div>";
                    echo "                  <div class=\"row m-4 p-2 d-flex justify-content-center\" style=\"font:500 18px Poppins, sans-serif;";
                
                if ($status_ID == 1) {
                    echo "background-color:#E25454;";
                } elseif ($status_ID == 5) {
                    echo "background-color:#17854C;";
                } else {
                    echo "background-color:#E5CC47;";
                }
                
                echo "                      color:white; ;border:3px solid white; border-radius: 30px;\">".$status."</div>";
                    echo "              </div>";
                    echo "          </div>";
                    echo "          <div class=\"col  d-flex align-items-center justify-content-center\">";
                    echo "              <button class=\"btn btn-light btn-lg\" type=\"submit\" name=\"detail-keluhan\" value=\"".$ID_tiket."\">";
                    echo "                  Detail Keluhan";
                    echo "              </button>";
                    echo "          </div>";
                    echo "      </div>";
                    echo "  </div>";
                }
            } else {
                echo "<h4 style=\"color: black; text-align: center;\">Tidak ada data</h4>";
            }
            
            
        ?>

    </form>
    

    <!--
    <div class="container mb-3" style="background-color:#CDAC76; border-radius:20px;">
        <div class="row gx-4">
            <div class="col  d-flex align-items-center justify-content-center">
                <img src="images/Semut.png" alt="" height="140px">
            </div>
            <div class="col d-flex align-items-center justify-content-center">
                <p class="p-3" style="font:500 28px Poppins, sans-serif;">
                    Pembasmian sarang semut
                </p>
            </div>
            <div class="col  d-flex align-items-center justify-content-center">
                <div class="col ">
                    <div class="row mt-5 p-2 d-flex justify-content-center" style="font:500 16px Poppins, sans-serif; text-align: center;">5 November 2022</div>
                    <div class="row m-4 p-2 d-flex justify-content-center" style="font:500 18px Poppins, sans-serif; background-color:#E5CC47; color:white; ;border:3px solid white; border-radius: 30px;">Dalam proses survei</div>
                </div>
            </div>
            <div class="col  d-flex align-items-center justify-content-center">
                <a class="btn btn-light btn-lg" href="detailKeluhan3.php">
                    Detail Keluhan
                </a>
            </div>
        </div>
    </div>
    -->

    <div class="container mt-4 mb-3">
        <h2 style="color:#544021; margin-top: 80px;">Riwayat</h2>
    </div>
    
    <?php
        if (mysqli_num_rows($result_selesai) > 0) {
            while($data = mysqli_fetch_assoc($result_selesai)) {
                $ID_tiket = $data["ID"];
                $serangga_ID = $data["serangga_ID"];
                $serangga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM jenisserangga WHERE ID = $serangga_ID"));
                $serangga = $serangga["nama"];
                $tanggal_dibuat = $data["tanggal_dibuat"];
                $status_ID = $data["status_ID"];
                $status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM statuspembasmian WHERE ID = $status_ID"));
                $status = $status["nama"];

                echo "  <div class=\"container mb-3\" style=\"background-color:#CDAC76; border-radius:20px;\">";
                echo "      <div class=\"row gx-4\">";
                echo "          <div class=\"col  d-flex align-items-center justify-content-center\">";
                echo "              <img src=\"images/".$serangga.".png\" alt=\"\" height=\"140px\">";
                echo "          </div>";
                echo "          <div class=\"col d-flex align-items-center justify-content-center\">";
                echo "              <p class=\"p-3\" style=\"font:500 28px Poppins, sans-serif;\">";
                echo "                  Pembasmian Sarang ".$serangga;
                echo "              </p>";
                echo "          </div>";
                echo "          <div class=\"col  d-flex align-items-center justify-content-center\">";
                echo "              <div class=\"col \">";
                echo "                  <div class=\"row mt-5 p-2 d-flex justify-content-center\" style=\"font:500 16px Poppins, sans-serif; text-align: center;\">".substr($tanggal_dibuat, 0, 10)."</div>";
                echo "                  <div class=\"row m-4 p-2 d-flex justify-content-center\" style=\"font:500 18px Poppins, sans-serif;";
                
                if ($status_ID == 1) {
                    echo "background-color:#E25454;";
                } elseif ($status_ID == 5) {
                    echo "background-color:#17854C;";
                } else {
                    echo "background-color:#E5CC47;";
                }
                
                echo "                      color:white; ;border:3px solid white; border-radius: 30px;\">".$status."</div>";
                echo "              </div>";
                echo "          </div>";
                echo "          <div class=\"col  d-flex align-items-center justify-content-center\">";
                echo "              <button class=\"btn btn-light btn-lg\" type=\"submit\" name=\"detail-keluhan\" value=\"".$ID_tiket."\">";
                echo "                  Detail Keluhan";
                echo "              </button>";
                echo "          </div>";
                echo "      </div>";
                echo "  </div>";
            }
        } else {
            echo "<h4 style=\"color: black; text-align: center;\">Tidak ada data</h4>";
        }
        
    ?>

    <!--
    <div class="container mb-3" style="background-color:#CDAC76; border-radius:20px;">
        <div class="row gx-4">
            <div class="col  d-flex align-items-center justify-content-center">
                <img src="images/Semut.png" alt="" height="140px">
            </div>
            <div class="col d-flex align-items-center justify-content-center">
                <p class="p-3" style="font:500 28px Poppins, sans-serif;">
                    Pembasmian sarang semut
                </p>
            </div>
            <div class="col  d-flex align-items-center justify-content-center">
                <div class="col ">
                    <div class="row mt-5 p-2 d-flex justify-content-center" style="font:500 16px Poppins, sans-serif; text-align: center;">5 November 2022</div>
                    <div class="row m-4 p-2 d-flex justify-content-center" style="font:500 18px Poppins, sans-serif; background-color:#E5CC47; color:white; ;border:3px solid white; border-radius: 30px;">Dalam proses survei</div>
                </div>
            </div>
            <div class="col  d-flex align-items-center justify-content-center">
                <a class="btn btn-light btn-lg" href="detailKeluhan3.php">
                    Detail Keluhan
                </a>
                <a class="row ms-5 me-5 mt-2 d-flex justify-content-center btn btn-light btn-lg" href="ulasan.php">
                    Beri Ulasan
                </a>
            </div>
        </div>
    </div>
    -->
<!-- footer -->
    <div class="row text-white" style="background-color:#7E643A; padding:50px 150px; margin-top:5.5rem;">
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