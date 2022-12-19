<?php
if(!session_id()) session_start();
//ambil id
$id = $_SESSION['user']['id'];

// buat query untuk ambil data dari database bagi pendaftar yang belum terverifikasi
$sql = 'SELECT p.id, p.nama, l.nama_dinas, l.alamat_dinas, pl.tanggal_ujian, s.id as "id_sesi", s.waktu_mulai, s.waktu_selesai
        FROM pendaftar as p
        JOIN pendaftar_lolos as pl
        ON p.id=pl.id_pendaftar
        JOIN tabel_lokasi as l
        ON pl.id_lokasi=l.id
        JOIN tabel_sesi as s
        ON pl.id_sesi=s.id';
$query = mysqli_query($db, $sql);

$pendaftar_lolos = mysqli_fetch_all($query, MYSQLI_ASSOC);

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
    global $pendaftar_lolos;
    return sizeof($pendaftar_lolos);
}

function get_chunk_pendaftar(){
    global $pendaftar_lolos;
    $page = get_page();
    $show_per_page = get_show();

    $start_id = $show_per_page * ($page - 1);
    $chunk_pendaftar = array_slice($pendaftar_lolos, $start_id, $show_per_page);

    return $chunk_pendaftar;
}

?>