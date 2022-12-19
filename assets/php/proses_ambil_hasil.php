<?php
if(!session_id()) session_start();

// inisiasi hasil ke null
$hasil = [];
$hasil['exist']=0;

//ambil id akun
$id = $_SESSION['user']['id'];

// ambil id pendaftar
$sql = "SELECT id FROM pendaftar WHERE id_akun=$id";
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

// exit('id_pendaftar: '.$id_pendaftar);

// buat query untuk ambil data dari tabel pendaftar_lolos
$sql = "SELECT * FROM pendaftar_lolos WHERE id_pendaftar=$id_pendaftar";
$query = mysqli_query($db, $sql);
$hasil['hasil'] = mysqli_fetch_assoc($query);

// cek apakah ada hasil
if( mysqli_num_rows($query) < 1 ){
    // set boolean ada ke false
    $hasil['exist']=0;
    // exit('belum lolos');
}else{
    $hasil['exist']=1;
    // exit('lolos');
}

// cek apakah ada di tabel pendaftar_gagal
$sql = "SELECT * FROM pendaftar_gagal WHERE id_pendaftar=$id_pendaftar";
$query = mysqli_query($db, $sql);
$hasil['hasil'] = mysqli_fetch_assoc($query);

// cek apakah ada hasil
if( mysqli_num_rows($query) < 1 ){
    // set boolean ada ke false
    $hasil['exist']=1;
    $hasil['id_sesi']=1;
    // exit();
}
else{
    // -1 berarti gagal
    $hasil['exist']=-1;
    // exit();
}


?>