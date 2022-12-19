<?php
if(!session_id()) session_start();
//ambil id
$id = $_SESSION['user']['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * 
        FROM pendaftar as p 
        JOIN unit_kerja as u 
        ON p.id_unit_kerja=u.id
        JOIN tabel_lokasi as l
        ON p.id_lokasi=l.id
        WHERE id_akun=$id";
$query = mysqli_query($db, $sql);
$pendaftar = mysqli_fetch_assoc($query);
$pendaftar['exist']=true;
// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    // set boolean ada ke false
    $pendaftar['exist']=false;
}else{
    $pendaftar['lokasi_joined'] = $pendaftar['nama_dinas'].'<br>'.$pendaftar['alamat_dinas'];
}
?>