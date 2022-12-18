<?php
include("../assets/php/auth_checker.php");
check(1);
?>
<?php
include("../config.php");
include('../assets/php/proses_ambil_datadiri.php');
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
    <!-- Add icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include('components/navbar.php')?>
    <div class="main-gradient pt-5">
        <div class="container">
            <div class="d-flex flex-column text-center text-white mt-4 mb-2">
                <h5>Unggah berkas yang diperlukan</h5>
            </div>
            <div class="bg-white rounded px-3 my-form-box mx-auto">
                <form method="POST" action="../assets/php/proses_cu_datadiri.php" onSubmit="return validateBerkas()" enctype="multipart/form-data">
                    <p id="msgform" class="text-danger pt-3"></p>

                    <!-- berkas -->
                    <div class="form-outline mt-2">
                        <label for="berkas" class="form-label">Berkas (Scan Foto KTP Berwarna dan Ijazah berformat pdf di compress ke dalam format .rar/zip)</label>
                        <input class="form-control" type="file" name="berkas" id="idberkas" accept=".rar, .zip">
                        <div id="" class="form-text">Ukuran maksimal 1MB</div>
                        <p id="msgberkas" class="text-danger"></p>
                    </div>

                    <!-- pas foto -->
                    <div class="form-outline mt-2">
                        <label for="pasfoto" class="form-label">Pas Foto (4x6 Berwarna berformat .png/jpg/jpeg)</label>
                        <input class="form-control" type="file" name="pasfoto" id="idpasfoto" accept=".png, .jpg, .jpeg" onchange="loadFile(event)">
                        <div id="" class="form-text">Ukuran maksimal 100KB</div>
                        <img src="" alt="" id="preview">
                        <p id="msgpasfoto" class="text-danger"></p>
                    </div>

                    <!-- submit -->
                    <div class="d-flex justify-content-between mt-3">
                        <input type="submit" class="btn btn-primary btn-block mb-4" name="isi_berkas" value="Selesai"/>         
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('components/footer.php');?>

    <script src="../assets/js/validator.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>