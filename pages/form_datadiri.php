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
                <h5>Isi form dengan benar sesuai yang tertera pada KTP</h5>
            </div>
            <div class="bg-white rounded px-3 my-form-box mx-auto">
                <form method="POST" action="../assets/php/proses_cu_datadiri.php" onSubmit="return validateDataDiri()">
                    <p id="msgform" class="text-danger pt-3"></p>
                    
                    <!-- NIK -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder="NIK sessuai KTP" id="idnik"/>
                        <p id="msgnik" class="text-danger"></p>
                    </div>

                    <!-- Nama -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama sessuai KTP" id="idnama_lengkap"/>
                        <p id="msgnama_lengkap" class="text-danger"></p>
                    </div>
                    
                    <!-- Tanggal Lahir -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="idtanggal_lahir"/>
                        <p id="msgtanggal_lahir" class="text-danger"></p>
                    </div>

                    <!-- Tempat Lahir -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="nama_lengkap">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir sessuai KTP" id="idtempat_lahir"/>
                        <p id="msgtempat_lahir" class="text-danger"></p>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="idjenis_kelamin">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <p id="msgjenis_kelamin" class="text-danger"></p>
                    </div>

                    <!-- Agama -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="agama">Agama</label>
                        <select class="form-select" name="agama" id="idagama">
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                        <p id="msgagama" class="text-danger"></p>
                    </div>

                    <!-- Status Perkawinan -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="status_perkawinan">Status Perkawinan</label>
                        <select class="form-select" name="status_perkawinan" id="idstatus_perkawinan">
                            <option value="Belum Kawin">Belum Kawin</option>
                            <option value="Kawin">Kawin</option>
                            <option value="Cerai Hidup">Cerai Hidup</option>
                            <option value="Cerai Mati">Cerai Mati</option>
                        </select>
                        <p id="msgstatus_perkawinan" class="text-danger"></p>
                    </div>

                    <!-- submit -->
                    <div class="d-flex justify-content-between mt-3">
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