<!-- script untuk memproses proses pendaftaran -->
<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $jk = $_POST['jenis_kelamin'];
    $agama = $_POST['agama'];
    $sekolah = $_POST['sekolah_asal'];
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    // Rename nama fotonya dengan menambahkan tanggal dan jam upload
    $fotobaru = date('dmYHis').$foto;
    // Set path folder tempat menyimpan fotonya
    $path = "../crud_upload/images/".$fotobaru;
    // header('Location: debug.php?status='.$path.'-'.$tmp.'-done');
    // return; 

    // upload dulu
    if(move_uploaded_file($tmp, $path)){
    
        // buat query
        $sql = "INSERT INTO `calon_siswa` (`nama`, `alamat`, `jenis_kelamin`, `agama`, `sekolah_asal`, `path_foto`) 
        VALUES ('$nama', '$alamat', '$jk', '$agama', '$sekolah', '$path')";
        $query = mysqli_query($db, $sql);

        // apakah query simpan berhasil?
        if( $query ) {
            // kalau berhasil alihkan ke halaman index.php dengan status=sukses
            header('Location: index.php?status=sukses');
        } else {
            // kalau gagal alihkan ke halaman indek.php dengan status=gagal
            header('Location: index.php?status=gagal');
        }
    }
    else {
        // kalau gagal alihkan ke halaman indek.php dengan status=gagal
        header('Location: index.php?status=gagalUpload');
    }


} else {
    die("Akses dilarang...");
}

?>