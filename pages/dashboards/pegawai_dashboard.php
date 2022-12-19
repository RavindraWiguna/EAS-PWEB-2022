<?php
include("../../assets/php/auth_checker.php");
check(2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Pegawai Kementrian Kelautan dan Perikanan</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php 
    include("../components/navbar.php")?>
    <div class="text-center text-white p-5 mt-4">
        <h1>Selamat Datang</h1>
        <?php
        echo '<h3>'.$_SESSION['user']['name'].'</h3>';
        ?>
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
            // cek apakah berhasil menghapus data
            else if($_GET['pesan']=='hapus'){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>!!!</strong> Anda berhasil menghapus data.
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

    <?php
    include('../components/pengumuman.php');
    ?>
    </div>
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <?php include('../components/footer.php')?>
</body>
</html>