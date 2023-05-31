<?php

session_start();
require 'functions.php';
error_reporting(0);

if ( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

$it = 1;
$tiket_ID = $_SESSION["ID_tiket_keluhan"];

if ( isset($_POST["beri_pekerjaan"]) ) {
    $koordinator = $_POST["nama-koordinator"];
    mysqli_query($conn, "UPDATE tiketkeluhan SET koordinator_ID = $koordinator WHERE ID = $tiket_ID");
    //mysqli_query($conn, "UPDATE koordinatorpembasmi SET sedang_bekerja = 1 WHERE ID = $koordinator");
}

if (isset($_POST["ubah_mulai_basmi"])) {
    mysqli_query($conn, "UPDATE tiketkeluhan SET status_ID = 3 WHERE ID = $tiket_ID");
}

$result_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tiketkeluhan WHERE ID = $tiket_ID"));
$serangga_ID = $result_detail["serangga_ID"];
$serangga = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM jenisserangga WHERE ID = $serangga_ID"));
$serangga = $serangga["nama"];
$tempat_ID = $result_detail["tempat_ID"];
$tempat = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM jenistempat WHERE ID = $tempat_ID"));
$tempat = $tempat["nama"];
$foto_sarang = $result_detail["foto_sarang"];
$status_ID = $result_detail["status_ID"];
$status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM statuspembasmian WHERE ID = $status_ID"));
$status = $status["nama"];
$koordinator_ID = $result_detail["koordinator_ID"];
$koordinator = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama, no_telepon FROM koordinatorpembasmi WHERE ID = $koordinator_ID"));
$koordinator_nama = $koordinator["nama"];
$koordinator_no = $koordinator["no_telepon"];
$koordinator_sedang_bekerja = mysqli_fetch_assoc(mysqli_query($conn, "SELECT sedang_bekerja FROM koordinatorpembasmi WHERE ID = $koordinator_ID"));
$koordinator_sedang_bekerja = $koordinator_sedang_bekerja["sedang_bekerja"];
$pelanggan_ID = $result_detail["pelanggan_ID"];
$pelanggan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama, no_telepon, alamat FROM pelanggan WHERE ID = $pelanggan_ID"));
$pelanggan_nama = $pelanggan["nama"];
$pelanggan_no = $pelanggan["no_telepon"];
$pelanggan_alamat = $pelanggan["alamat"];
$bukti_bayar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT bukti_bayar FROM tiketkeluhan WHERE ID = $tiket_ID"));
$bukti_bayar = $bukti_bayar["bukti_bayar"];

$result_koordinator = mysqli_query($conn, "SELECT * FROM koordinatorpembasmi");
$result_biaya_layanan = mysqli_query($conn, "SELECT * FROM biayalayanan WHERE tiket_ID = $tiket_ID");
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
    <link rel="stylesheet" href="/styles/admin-detail-keluhan-styles.css">
    
</head>
<body>
    <div class="sideMenu sideMenu-hover">
        <img class="logo" src="/images/Logo-JAPERA.png" alt="Logo-JAPERA">
        <a href="admin-index.php">Beranda</a>
        <a href="admin-logistik.php">Kelola Logistik</a>
        <a class="menu-pilihan" href="admin-keluhan.php">Keluhan Masuk</a>

        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <a href="logout.php">
            <img src="/images/exit-icon.png" alt="exit" class="exit-button">
            Keluar
        </a>
        
    </div>

    <div class="content">
        <h1>Detail Keluhan</h1>

        <div class="section-1">
            <img <?php echo "src=\"images/$serangga.png\""; ?> >
            <div class="detail-1">
                <h3 class="judul-pembasmian"><?php echo $result_detail["judul_pembasmian"] ?></h3>
                <p><b>ID:   </b><?php echo $result_detail["ID"] ?></p>
                <p><b>Keluhan dibuat:   </b><?php echo substr($result_detail["tanggal_dibuat"], 0, 10) ?></p>
                <p><b>Estimasi pembasmian hingga:   </b><?php echo substr($result_detail["estimasi_selesai"], 0, 10) ?></p>
                <p><b>Jenis Tempat: </b><?php echo $tempat ?></p>
            </div>
        </div>

        <div class="section-2">
            <h3>Foto Sarang:</h3>
            <img <?php echo "src=\"images/foto_sarang/$foto_sarang\""; ?> alt="Sarang rayap">
        </div>

        <hr>

        <div class="section-3">
            <h3>STATUS:</h3>
            <?php 
                if ($status_ID == 1) {
                    echo "<p class=\"status-red\">$status</p>";
                } elseif ($status_ID == 5) {
                    echo "<p class=\"status-green\">$status</p>";
                } else {
                    echo "<p class=\"status-yellow\">$status</p>";
                }
            ?>
            
            
            <br>
            
            <h3>Klien</h3>
            <h4><?php echo "$pelanggan_nama ($pelanggan_no - $pelanggan_alamat)" ?></h4>

            <br>

            <?php 
                if ($koordinator_ID == 1) {
                    echo "<div>";
                    echo "  <h3>Koordinator Tim </h3>";
                    echo "  <br>";
                    echo "  <form action=\"\" method=\"post\">";
                    echo "      <select class=\"nama-koordinator\" name=\"nama-koordinator\">";
                                    
                    while ($data = mysqli_fetch_assoc($result_koordinator)) {
                        if ($data["sedang_bekerja"] == 0 && $data["spesialis_tim"] == $serangga) {
                            $koordinator_terpilih = $data["nama"];
                            $koordinator_terpilih_ID = $data["ID"];
                            echo "<option value=\"$koordinator_terpilih_ID\">$koordinator_terpilih</option>";
                        }
                    }
                                        
                    echo "      </select>";
                    echo "      <br> <br> <br>";
                    echo "      <button type=\"submit\" class=\"submit-button submit-button-hover\" name =\"beri_pekerjaan\" value=\"beri_pekerjaan\">Berikan Pekerjaan</button>";
                    echo "  </form>";
                    echo "</div>";
                    
                } elseif ($koordinator_sedang_bekerja == 0) {
                    echo "<h3>Koordinator Tim </h3>";
                    echo "<h4>Menunggu koordinator untuk menerima pekerjaan</h4>";
                } elseif ($koordinator_sedang_bekerja == 1) {
                    echo "<h3>Koordinator Tim </h3>";
                    echo "<h4>$koordinator_nama ($koordinator_no)</h4>";
                    echo "<br><br><br>";
                }
            ?>
            
            <?php 
                if ($status_ID == 1) {
                    echo "<div style=\"display: none;\">";
                    
                } else {
                    echo "<h3>Biaya Layanan </h3>";
                    echo "<div>";
                }
            ?>
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                    
                    <?php
                        
                        while($row = mysqli_fetch_assoc($result_biaya_layanan)) {
                            echo "<tr>";
                            echo "  <td>".$it."</td>";
                            $it = $it + 1;
                            echo "  <td>".$row["nama"]."</td>";
                            echo "  <td>".$row["jumlah"]."</td>";
                            echo "  <td>".$row["total_harga"]."</td>";
                            echo "</tr>";    
                        }
                    ?>
                </table>
                
                <h3>Bukti Pembayaran</h3>
                
                <br><br>
                
                <?php
                    if (empty($bukti_bayar)) {
                        echo "<h4>Pelanggan belum mengunggah bukti pembayaran</h4>";
                    } else {
                        echo "<img src=\"images/bukti_bayar/$bukti_bayar\" style=\"width: 300px;\"> <br><br><br>";
                        
                        if ($status_ID == 2) {
                            echo "<form action=\"\" method=\"post\">";
                            echo "  <button type=\"submit\" class=\"submit-button submit-button-hover\" name =\"ubah_mulai_basmi\" value=\"ubah_mulai_basmi\">Mulai Pembasmian</button>";
                            echo "</form>";
                        }
                        
                    }
                ?>
                
            </div>
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