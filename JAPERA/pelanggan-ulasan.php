<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <title>Buat Keluhan</title>
    <style>
        *{
            /* border: 1px solid red; */
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #7E643A; ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="img/j2.png" alt="Bootstrap" width="122" height="30" style="margin:10px 100px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="keluhanku.php">Keluhanku</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#7E643A;">
                        <img src="img/person.png" alt="" width="50" height="50" style="margin:0px 100px">
                    </a>
                    <ul class="dropdown-menu">
                        <li> <a class="dropdown-item" href="myprofile.php">My Profile</a></li>
                        <li> <a class="dropdown-item" href="index.php">Kembali ke Beranda</a></li>
                        <li> <a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>    
                </div>
            </div>
        </div>
    </nav>
<!-- END NAVBAR -->

<!-- body -->
    <div class="body"style="margin: 5rem;">
        <h1 class="d-flex justify-content-center" style="margin:115px 0 35px 0; color:#544021;">Beri Ulasan</h1>

        <form action="" method="post">
            <h3 class="d-flex justify-content-center" style="margin:0 0 0 0; color:#544021;">Penilaian Untuk Layanan</h3><br><br>
            <div class="d-flex justify-content-center">
                <img src="img/star 4.png" alt="" width="75px">
                <img src="img/star 6.png" alt="" width="75px">
                <img src="img/star 6.png" alt="" width="75px">
                <img src="img/star 6.png" alt="" width="75px">
                <img src="img/star 6.png" alt="" width="75px">
            </div><br><br><br>

            
            <h3 class="d-flex justify-content-center" style="margin:0 0 0 0; color:#544021;">Deskripsi Ulasan</h3><br><br>    
            <div class="container d-flex justify-content-center">
                <div class="col-sm-5">
                    <textarea class="form-control border-secondary" aria-label="With textarea"></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-center" style="margin-top:45px;">
                <button class="btn" type="submit" name="kirim" style="background-color:#CDAC76; font-weight: 600; color:white; padding:10px 200px">kirim</button>
            </div>
        </form>
    </div>
<!-- body     -->

<!-- footer -->
    <div class="row text-white" style="background-color:#7E643A; padding:50px 250px">
        <div class="col">
            <img src="img/j3.png" alt="">
        </div>
        <div class="col">
            <h6 style="font-weight:250;">Teknik Kimia Street</h6>
            <h6 style="font-weight:250;">Highway ITS, Sukolilo, Surabaya 60111</h6>
            <h6 style="font-weight:250;">Fax : +62-31-5939363</h6>
            <h6 style="font-weight:250;">email : cs@japera.com</h6>
        </div>
        <div class="col" style="margin-right:-250px">
                
                <p>ikuti kami melalui media sosial:</p>

                <img src="img/ig.png" alt="">
                <img src="img/tk.png" alt="" style="margin:0 55px">
                <img src="img/fb.png" alt="">

        </div>
    </div>
<!-- end footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>