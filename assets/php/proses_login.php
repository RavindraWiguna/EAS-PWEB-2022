<?php

include("../../config.php");
include('validator.php');
if(!session_id()) session_start();
$app_url = $_SESSION['app_url'];

$dashboards=[];
$dashboards[4] = '/dashboards/pegawai_dashboard.php'; // sama tapi nantik diganti di variable aja
$dashboards[2] = '/dashboards/pegawai_dashboard.php';
$dashboards[1] = '/dashboards/user_dashboard.php';

// cek apakah tombol daftar sudah diklik atau blum?
if(isset($_POST['login'])){

    // ambil data dari formulir
    $user_email = $_POST['user_email'];
    $password = $_POST['password'];

    // buat query ambil data akun
    $sql =  $sql = "SELECT * from `akun` where `email` = '$user_email' or `username` = '$user_email'";
    $query = mysqli_query($db, $sql);
    
    // cek kalau user_email tidak ada di database
    if($query->num_rows == 0){
        // redirect ke halaman login karena tidak ada yang match
        header("Location: ".$app_url."/pages/form_login.php?status=gagal&pesan=user_email");
        exit();
    }

    // loop query
    while($row = mysqli_fetch_array($query)){
        $db_password = $row['password'];
        $db_id = $row['id'];
        $db_username = $row['username'];
        $db_email = $row['email'];

        // cek password
        if(password_verify($password, $db_password)){
            // jika password benar
            // buat session
            // $is_started = session_start();
            // if($is_started){
            $_SESSION['user'] = $row;
            $_SESSION['user_is_login'] = true;
            // }else{
                // die('gagal sir');
            // }

            // redirect ke halaman dashbord

            header("Location: ".$app_url."/pages".$dashboards[$row['privilege_level']]."?status=sukses&pesan=login");
            exit();
        } else {
            // jika password salah, lanjut ke data berikutnya
        }
    }
    // redirect ke halaman login karena tidak ada yang match
    header("Location: ".$app_url."/pages/form_login.php?status=gagal&pesan=password");
    exit();
} else {
    die("Akses dilarang...");
}
?>