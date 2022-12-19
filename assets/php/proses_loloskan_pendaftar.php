<?php
include('../../config.php');
if(!session_id()) session_start();
//ambil id pendaftar tersimpan di session
$pendaftar = $_SESSION['pendaftar'];

// cek dulu apakah sudah ada pendaftar lolos dengan id pendaftar
$sql = "SELECT * FROM pendaftar_lolos WHERE id_pendaftar=".$pendaftar[0];

// jalankan query
$query = mysqli_query($db, $sql);

// cek jumlah data yang ditemukan
if( mysqli_num_rows($query) > 0 ){
    // jika ada, hapus data pendaftar dari tabel pendaftar_lolos
    $sql = "DELETE FROM pendaftar_lolos WHERE id_pendaftar=".$pendaftar[0];
    $query = mysqli_query($db, $sql);

    // cek apakah query gagal
    if( !$query ){
        // jika gagal, tampilkan pesan gagal menghapus data pendaftar dari tabel pendaftar_lolos
        header('Location: ../../pages/lihat_pendaftar.php?id='.$pendaftar[0].'&status=gagal&pesan=lolos');
        exit();
    }

}



// tambahkan pendaftar ke tabel pendaftar lolos dengan kolom id_pendaftar, id_verifier, id_sesi, tanggal_ujian dan id_lokasi
$sql = "INSERT INTO pendaftar_lolos 
(id_pendaftar, id_verifier, id_sesi, tanggal_ujian, id_lokasi) 
VALUES ('".$pendaftar[0]."', '".$_SESSION['user']['id']."', '1', '2023-01-16', ".$pendaftar['id_lokasi'].")";

// print_r($pendaftar);
// exit();

// jalankan query
$query = mysqli_query($db, $sql);

// cek apakah query berhasil
if( $query ){
    // buat query untuk mengupdate data pendaftar pada tabel pendaftar untuk kolom status pendaftaran menjadi 1
    $id = $pendaftar[0];
    $sql = "UPDATE pendaftar SET status_pendaftaran=1 WHERE id=$id";
    $query = mysqli_query($db, $sql);

    // cek apakah query update berhasil
    if( $query ){
        // jika berhasil, redirect ke halaman lihat pendafatar
        header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=sukses&pesan=lolos');
        exit();
    }else{
        // jika gagal, tampilkan pesan gagal menggagalkan pendafatar
        header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=gagal&pesan=lolos');
        exit();
    }
}else{
    // jika gagal, tampilkan pesan gagal menggagalkan pendafatar
    header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=gagal&pesan=lolos');
    exit();
}
?>