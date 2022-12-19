<?php
if(!session_id()) session_start();

// inisiasi hasil ke null
$hasil = [];
$hasil['exist']=0;

//ambil id akun
$id = $_SESSION['user']['id'];

// ambil id pendaftar
$sql = "SELECT * FROM pendaftar WHERE id_akun=$id";
$query = mysqli_query($db, $sql);
$pendaftar = mysqli_fetch_assoc($query);
$pendaftar['exist']=true;
$id_pendaftar = null;
// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    // set boolean ada ke false
    $pendaftar['exist']=false;
    // exit('aaa');
}

// exit('bbbb');

$id_pendaftar = $pendaftar['id'];
$hasil = [];
$hasil['status_pendaftaran'] = $pendaftar['status_pendaftaran'];

if($hasil['status_pendaftaran']==1){
    // ambil data ujian dari tabel pendaftar_lolos
    $sql = "SELECT * FROM pendaftar_lolos WHERE id_pendaftar=$id_pendaftar";
    $query = mysqli_query($db, $sql);
    $hasil['hasil'] = mysqli_fetch_assoc($query);
    $hasil['id_sesi'] = 3;
}
?>