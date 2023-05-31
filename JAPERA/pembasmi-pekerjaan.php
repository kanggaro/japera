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
    header("Location:pembasmi-detail-keluhan.php");
    exit;
}

$koordinator_ID = $_SESSION["ID"];
$result_proses = mysqli_query($conn, "SELECT * FROM tiketkeluhan WHERE status_ID != 5 AND koordinator_ID = $koordinator_ID ORDER BY ID DESC");
$result_selesai = mysqli_query($conn, "SELECT * FROM tiketkeluhan WHERE status_ID = 5 AND koordinator_ID = $koordinator_ID ORDER BY ID DESC");
?>

<!--!DOCTYPE html>
<html lang="en"-->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAPERA - Solusi untuk Sarang Serangga</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/styles/styles.css">
    <link rel="stylesheet" href="/styles/pembasmi-pekerjaan-styles.css">
    
</head>
<body>
    <div class="sideMenu sideMenu-hover">
        <img class="logo" src="/images/Logo-JAPERA.png" alt="Logo-JAPERA">
        <a href="pembasmi-index.php">Beranda</a>
        <a class="menu-pilihan" href="pembasmi-pekerjaan.php">Pekerjaan</a>

        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <a href="logout.php">
            <img src="/images/exit-icon.png" alt="exit" class="exit-button">
            Keluar
        </a>
        
    </div>

    <div class="content">
        <h1>Daftar Pekerjaan</h1>
        <h2>Dalam Proses</h2>

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

                        echo "<div class=\"kotak-keluhan\">";
                        echo "   <img src=\"/images/$serangga.png\" alt=\"Semut\">";
                        echo "   <h3 class=\"judul-pembasmian\">Pembasmian Sarang $serangga</h3>";
                        echo "   <div class=\"info-pembasmian\">";
                        echo "       <h4 class=\"tanggal-pembasmian\">".substr($tanggal_dibuat, 0, 10)."</h4>";
                        echo "       <h4 class=\"status-pembasmian ";
                        
                        if ($status_ID == 1) {
                            echo "       status-red\">";
                        } elseif ($status_ID == 5) {
                            echo "       status-green\">";
                        } else {
                            echo "       status-yellow\">";
                        }
                        
                        echo "      $status</h4>";
                        echo "   </div>";
                        echo "   <button class=\"tombol-detail-keluhan tombol-keluhan-hover\" name=\"detail-keluhan\" value=\"".$ID_tiket."\">Detail Keluhan</button>";
                        echo "</div>";
                    }
                } else {
                    echo "<h4 style=\"color: black; text-align: center;\">Tidak ada data</h4>";
                }
            ?>

        </form>

        <h2>Pekerjaan Selesai</h2>

        <form action="" method="post">
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

                        echo "<div class=\"kotak-keluhan\">";
                        echo "   <img src=\"/images/$serangga.png\" alt=\"Semut\">";
                        echo "   <h3 class=\"judul-pembasmian\">Pembasmian Sarang $serangga</h3>";
                        echo "   <div class=\"info-pembasmian\">";
                        echo "       <h4 class=\"tanggal-pembasmian\">".substr($tanggal_dibuat, 0, 10)."</h4>";
                        echo "       <h4 class=\"status-pembasmian ";
                        
                        if ($status_ID == 1) {
                            echo "       status-red\">";
                        } elseif ($status_ID == 5) {
                            echo "       status-green\">";
                        } else {
                            echo "       status-yellow\">";
                        }
                        
                        echo "      $status</h4>";
                        echo "   </div>";
                        echo "   <button class=\"tombol-detail-keluhan tombol-keluhan-hover\" name=\"detail-keluhan\" value=\"".$ID_tiket."\">Detail Keluhan</button>";
                        echo "</div>";
                    }
                } else {
                    echo "<h4 style=\"color: black; text-align: center;\">Tidak ada data</h4>";
                }
            ?>

        </form>


    </div>

    <div class="footer">
        <img class="footer-logo" src="/images/Logo-JAPERA.png" alt="Logo-JAPERA">
        <div class="footer-kontak">
            <p>Teknik Kimia</p>
            <p>Highway ITS, Sukolilo, Surabaya 60111</p>
            <p>Fax : +62-31-5939363</p>
            <p>Email : cs@japera.com</p>
        </div>
        <div class="footer-kontak">
            <p>Ikuti kami melalui media sosial</p>
            <img src="/images/Instagram.png" alt="instagram">
            <img src="/images/Tiktok.png" alt="tiktok">
            <img src="/images/Facebook.png" alt="facebook">
        </div>
        <br> <br> <br> <br>
    </div>


</body>
</html>