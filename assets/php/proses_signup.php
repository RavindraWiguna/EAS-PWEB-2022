<?php

include("../../config.php");
include('validator.php');
if(!session_id()) session_start();
$app_url = $_SESSION['app_url'];

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['daftar'])){

    // ambil data dari formulir
    $email = $_POST['email'];
    $username = $_POST['username'];
    $name = $_POST['nama_lengkap'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    
    // validasi data
    if(!valid_email($email)){
        // redirect back ke halaman daftar
        // die($app_url);
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=email");
        die();
    }

    if(!valid_string($username)){
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=username");
        die();
    }

    if($password != $c_password){
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=password");
        die();
    }

    if(!valid_alphabet($name)){
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=nama");
        die();   
    }

    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // buat query
    $sql = "INSERT INTO `akun` (`email`, `username`,`name`, `password`,`privilege_level`) VALUES ('$email', '$username','$name', '$password', '1')";
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