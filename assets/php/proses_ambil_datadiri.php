<?php
if(!session_id()) session_start();
//ambil id
$id = $_SESSION['user']['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM pendaftar WHERE id_akun=$id";
$query = mysqli_query($db, $sql);
$pendaftar = mysqli_fetch_assoc($query);
$data_pendaftar_is_exist = true;
// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    $data_pendaftar_is_exist=false;
}
?>