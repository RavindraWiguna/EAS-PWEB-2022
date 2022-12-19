<?php
include('../../config.php');
if(!session_id()) session_start();
//ambil id pendaftar tersimpan di session
$pendaftar = $_SESSION['pendaftar'];

// tambahkan pendaftar ke tabel pendaftar lolos dengan kolom id_pendaftar, id_verifier, id_sesi, tanggal_ujian dan id_lokasi
$sql = "INSERT INTO pendaftar_lolos 
(id_pendaftar, id_verifier, id_sesi, tanggal_ujian, id_lokasi) 
VALUES ('".$pendaftar['id']."', '".$_SESSION['user']['id']."', '1', '2023-01-16', '1')";

// jalankan query
$query = mysqli_query($db, $sql);

// cek apakah query berhasil
if( $query ){
    // buat query untuk mengupdate data pendaftar pada tabel pendaftar untuk kolom status pendaftaran menjadi 1
    $id = $pendaftar['id'];
    $sql = "UPDATE pendaftar SET status_pendaftaran=1 WHERE id=$id";
    $query = mysqli_query($db, $sql);

    // cek apakah query update berhasil
    if( $query ){
        // jika berhasil, redirect ke halaman lihat pendafatar
        header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=berhasil&pesan=lolos');
        exit();
    }else{
        // jika gagal, tampilkan pesan gagal menggagalkan pendafatar
        header('Location: ../../pages/lihat_pendaftar.php?id='.$id.'&status=gagal&pesan=lolos');
        exit();
    }
}else{
    // jika gagal, tampilkan pesan gagal menggagalkan pendafatar
    header('Location: ../../pages/lihat_pendaftar.php?id='.$pendaftar['id'].'&status=gagal&pesan=lolos');
    exit();
}
?>