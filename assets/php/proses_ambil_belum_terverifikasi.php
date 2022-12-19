<?php
if(!session_id()) session_start();
//ambil id
$id = $_SESSION['user']['id'];

// buat query untuk ambil data dari database bagi pendaftar yang belum terverifikasi
$sql = "SELECT * FROM pendaftar
        WHERE 
        status_pendaftaran = 0 or 
        status_pendaftaran is null";
$query = mysqli_query($db, $sql);

$belum_terverifikasi = mysqli_fetch_all ($query, MYSQLI_ASSOC);

function get_page(){
    if(!isset($_GET['page'])){
        $page=1;
    }else{
        $page = $_GET['page'];
    }
    return $page;
}

function get_show(){
    if(!isset($_GET['show'])){
        $show_per_page=25;
    }else{
        $show_per_page = $_GET['show'];
    }
    return $show_per_page;
}

function get_total_data(){
    global $belum_terverifikasi;
    return sizeof($belum_terverifikasi);
}

function get_chunk_pendaftar(){
    global $belum_terverifikasi;
    $page = get_page();
    $show_per_page = get_show();

    $start_id = $show_per_page * ($page - 1);
    $chunk_pendaftar = array_slice($belum_terverifikasi, $start_id, $show_per_page);

    return $chunk_pendaftar;
}

?>