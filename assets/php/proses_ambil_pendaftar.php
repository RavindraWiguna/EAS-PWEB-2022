<?php
if(!session_id()) session_start();
//ambil id
$id = $_SESSION['user']['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM pendaftar";
$query = mysqli_query($db, $sql);

$list_pendaftar = mysqli_fetch_all ($query, MYSQLI_ASSOC);
// echo ($json );
// print_r($json);

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
    global $list_pendaftar;
    return sizeof($list_pendaftar);
}

function get_chunk_pendaftar(){
    global $list_pendaftar;
    $page = get_page();
    $show_per_page = get_show();

    // $show_per_page = min($show_per_page, sizeof($list_pendaftar));

    // echo $show_per_page;
    // echo '-'.$page;
    // exit();
    $start_id = $show_per_page * ($page - 1);
    $chunk_pendaftar = array_slice($list_pendaftar, $start_id, $show_per_page);
    // print_r($chunk_pendaftar);
    // exit();
    return $chunk_pendaftar;
}

// exit();

?>