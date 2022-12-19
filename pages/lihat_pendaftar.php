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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include('components/navbar.php')?>
    <?php
        // simpan pendaftar yang dilihat pada session
        $_SESSION['pendaftar'] = $pendaftar;
    ?>
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
            <?php
            // cek apakah ada pesan gagal meloloskan peserta atau menggagalkan peserta
            if(isset($_GET['status'])){
                if($_GET['status'] == 'gagal'){
                    if($_GET['pesan']== 'gagal'){
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal!</strong> Pendaftar gagal digagalkan.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
                    }
                    else if($_GET['pesan']== 'lolos'){
                        echo '
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Gagal!</strong> Pendaftar gagal diloloskan.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
                    }
                }
            }
            ?>
            <div class="bg-white rounded px-3 mx-auto my-form-box shadow">
                <div class="pt-2"></div>
                <?php

                $show_names = [ 
                    'nik' => 'NIK',
                    'nama' => 'Nama Lengkap',
                    'tempat_lahir' => 'Tempat Lahir',
                    'tanggal_lahir' => 'Tanggal Lahir',
                    'jenis_kelamin' => 'Jenis Kelamin',
                    'agama' => 'Agama',
                    'status_perkawinan' => 'Status Perkawinan',
                    'alamat' => 'Alamat',
                    'kualifikasi_pendidikan' => 'Kualifikasi Pendidikan',
                    'nama_unit_kerja' => 'Unit Kerja',
                    'lokasi_joined' => 'Lokasi Pilihan',
                ];

                $map_status = [
                    -1 => 'Gagal ke tahap selanjutnya',
                    0 => 'Belum Terverifikasi',
                    1 => 'Lolos ke tahap selanjutnya',
                    ''=> 'Belum mengisi berkas'
                ];

                $map_class_status = [
                    -1 => 'table-danger',
                    0 => 'table-warning',
                    1 => 'table-success',
                    ''=> 'table-secondary'
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
                    echo '
                    <tr>
                        <th scope="row" class="table-dark">Status Pendaftaran</th>
                        <td class="'.$map_class_status[$pendaftar['status_pendaftaran']].'">'.$map_status[$pendaftar['status_pendaftaran']].'</td>
                    </tr>
                    ';
                    $path_berkas = $pendaftar['path_berkas']==''? '#': $app_url.$pendaftar['path_berkas'];
                    $path_foto = $pendaftar['path_foto']==''? '#': $app_url.$pendaftar['path_foto'];
                    $berkas_disabled = $pendaftar['path_berkas']==''? 'disabled': '';
                    $foto_disabled = $pendaftar['path_foto']==''? 'disabled': '';
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
                                <a href="'.$path_berkas.'" class="btn btn-info '.$berkas_disabled.'"  download="">Unduh</a>
                            </div>
                        </div>
                        <div class="">
                            <p>Pas Foto</p>
                            <img src="'.$path_foto.'" alt="" style="width:50%; margin-bottom:10px">
                            <div class="pb-3 d-grid">
                                <a href="'.$path_foto.'" class="btn btn-info '.$foto_disabled.'" download="">Unduh</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop3">
                            <i class="fa fa-trash" aria-hidden="true"></i> Hapus Data
                            </button>
                        </div>
                        <div>';
                    if($pendaftar['status_pendaftaran'] == 0){
                        echo '
                            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            ✕ Tidak memenuhi syarat
                            </button>
                            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            ✓ Memenuhi syarat
                            </button>
                        ';
                    }else if($pendaftar['status_pendaftaran'] == 1){
                        echo '
                            <button type="button" class="btn btn-danger mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            ✕ Ganti status ke tidak memenuhi syarat
                            </button>
                        ';
                    }else if($pendaftar['status_pendaftaran'] == -1){
                        echo '
                            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            ✓ Ganti status ke memenuhi syarat
                            </button>
                        ';
                    }

                    echo '
                        </div>
                    </div>
                    <div>
                        <a class="btn btn-primary btn-block mb-4" href="javascript:history.back()">← Kembali</a>
                    </div>
                    <!-- Modal1 -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Anda yakin menggagalkan peserta ini?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                Harap dicek dengan seksama sebelum membuat keputusan
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                            <a href="../assets/php/proses_gagalkan_pendaftar.php" class="btn btn-danger">Ya, saya yakin</a>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- Modal2 -->
                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Anda yakin meloloskan peserta ini?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-success" role="alert">
                                Harap dicek dengan seksama sebelum membuat keputusan
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                            <a href="../assets/php/proses_loloskan_pendaftar.php" class="btn btn-success">Ya, saya yakin</a>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- Modal3 -->
                    <div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Anda yakin menghapus data peserta ini?</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-danger" role="alert">
                                Harap dicek dengan seksama sebelum membuat keputusan
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                            <a href="../assets/php/proses_hapus_pendaftar.php" class="btn btn-danger">Ya, saya yakin</a>
                        </div>
                        </div>
                    </div>
                    </div>
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