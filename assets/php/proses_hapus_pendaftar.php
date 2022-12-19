<?php
include('../../config.php');

if(!session_id()) session_start();

// ambil id pendaftar yang dilihat yang telah disimpan dalam session
$id = $_SESSION['pendaftar']['id'];

// hapus data pendaftar di tabel pendaftar_lolos jika ada

// buat query untuk hapus data pendaftar di tabel pendaftar_lolos
$sql = "DELETE FROM pendaftar_lolos WHERE id_pendaftar = $id";
$query = mysqli_query($db, $sql);

// hapus data pendaftar di tabel pendaftar jika ada

// buat query untuk hapus data pendaftar di tabel pendaftar
$sql = "DELETE FROM pendaftar WHERE id = $id";
$query = mysqli_query($db, $sql);

// redirect ke halaman dashboard
header('Location: ../../pages/dashboards/pegawai_dashboard.php?status=sukses&pesan=hapus');

?>