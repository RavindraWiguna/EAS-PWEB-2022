<?php
include("../assets/php/auth_checker.php");
check(2);
?>
<?php
include("../config.php");
include('../assets/php/proses_ambil_satu_pendaftar.php');
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
                <h5>Data Diri <br>
                <?php
                if($pendaftar['exist']){
                    echo $pendaftar['nama'];
                }else{
                    echo 'Tidak Ditemukan';
                }
                ?>
                </h5>
            </div>
            <div class="bg-white rounded px-3 mx-auto my-form-box shadow">
                <div class="pt-2"></div>
                <?php

                $show_names = [ 
                    'nik' => 'NIK',
                    'nama_lengkap' => 'Nama Lengkap',
                    'tempat_lahir' => 'Tempat Lahir',
                    'tanggal_lahir' => 'Tanggal Lahir',
                    'jenis_kelamin' => 'Jenis Kelamin',
                    'agama' => 'Agama',
                    'status_perkawinan' => 'Status Perkawinan',
                    'alamat' => 'Alamat',
                    'kualifikasi_pendidikan' => 'Kualifikasi Pendidikan',
                ];

                if($pendaftar['exist']){
                    echo '
                    <table class="table table-hover mx-auto">
                    <thead>
                        <tr>
                        <th scope="col" class="text-center">Atribut</th>
                        <th scope="col" class="text-center">Data</th>
                        </tr>
                    </thead>
                    <tbody>
                    ';
                    foreach($pendaftar as $key => $value){
                        if(array_key_exists($key, $show_names)){
                            $key = $show_names[$key];
                            echo '
                            <tr>
                                <th scope="row">'.$key.'</th>
                                <td>'.$value.'</td>
                            </tr>
                            ';
                        }
                    }
                    // $basename = basename($pendaftar['path_foto']);
                    // $ext = pathinfo($basename, PATHINFO_EXTENSION);
                    // $nama_file_foto = $pendaftar['id'].'_'.$pendaftar['nama'].'_foto.'.$ext;
                    echo '
                    </tbody>
                    </table>
                    <div class="d-grid gap-2">
                        <div class="">
                            <p>File Berkas</p>
                            <div class="pb-3 d-grid">
                                <a href="'.$app_url.$pendaftar['path_berkas'].'" class="btn btn-success"  download="">Unduh</a>
                            </div>
                        </div>
                        <div class="">
                            <p>Foto</p>
                            <img src="'.$app_url.$pendaftar['path_foto'].'" alt="" style="width:50%; margin-bottom:10px">
                            <div class="pb-3 d-grid">
                                <a href="'.$app_url.$pendaftar['path_foto'].'" class="btn btn-success" download="">Unduh</a>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary btn-block mb-4" href="javascript:history.back()">Kembali</a>
                    ';
                }else{
                    echo '
                    <div class="alert alert-danger pt-3 mt-3 text-center" role="alert">
                        Tidak Ditemukan
                    </div>';
                }
                ?>

            </div>
        </div>
    </div>
    <?php include('components/footer.php');?>

    <script src="../assets/js/validator.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>