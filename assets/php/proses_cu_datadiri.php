<?php
include("../../config.php");
include('proses_ambil_datadiri.php');

if(!session_id()) session_start();

//ambil id
$id = $_SESSION['user']['id'];

if(isset($_POST['isi_data_diri'])){

    // nama kolom tabel
    // id	id_akun	nik	nama	tanggal_lahir	tempat_lahir	jenis_kelamin	alamat	agama	status_perkawinan	path_berkas	path_foto	

    // ambil data dari formulir
    $nik = $_POST['nik'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $agama = $_POST['agama'];
    $status_perkawinan = $_POST['status_perkawinan'];
    $kualifikasi_pendidikan = $_POST['kualifikasi_pendidikan'];
    $id_unit_kerja = $_POST['id_unit_kerja'];
    $id_lokasi = $_POST['id_lokasi'];

    if($pendaftar['exist']){
        // ada pendaftar berarti kita update data

        // buat query update
        $sql = "UPDATE pendaftar SET 
        nik='$nik', 
        nama='$nama_lengkap', 
        tanggal_lahir='$tanggal_lahir', 
        tempat_lahir='$tempat_lahir', 
        jenis_kelamin='$jenis_kelamin', 
        alamat='$alamat', 
        agama='$agama', 
        status_perkawinan='$status_perkawinan',
        kualifikasi_pendidikan='$kualifikasi_pendidikan',
        id_unit_kerja='$id_unit_kerja',
        id_lokasi='$id_lokasi'
        WHERE id_akun=$id";

        // eksekusi query update
        $query = mysqli_query($db, $sql);

        // cek apakah query update berhasil
        if($query){
            // kalau berhasil alihkan ke halaman dashboard.php dengan status=sukses
            header('Location: ../../pages/dashboards/user_dashboard.php?status=sukses&pesan=update-data-diri');
            exit();
        } else {
            // kalau gagal alihkan ke halaman dashboard.php dengan status=gagal
            header('Location: ../../pages/dashboards/user_dashboard.php?status=gagal&pesan=update-data-diri');
            exit();
        }
    }
    else{
        // belum ada data di tabel pendaftar, maka tambahkan data ke tabel

        // tapi cek dulu apakah ada nik yang sama
        $sql = "SELECT * FROM pendaftar WHERE nik='$nik'";
        $query = mysqli_query($db, $sql);

        // cek jumlah row yang didapat
        if(mysqli_num_rows($query) > 0){
            // kalau ada, maka alihkan ke halaman dashboard.php dengan status=gagal
            header('Location: ../../pages/dashboards/user_dashboard.php?status=gagal&pesan=nik-terdaftar');
            exit();
        }


        // buat query insert
        $sql = "INSERT INTO pendaftar 
        (id_akun, nik, nama, tanggal_lahir, tempat_lahir, jenis_kelamin, alamat, agama, status_perkawinan, kualifikasi_pendidikan, id_unit_kerja, id_lokasi)
        VALUES ('$id', '$nik', '$nama_lengkap', '$tanggal_lahir', '$tempat_lahir', '$jenis_kelamin', '$alamat', '$agama', '$status_perkawinan', '$kualifikasi_pendidikan', '$id_unit_kerja', '$id_lokasi')";

        // eksekusi query insert
        $query = mysqli_query($db, $sql);

        // cek apakah query insert berhasil
        if($query){
            // kalau berhasil alihkan ke halaman dashboard.php dengan status=sukses
            header('Location: ../../pages/dashboards/user_dashboard.php?status=sukses&pesan=tambah-data-diri');
            exit();
        } else {
            // kalau gagal alihkan ke halaman dashboard.php dengan status=gagal
            header('Location: ../../pages/dashboards/user_dashboard.php?status=gagal&pesan=tambah-data-diri');
            exit();
        }
    }
}
else {
    die("Akses dilarang...");
}
?>