<?php
include('../../config.php');
if(!session_id()) session_start();

include('proses_ambil_lolos.php');

// urutan jika sesi penuh ganti sesi
// jika semua sesi penuh, ganti lokasi
// jika semua lokasi penuh ganti hari

// ambil data lokasi
$sql = 'SELECT * FROM tabel_lokasi';
$query = mysqli_query($db, $sql);
$lokasi = mysqli_fetch_all($query, MYSQLI_ASSOC);

// ambil data sesi
$sql = 'SELECT * FROM tabel_sesi';
$query = mysqli_query($db, $sql);
$sesi = mysqli_fetch_all($query, MYSQLI_ASSOC);

// string tanggal ujian dalam format yyyy-mm-dd dari tanggal 16 Januari 2023 sampai 20 Januari 2023
$total_peserta = [
    '2023-01-16' => [],
    '2023-01-17' => [],
    '2023-01-18' => [],
    '2023-01-19' => [],
    '2023-01-20' => []
];

// tiap hari memiliki array lokasi
// tiap lokasi memiliki array sesi
// tiap sesi memiliki array pendaftar

// ambil data pendaftar lolos
$pendaftar_lolos = get_all_pendaftar_lolos();

foreach($total_peserta as $key => $value){
    foreach($lokasi as $key2 => $value2){
        foreach($sesi as $key3 => $value3){
            $total_peserta[$key][$key2][$key3] = 0;
        }
    }
}

// set variable current hari, lokasi dan sesi ke nilai default
$current_hari = '2023-01-16';
$current_sesi = 1;
// variabel batas sesi per lokasi diambil dari kuota_per_sesi milik lokasi
$batas_sesi = $lokasi[$current_lokasi-1]['kuota_per_sesi'];

$hari_sesi_penuh = false;

// loop seluruh pendaftar lolos dan tentukan tanggal ujian, lokasi dan sesi
foreach($pendaftar_lolos as $key => $value){
    
    $current_lokasi = $value['id_lokasi'];
    
    // cek berapa total orang di tanggal, lokasi dan sesi itu
    if($total_peserta[$current_hari][$current_lokasi][$current_sesi] < $batas_sesi ){
        // jika kurang dari batas sesi, tambahkan ke array hari
        $total_peserta[$current_hari][$current_lokasi][$current_sesi] += 1;
    }
    else {
        // cek apakah sesi berikutnya tersedia
        if($current_sesi < 4){
            $current_sesi+=1;
            $total_peserta[$current_hari][$current_lokasi][$current_sesi] += 1;
        }
        // cek apakah hari berikutnya tersedia
        else if($current_hari < '2023-01-21'){
            $current_hari = date('Y-m-d', strtotime($current_hari. ' + 1 days'));
            $current_sesi = 1;
            $total_peserta[$current_hari][$current_lokasi][$current_sesi] += 1;
        }
        else{
            // waduh penuh dan hari mentok, set flag hari_sesi_penuh=true
            $hari_sesi_penuh = true;
        }
    }

    $pendaftar_lolos[$key]['id_sesi'] = $current_sesi;
    $pendaftar_lolos[$key]['tanggal_ujian'] = $current_hari;
}

// update data pendaftar lolos
foreach($pendaftar_lolos as $key => $value){
    $id = $value['id'];
    $id_sesi = $value['id_sesi'];
    $tanggal_ujian = $value['tanggal_ujian'];

    $sql = "UPDATE pendaftar_lolos SET id_sesi=$id_sesi, tanggal_ujian='$tanggal_ujian' WHERE id_pendaftar=$id";
    $query = mysqli_query($db, $sql);
}

// redirect ke lihat pendaftar lolos php
$status = $hari_sesi_penuh? 'gagal' : 'sukses';
header('Location: ../../pages/lihat_pendaftar_lolos.php?page=1&show=25&status='.$status.'&pesan=mengatur%20sesi%20ujian');
exit();
?>