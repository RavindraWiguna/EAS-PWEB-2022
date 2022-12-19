<?php
include('../../config.php');
if(!session_id()) session_start();

include('proses_ambil_lolos.php');

function get_total_peserta_ujian($hari, $id_sesi, $id_lokasi){
    global $db;
    // querykan tabel pendaftar_lolos sesuai kriteria parameter
    $sql = "SELECT * FROM pendaftar_lolos WHERE tanggal_ujian='$hari' AND id_sesi=$id_sesi AND id_lokasi=$id_lokasi";

    $query = mysqli_query($db, $sql);

    // kembalikan jumlah baris hasil query
    $rows = mysqli_fetch_all($query, MYSQLI_ASSOC);
    return count($rows);
}

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

// sort pendaftar lolos secara terbalik
usort($pendaftar_lolos, function($a, $b){
    if($a['id'] == $b['id']) return 0;
    return $a['id'] < $b['id'] ? 1 : -1;
});

foreach($total_peserta as $key => $value){
    foreach($lokasi as $key2 => $value2){
        foreach($sesi as $key3 => $value3){
            $total_peserta[$key][$key2][$key3] = get_total_peserta_ujian($key, $key3+1, $key2+1);
        }
    }
}


function find_first_sesi_available(){
    global $total_peserta, $lokasi;

    foreach($total_peserta as $hari => $data){
        foreach($data as $key_lokasi => $data2){
            foreach($data2 as $key_sesi => $jumlah){
                if($jumlah < $lokasi[$key_lokasi]['kuota_per_sesi']){
                    return [$hari, $key_sesi, $key_lokasi];
                }
            }
        }
    }

    return false;

}

$hari_sesi_penuh = false;

// loop seluruh pendaftar lolos dan tentukan tanggal ujian, lokasi dan sesi
foreach($pendaftar_lolos as $key => $value){
    
    $current_lokasi = $value['id_lokasi'];
    $current_sesi = $value['id_sesi'];
    $current_hari = $value['tanggal_ujian'];
    $batas_sesi = $lokasi[$current_lokasi-1]['kuota_per_sesi'];
    
    // cek berapa total orang di tanggal, lokasi dan sesi itu
    if($total_peserta[$current_hari][$current_lokasi][$current_sesi] < $batas_sesi ){
        // aman, lanjut cek peserta lain
        continue;
    }
    else {
        // cari sesi tersedia
        $sesi_tersedia = find_first_sesi_available();
        if($sesi_tersedia){
            $current_hari = $sesi_tersedia[0];
            $current_sesi = $sesi_tersedia[1];
            $current_lokasi = $sesi_tersedia[2];
        }
        else {
            // semua sesi penuh
            $hari_sesi_penuh = true;
            break;
        }
    }

    $pendaftar_lolos[$key]['id_lokasi'] = $current_lokasi;
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