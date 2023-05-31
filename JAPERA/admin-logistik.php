<?php

session_start();
require 'functions.php';

$admin_ID = $_SESSION["ID"];
$admin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT nama FROM pegawaiadmin WHERE ID = $admin_ID"));
$admin = $admin["nama"];
$it = 1;

if ( !isset($_SESSION["login"]) ) {
    header("Location:login.php");
    exit;
}

if ( isset($_POST["edit-biaya"]) ) {
    $nama = $_POST["nama"];
    $jumlah = $_POST["jumlah"];
    $total_harga = $_POST["total-harga"];
    

    if ($_POST["edit-biaya"] == "kosongkan") {
        mysqli_query($conn, "DELETE FROM logistik");
    } elseif ($_POST["edit-biaya"] == "tambah") {
        mysqli_query($conn, "INSERT INTO logistik VALUES ('', '$nama', $jumlah, $total_harga, $admin_ID)");
    } elseif ($_POST["edit-biaya"] == "hapus") {
        mysqli_query($conn, "DELETE FROM logistik WHERE nama_barang = '$nama' AND jumlah = $jumlah AND total_harga = $total_harga");
    }
}

$result_logistik = mysqli_query($conn, "SELECT * FROM logistik");
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
    <link rel="stylesheet" href="/styles/admin-logistik-styles.css">
    
</head>
<body>
    <div class="sideMenu sideMenu-hover">
        <img class="logo" src="/images/Logo-JAPERA.png" alt="Logo-JAPERA">
        <a href="admin-index.php">Beranda</a>
        <a class="menu-pilihan" href="admin-logistik.php">Kelola Logistik</a>
        <a href="admin-keluhan.php">Keluhan Masuk</a>

        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
        <a href="logout.php">
            <img src="/images/exit-icon.png" alt="exit" class="exit-button">
            Keluar
        </a>
        
    </div>

    <div class="content">
        <h1>Daftar Kebutuhan Logistik</h1>        
            
                <table>
                    <tr>
                        <th>No.</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Admin</th>
                    </tr>
                    
                    <?php
                        
                        while($row = mysqli_fetch_assoc($result_logistik)) {
                            echo "<tr>";
                            echo "  <td>".$it."</td>";
                            $it = $it + 1;
                            echo "  <td>".$row["nama_barang"]."</td>";
                            echo "  <td>".$row["jumlah"]."</td>";
                            echo "  <td>".$row["total_harga"]."</td>";
                            echo "  <td>".$admin."</td>";
                            echo "</tr>";    
                        }
                    ?>
                </table>
                
                <br> <br>

                <div>
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