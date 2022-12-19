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
                <h5>Isi form dengan benar</h5>
            </div>
            <div class="bg-white rounded px-3 my-form-box mx-auto">
                <form method="POST" action="../assets/php/proses_cu_datadiri.php" onSubmit="return validateDataDiri()">
                    <p id="msgform" class="text-danger pt-3"></p>
                    
                    <!-- NIK -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="nik">NIK</label>
                        <input type="text" name="nik" class="form-control" placeholder="NIK sessuai KTP" id="idnik"
                        <?php 
                        $nik = $pendaftar['exist']? $pendaftar['nik'] : '';
                        echo 'value="'.$nik.'"'; 
                        ?>/>
                        <p id="msgnik" class="text-danger"></p>
                    </div>

                    <!-- Nama -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama sessuai KTP" id="idnama_lengkap"
                        <?php 
                        $nama = $pendaftar['exist']? $pendaftar['nama'] : '';
                        echo 'value="'.$nama.'"'; 
                        ?>/>
                        <p id="msgnama_lengkap" class="text-danger"></p>
                    </div>
                    
                    <!-- Tanggal Lahir -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" id="idtanggal_lahir"
                        <?php 
                        $tgl = $pendaftar['exist']? $pendaftar['tanggal_lahir'] : '';
                        echo 'value="'.$tgl.'"'; 
                        ?>/>
                        <p id="msgtanggal_lahir" class="text-danger"></p>
                    </div>

                    <!-- Tempat Lahir -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="nama_lengkap">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat lahir sessuai KTP" id="idtempat_lahir"
                        <?php 
                        $tempat_lahir = $pendaftar['exist']? $pendaftar['tempat_lahir'] : '';
                        echo 'value="'.$tempat_lahir.'"'; 
                        ?>/>
                        <p id="msgtempat_lahir" class="text-danger"></p>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="idjenis_kelamin">
                            <?php
                            $jenis_kelamin = $pendaftar['exist']? $pendaftar['jenis_kelamin'] : '';
                            $laki_selected = $jenis_kelamin == 'Laki-laki'? 'selected' : '';
                            $perempuan_selected = $jenis_kelamin == 'Perempuan'? 'selected' : '';
                            $hidden_selected = $jenis_kelamin == ''? 'selected' : '';
                            echo '
                            <option value="" '.$hidden_selected.' disabled hidden>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" '.$laki_selected.'>Laki-laki</option>
                            <option value="Perempuan" '.$perempuan_selected.'>Perempuan</option>                    
                            ';
                            ?>
                        </select>
                        <p id="msgjenis_kelamin" class="text-danger"></p>
                    </div>

                    <!-- Alamat -->   
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="alamat">Alamat</label>
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat sessuai KTP" id="idalamat"
                        <?php 
                        $alamat = $pendaftar['exist']? $pendaftar['alamat'] : '';
                        echo 'value="'.$alamat.'"'; 
                        ?>/>
                        <p id="msgalamat" class="text-danger"></p>
                    </div>

                    <!-- Agama -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="agama">Agama</label>
                        <select class="form-select" name="agama" id="idagama">
                            <?php
                                $agama = $pendaftar['exist']? $pendaftar['agama'] : '';
                                $data_agama = [
                                    '',
                                    'Islam',
                                    'Kristen',
                                    'Katolik',
                                    'Hindu',
                                    'Budha',
                                    'Konghucu'
                                ];

                                $data_selected = [
                                ];
                                foreach($data_agama as $temp){
                                    $selected = $temp == $agama? 'selected' : '';
                                    $data_selected[$temp] = $selected;
                                }
                                
                                foreach($data_agama as $temp){
                                    if($temp == ''){
                                        echo '<option value="" '.$data_selected[$temp].' disabled hidden>Pilih Agama</option>';
                                    }else{
                                        echo '<option value="'.$temp.'" '.$data_selected[$temp].'>'.$temp.'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <p id="msgagama" class="text-danger"></p>
                    </div>

                    <!-- Status Perkawinan -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="status_perkawinan">Status Perkawinan</label>
                        <select class="form-select" name="status_perkawinan" id="idstatus_perkawinan">
                        <?php
                                $status_perkawinan = $pendaftar['exist']? $pendaftar['status_perkawinan'] : '';
                                $data_perkawinan = [
                                    '',
                                    'Belum Kawin',
                                    'Kawin',
                                    'Cerai Hidup',
                                    'Cerai Mati'
                                ];

                                $data_selected = [
                                ];
                                foreach($data_perkawinan as $temp){
                                    $selected = $temp == $status_perkawinan? 'selected' : '';
                                    $data_selected[$temp] = $selected;
                                }
                                
                                foreach($data_perkawinan as $temp){
                                    if($temp == ''){
                                        echo '<option value="" '.$data_selected[$temp].' disabled hidden>Pilih Status Perkawinan</option>';
                                    }else{
                                        echo '<option value="'.$temp.'" '.$data_selected[$temp].'>'.$temp.'</option>';
                                    }
                                }
                            ?>
                        </select>
                        <p id="msgstatus_perkawinan" class="text-danger"></p>
                    </div>

                    <!-- Pendidikan Terakhir -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="kualifikasi_pendidikan">Pendidikan Terakhir</label>
                        <input type="text" name="kualifikasi_pendidikan" class="form-control" placeholder="Pendidikan Terakhir" id="idkualifikasi_pendidikan"
                        <?php 
                        $pendidikan = $pendaftar['exist']? $pendaftar['kualifikasi_pendidikan'] : '';
                        echo 'value="'.$pendidikan.'"'; 
                        ?>/>
                        <p id="msgkualifikasi_pendidikan" class="text-danger"></p>
                    </div>

                    <div><b>Jabatan dan Lokasi</b></div>
                    <!-- Unit kerja -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="id_unit_kerja">Unit Kerja</label>
                        <select class="form-select" name="id_unit_kerja" id="idunit_kerja">
                            <?php
                                $id_unit_kerja = $pendaftar['exist']? $pendaftar['id_unit_kerja'] : '';
                                // query data unit kerja
                                $sql = "SELECT * FROM unit_kerja";
                                $query = mysqli_query($db, $sql);
                                $data_unit_kerja = [
                                    '' => ''
                                ];
                                while($row = mysqli_fetch_array($query)){
                                    $data_unit_kerja[$row['id']]  = $row['nama_unit_kerja'];
                                }

                                
                                $data_selected = [
                                ];
                                foreach($data_unit_kerja as $key => $value){
                                    $selected = $key == $id_unit_kerja? 'selected' : '';
                                    $data_selected[$key] = $selected;
                                }
                                
                                foreach($data_unit_kerja as $key => $value){
                                    if($value == ''){
                                        echo '<option value="" '.$data_selected[$key].' disabled hidden>Pilih Unit Kerja</option>';
                                    }else{
                                        echo '<option value="'.$key.'" '.$data_selected[$key].'>'.$value.'</option>';
                                    }
                                }                            
                            ?>
                        </select>
                        <p id="msgunit_kerja" class="text-danger"></p>
                    </div>     

                    <!-- Lokasi kerja -->
                    <div class="form-outline mt-2">
                        <label class="form-label text-black" for="id_lokasi">Lokasi Pilihan</label>
                        <select class="form-select" name="id_lokasi" id="idlokasi">
                            <?php
                                $id_lokasi = $pendaftar['exist']? $pendaftar['id_lokasi'] : '';
                                // query data lokasi
                                $sql = "SELECT * FROM tabel_lokasi";
                                $query = mysqli_query($db, $sql);
                                $data_lokasi = [
                                    '' => ''
                                ];
                                while($row = mysqli_fetch_array($query)){
                                    $data_lokasi[$row['id']]  = $row['nama_dinas'].', '.$row['alamat_dinas'];
                                }

                                
                                $data_selected = [
                                ];
                                foreach($data_lokasi as $key => $value){
                                    $selected = $key == $id_unit_kerja? 'selected' : '';
                                    $data_selected[$key] = $selected;
                                }
                                
                                foreach($data_lokasi as $key => $value){
                                    if($value == ''){
                                        echo '<option value="" '.$data_selected[$key].' disabled hidden>Pilih Lokasi Kerja</option>';
                                    }else{
                                        echo '<option value="'.$key.'" '.$data_selected[$key].'>'.$value.'</option>';
                                    }
                                }                            
                            ?>
                        </select>
                        <p id="msglokasi" class="text-danger"></p>
                    </div>      

                    <!-- submit -->
                    <div class="d-grid mt-3">
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