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
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include('components/navbar.php')?>
    <div class="main-gradient pt-5">
        <div class="container">
            <div class="d-flex flex-column text-center text-white mt-4">
                <h5>Isi form dengan benar sesuai yang tertera pada KTP</h5>
            </div>
            <div class="bg-white rounded px-3 auth-box mx-auto">
                <form method="POST" action="../assets/php/proses_cu_datadiri.php" onSubmit="return validateDataDiri()">
                    <p id="msgform" class="text-danger pt-3"></p>
                    
                    <!-- NIK -->   
                    <div class="form-outline mt-1">
                        <label class="form-label text-black" for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder="NIK sessuai KTP" id="idnik"/>
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mt-3">
                        <label class="form-label text-black" for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Password akun" id="idpassword"/>
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="showPassword(event)">
                                <img src="../assets/media/eye-closed.svg" alt="" style="width:16px">
                            </button>
                        </div>
                    </div>
                    
                    <!-- Login and Signin -->
                    <div class="d-flex justify-content-between mt-2">
                        <!-- submit -->
                        <input type="submit" class="btn btn-primary btn-block mb-4" name="isi_data_diri" value="Selesai"/>         
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