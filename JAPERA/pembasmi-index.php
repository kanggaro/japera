<?php

session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

$it = 0;
$koordinator_ID = $_SESSION["ID"];
$result_proses = mysqli_query($conn, "SELECT * FROM tiketkeluhan WHERE status_ID != 5 AND koordinator_ID = $koordinator_ID ORDER BY ID DESC");

//$nama = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM  WHERE ID = $tiket_ID"));

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
    <link rel="stylesheet" href="/styles/pembasmi-index-styles.css">
    
</head>
<body>
    <div class="sideMenu sideMenu-hover">
        <img class="logo" src="/images/Logo-JAPERA.png" alt="Logo-JAPERA">
        <a class="menu-pilihan" href="pembasmi-index.php">Beranda</a>
        <a href="pembasmi-pekerjaan.php">Pekerjaan</a>

        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <a href="logout.php">
            <img src="/images/exit-icon.png" alt="exit" class="exit-button">
            Keluar
        </a>
        
    </div>

    <div class="content">
        <h1>Selamat Datang,</h1>
        <h1><?php echo $_SESSION["nama"] ?></h1>

        <div class="info">
            <h2>Pekerjaan</h2>

            <table>
                <tr>
                    <th><p>Tanggal Dibuat</p></th>
                    <th><p>ID</p></th>
                    <th><p>Status</p></th>
                </tr>
                <tr>
                    <td><br></td>
                </tr>

                <?php 
                    if (mysqli_num_rows($result_proses) > 0) {
                        while ($it < 3 && $data = mysqli_fetch_assoc($result_proses)) {
                            $tanggal_dibuat = $data["tanggal_dibuat"];
                            $tiket_ID = $data["ID"];
                            $status_ID = $data["status_ID"];
                            $status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM statuspembasmian WHERE ID = $status_ID"));
                            $status = $status["nama"];
                            
                            echo "<tr>";
                            echo "<td><p>$tanggal_dibuat</p></td>";
                            echo "<td><p>$tiket_ID</p></td>";
                            if ($status_ID == 1) {
                                echo "<td class=\"status-keluhan status-red\"><p>$status</p></td>";
                            } elseif ($status_ID == 5) {
                                echo "<td class=\"status-keluhan status-green\"><p>$status</p></td>";
                            } else {
                                echo "<td class=\"status-keluhan status-yellow\"><p>$status</p></td>";
                            }
                            echo "</tr>";
                            $it = $it + 1;
                        }
                    }
                    
                ?>
            </table>

            <a href="pembasmi-pekerjaan.php">Selengkapnya →</a>
        </div>
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