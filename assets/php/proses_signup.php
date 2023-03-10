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
        exit();
    }

    if(!valid_string($username)){
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=username");
        exit();
    }

    if($password != $c_password){
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=password");
        exit();
    }

    if(!valid_alphabet($name)){
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=nama");
        exit(); 
    }

    // cek apakah email sudah terdaftar
    $sql = "SELECT * FROM `akun` WHERE `email` = '$email'";
    $query = mysqli_query($db, $sql);
    if ($query->num_rows > 0) {
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=email_exist");
        exit();
    }

    // cek apakah username sudah terdaftar
    $sql = "SELECT * FROM `akun` WHERE `username` = '$username'";
    $query = mysqli_query($db, $sql);
    if ($query->num_rows > 0) {
        // redirect back ke halaman daftar
        header("Location: ".$app_url."/pages/form_signup.php?status=gagal&pesan=username_exist");
        exit();
    }

    // hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // buat query
    $sql = "INSERT INTO `akun` (`email`, `username`,`name`, `password`,`privilege_level`) VALUES ('$email', '$username','$name', '$password', '1')";
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman index.php dengan status=sukses
        header('Location: '.$app_url.'/index.php?status=sukses&pesan=mendaftar');
        exit();
    } else {
        // kalau gagal alihkan ke halaman index.php dengan status=gagal
        header('Location: '.$app_url.'/index.php?status=gagal&pesan=mendaftar');
        exit();
    }

} else {
    die("Akses dilarang...");
}
?>