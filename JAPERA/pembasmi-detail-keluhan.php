<?php

session_start();
require 'functions.php';

if ( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

$it = 1;
$tiket_ID = $_SESSION["ID_tiket_keluhan"];
$result_detail = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tiketkeluhan WHERE ID = $tiket_ID"));
$koordinator_ID = $result_detail["koordinator_ID"];

if ( isset($_POST["terima_pekerjaan"]) ) {
    $koordinator_ID = $_SESSION["ID"];
    mysqli_query($conn, "UPDATE tiketkeluhan SET status_ID = 2 WHERE ID = $tiket_ID");
    mysqli_query($conn, "UPDATE koordinatorpembasmi SET sedang_bekerja = 1 WHERE ID = $koordinator_ID");
    header("Location: pembasmi-pekerjaan.php");
}

if ( isset($_POST["edit-biaya"]) ) {
    $nama = $_POST["nama"];
    $jumlah = $_POST["jumlah"];
    $total_harga = $_POST["total-harga"];

    if ($_POST["edit-biaya"] == "kosongkan") {
        mysqli_query($conn, "DELETE FROM biayalayanan WHERE tiket_ID = $tiket_ID");
    } elseif ($_POST["edit-biaya"] == "tambah") {
        mysqli_query($conn, "INSERT INTO biayalayanan VALUES ('', $tiket_ID, '$nama', $jumlah, $total_harga)");
    } elseif ($_POST["edit-biaya"] == "hapus") {
        mysqli_query($conn, "DELETE FROM biayalayanan WHERE tiket_ID = $tiket_ID AND nama = '$nama' AND jumlah = $jumlah AND total_harga = $total_harga");
    }

    //$koordinator_ID = $_SESSION["ID"];
    //mysqli_query($conn, "UPDATE tiketkeluhan SET status_ID = 2 WHERE ID = $tiket_ID");
    //mysqli_query($conn, "UPDATE koordinatorpembasmi SET sedang_bekerja = 1 WHERE ID = $koordinator_ID");
}

if (isset($_POST["ubah-pantau"])) {
    mysqli_query($conn, "UPDATE tiketkeluhan SET status_ID = 4 WHERE ID = $tiket_ID");
    header("Location:pembasmi-pekerjaan.php");
}

if (isset($_POST["ubah-selesai"])) {
    mysqli_query($conn, "UPDATE tiketkeluhan SET status_ID = 5 WHERE ID = $tiket_ID");
    mysqli_query($conn, "UPDATE koordinatorpembasmi SET sedang_bekerja = 0 WHERE ID = $koordinator_ID");
    header("Location:pembasmi-pekerjaan.php");
}

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

$result_koordinator = mysqli_query($conn, "SELECT * FROM koordinatorpembasmi");
$result_biaya_layanan = mysqli_query($conn, "SELECT * FROM biayalayanan WHERE tiket_ID = $tiket_ID");
$total_biaya_layanan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_harga) AS total FROM biayalayanan WHERE tiket_ID = $tiket_ID"));
$total_biaya_layanan = $total_biaya_layanan["total"];
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
    <link rel="stylesheet" href="/styles/pembasmi-detail-keluhan-styles.css">
    
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
                if ($koordinator_sedang_bekerja == 0 && $status_ID != 5) {
                    echo "<h3>Koordinator Tim </h3>";
                    echo "<h4>Menunggu koordinator untuk menerima pekerjaan</h4>";
                    echo "<br><br><br><br>";
                    echo "  <form action=\"\" method=\"post\">";
                    echo "      <button type=\"submit\" class=\"submit-button submit-button-hover\" name =\"terima_pekerjaan\" value=\"terima_pekerjaan\">Terima Pekerjaan</button>";
                    echo "  </form>";
                }
            ?>
            
            <br><br>

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
                            echo "  <td>Rp".$row["total_harga"]."</td>";
                            echo "</tr>";    
                        }
                    ?>
                </table>
                                
                <h4>Total Biaya = <?php echo "Rp$total_biaya_layanan" ?></h4>

                <br>
                <?php 
                    if ($status_ID == 2) {
                        echo "<div>";
                        
                    } else {
                        echo "<div style=\"display: none;\">";
                    }
                ?>
                    <form action="" method="post">
                            <table>
                                <tr>
                                    <td><label for="nama">Nama</label></td>
                                    <td><input type="text" name="nama"></td>
                                </tr>
                                <tr>
                                    <td><label for="jumlah">Jumlah</label></td>
                                    <td><input type="text" name="jumlah"></td>
                                </tr>
                                <tr>
                                    <td><label for="total-harga">Total harga</label></td>
                                    <td><input type="text" name="total-harga"></td>
                                </tr>
                                <tr>
                                    <td><button type="submit" name="edit-biaya" value="kosongkan">Kosongkan</button></td>
                                    <td>
                                        <button type="submit" name="edit-biaya" value="tambah">Tambah</button>
                                        <button type="submit" name="edit-biaya" value="hapus">Hapus</button>
                                    </td>
                                </tr>
                            </table>
                    </form>
                </div>
                
            </div>

            <?php 
                echo "<form action=\"\" method=\"post\">";
                if ($status_ID == 3) {
                    echo "  <button type=\"submit\" class=\"submit-button submit-button-hover\" name =\"ubah-pantau\" value=\"ubah-pantau\">Mulai Pemantauan</button>";
                } else if ($status_ID == 4) {
                    echo "  <button type=\"submit\" class=\"submit-button submit-button-hover\" name =\"ubah-selesai\" value=\"ubah-selesai\">Selesaikan Tiket</button>";
                }
                echo "</form>";
            ?>
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