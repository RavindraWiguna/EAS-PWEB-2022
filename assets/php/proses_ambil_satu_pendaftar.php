<?php
if(!session_id()) session_start();
//ambil id target
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM pendaftar WHERE id = $id";
$sql = "SELECT * 
        FROM pendaftar as p 
        JOIN unit_kerja as u 
        ON p.id_unit_kerja=u.id
        JOIN tabel_lokasi as l
        ON p.id_lokasi=l.id
        WHERE p.id=$id";
$query = mysqli_query($db, $sql);

$pendaftar = mysqli_fetch_array($query);
$pendaftar['exist'] = true;
// cek apakah data dari database ada
if( mysqli_num_rows($query) < 1 ){
    $pendaftar['exist'] = false;
}else{
    $pendaftar['lokasi_joined'] = $pendaftar['nama_dinas'].'<br>'.$pendaftar['alamat_dinas'];
}



?>