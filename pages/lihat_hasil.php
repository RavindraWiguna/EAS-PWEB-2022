<?php
include("../assets/php/auth_checker.php");
check(1);
?>
<?php
include("../config.php");
include('../assets/php/proses_ambil_hasil.php');
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
            <div class="d-flex flex-column text-center text-white mt-4 mb-2">
                <h5>Hasil Anda</h5>
            </div>
            <div class="bg-white rounded px-3 mx-auto my-form-box shadow">
                <div class="pt-4"></div>
                <?php

                $show_names = [ 
                    'path_berkas' => 'KTP dan Ijazah',
                    'path_foto' => 'Pas Foto',
                ];


                if($hasil['status_pendaftaran']==1){
                    $ujian_is_set = $hasil['id_sesi']==5?false:true;
                    echo '
                    <div class="alert alert-success" role="alert">
                        <p><b>Selamat!</b></p>
                        <p>Anda dinyatakan <b>lolos</b> seleksi berkas</p>
                    </div>';
                    if($ujian_is_set){
                        echo '
                        <p>Berikut adalah jadwal ujian anda:</p>
                        <table class="table table-hover mx-auto">
                        <thead>
                            <tr>
                            <th scope="col" class="text-center"></th>
                            <th scope="col" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
                        echo '
                        <tr>
                        <th scope="row" class="align-middle">Lokasi Ujian</th>
                        <td>Dinas Kelautan dan Perikanan Provinsi Jawa Timur<br>Jl. Ahmad Yani No.152 B, Gayungan, Kec. Gayungan, Kota SBY, Jawa Timur</td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle">Tanggal Ujian</th>
                        <td>16 Januari 2023</td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle">Sesi Ujian</th>
                        <td>1</td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle">Waktu Mulai</th>
                        <td>08:00 (WIB)</td>
                        </tr>
                        <tr>
                        <th scope="row" class="align-middle">Waktu Selesai</th>
                        <td>09:30 (WIB)</td>
                        </tr>
                        ';
                        echo '
                        </tbody>
                        </table>
                        ';
                        echo '
                        <p>Anda dapat mencetak kartu ujian pada tombol di bawah ini</p>
                        <div class="pb-3 d-grid">
                            <a href="../assets/php/cetak_kartu_ujian.php" class="btn btn-primary">Cetak Kartu Ujian</a>
                        </div>
                        ';
                    }else{
                        echo '
                        <p>Tanggal dan Sesi Ujian Belum ditentukan</p>
                        ';
                    }

                }
                else if($hasil['status_pendaftaran']==-1){
                    echo '
                    <div class="alert alert-warning" role="alert">
                        <p><b>Maaf</b></p>
                        <p>Anda dinyatakan <b>tidak lolos</b> seleksi berkas</p>
                        <p><b>JANGAN PUTUS ASA DAN TETAP SEMANGAT!</b></p>
                    </div>
                    ';
                }
                else{
                    echo '
                    <div class="alert alert-primary" role="alert">
                        <p><b>Hasil Belum Keluar</b></p>
                        <p>Anda belum dinyatakan lolos atau tidak lolos seleksi berkas</p>
                        <p>Hasil akan keluar pada tanggal <b>13 Januari 2023</b></p>
                    </div>
                    
                    ';
                }
                ?>
                <div class="pt-2"></div>
            </div>
        </div>
    </div>
    <?php include('components/footer.php');?>

    <script src="../assets/js/validator.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>