<?php

include("../../config.php");
include('validator.php');
if(!session_id()) session_start();
$app_url = $_SESSION['app_url'];

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['login'])){

    // ambil data dari formulir
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];

    // buat query ambil data akun
    $sql =  $sql = "SELECT * from `akun` where `email` = '$user_email' or `username` = '$user_email'";
    $query = mysqli_query($db, $sql);
    $akun = mysqli_fetch_assoc($query);
    
    

    // if(password_verify())


    // buat query
   
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: '.$app_url.'/index.php?status=sukses-mendaftar');
    } else {
        // kalau gagal alihkan ke halaman index.php dengan status=gagal
        header('Location: '.$app_url.'/index.php?status=gagal-mendaftar');
    }

} else {
    die("Akses dilarang...");
}
?>