<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pegawai Kementrian Kelautan dan Perikanan</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php 
    require_once('path.php');
    include($paths['components'].'/navbar.php')?>
    <div class="text-center text-white p-5 mt-4">
        <h1>Selamat Datang</h1>
        <h3>Calon Pegawai Kementrian Kelautan dan Perikanan</h2>
    </div>
    <?php
    if(isset($_GET['status'])){
        if($_GET['status']=='sukses'){
            if($_GET['pesan']=='mendaftar'){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Anda berhasil mendaftar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else if($_GET['pesan']=='login'){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Anda berhasil login.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        else if($_GET['status']=='gagal'){
            if($_GET['pesan']=='mendaftar'){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Gagal Mendaftar
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            else if($_GET['pesan']=='login'){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Maaf!</strong> Gagal Login
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    }
    ?>
    <!-- image slide -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div id="img1" class="back-slide-img"></div>
            <img src="https://www.beritatrans.com/images/content/1/2021/2021-01-29/1a338e394c19e9a15ad6a12bcc635110.jpeg" class="d-block h-100 imslide" alt="">
        </div>
        <div class="carousel-item">
            <div id="img2"class="back-slide-img"></div>
            <img src="https://merahputih.com/media/2015/04/23/s2rKVMdNR51429767341.jpg" class="d-block h-100 imslide" alt="">
        </div>
        <div class="carousel-item">
            <div id="img3"class="back-slide-img"></div>
            <img src="https://kkp.go.id/an-component/media/upload-gambar-pendukung/brsdm/Foto%20Berita/WhatsApp%20Image%202022-05-05%20at%202.31.59%20PM%20(1).jpeg" class="d-block h-100 imslide" alt="">
        </div>
    </div>
    <div class="container pt-5">

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>

        <!-- sign login button -->
        <div class="d-flex justify-content-center">
            <a href="pages/form_signup.php" class="btn px-5 mx-5 btn-lg text-white fw-semibold" id="daftar_btn">
                Daftar
            </a>
            <a href="pages/form_login.php" class="btn px-5 mx-5 btn-lg text-white fw-semibold" id="login_btn">
                Masuk
            </a>
        </div>
    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php include($paths['components'].'/footer.php')?>
</body>
</html>