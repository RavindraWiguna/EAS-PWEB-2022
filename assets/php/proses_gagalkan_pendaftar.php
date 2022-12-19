<?php
include('../../config.php');
if(!session_id()) session_start();
//ambil id pendaftar tersimpan di session
$pendaftar = $_SESSION['pendaftar'];

$id=$pendaftar[0];

// cek apakah ada data pendaftar di tabel pendaftar_lolos
$sql = "SELECT * FROM pendaftar_lolos WHERE id_pendaftar=".$pendaftar[0];

// jalankan query
$query = mysqli_query($db, $sql);

// cek jumlah data yang ditemukan
if( mysqli_num_rows($query) > 0 ){
    // jika ada, hapus data pendaftar dari tabel pendaftar_lolos
    $sql = "DELETE FROM pendaftar_lolos WHERE id_pendaftar=".$pendaftar['id'];
    $query = mysqli_query($db, $sql);

    // cek apakah query gagal
    if( !$query ){
        // jika gagal, tampilkan pesan gagal menghapus data pendaftar dari tabel pendaftar_lolos
        header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=gagal&pesan=gagal');
        exit();
    }

}



// buat query untuk mengupdate data pendaftar pada tabel pendaftar untuk kolom status pendaftaran menjadi -1
// $id = $pendaftar['id'];
$sql = "UPDATE pendaftar SET status_pendaftaran=-1 WHERE id=$id";
$query = mysqli_query($db, $sql);

// cek apakah query update berhasil
if( $query ){
    // jika berhasil, redirect ke halaman lihat belum terverifikasi
    header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=berhasil&pesan=gagal');
    exit();
}else{
    // jika gagal, tampilkan pesan gagal menggagalkan pendafatar
    header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=gagal&pesan=gagal');
    exit();
}
?>