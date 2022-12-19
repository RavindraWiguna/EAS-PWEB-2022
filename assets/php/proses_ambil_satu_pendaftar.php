<?php
if(!session_id()) session_start();
//ambil id target
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM pendaftar WHERE id = $id";
$query = mysqli_query($db, $sql);

$pendaftar = mysqli_fetch_array($query);
$pendaftar['exist'] = true;
// cek apakah data dari database ada
if( mysqli_num_rows($query) < 1 ){
    $pendaftar['exist'] = false;
}else{
    $pendaftar['exist   '] = true;
}



?>