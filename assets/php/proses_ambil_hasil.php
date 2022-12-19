<?php
if(!session_id()) session_start();

$hasil = [];
$hasil['status_pendaftaran']=0;


// buat query untuk ambil id dan status_pendaftaran pendaftar dari tabel pendaftar yang id akun sama dengan id akun sekarang
$sql = 'SELECT id, status_pendaftaran FROM pendaftar WHERE id_akun = '.$_SESSION['user']['id'];
$query = mysqli_query($db, $sql);

// cek jumlah query
if(mysqli_num_rows($query) == 0){
    // jika tidak ada, berarti belum pernah mendaftar
    $hasil['status_pendaftaran'] = 0;
    // echo json_encode($hasil);
    // exit();
}else{
    $result = mysqli_fetch_assoc($query);
    $id_pendaftar = $result['id'];
    $hasil['status_pendaftaran'] = $result['status_pendaftaran'];
    
    // jika lolos verfikasi
    if($hasil['status_pendaftaran'] == 1){
        // buat query untuk ambil data dari database bagi pendaftar lolos
        $sql = 'SELECT l.nama_dinas, l.alamat_dinas, pl.tanggal_ujian, s.id as "id_sesi", s.waktu_mulai, s.waktu_selesai
                FROM pendaftar as p
                JOIN pendaftar_lolos as pl
                ON p.id=pl.id_pendaftar
                JOIN tabel_lokasi as l
                ON pl.id_lokasi=l.id
                JOIN tabel_sesi as s
                ON pl.id_sesi=s.id
                WHERE p.id = '.$id_pendaftar.'';
        $query = mysqli_query($db, $sql);
    
        $pendaftar_lolos = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
        $pendaftar = $pendaftar_lolos[0];
    
        $hasil['ujian'] = $pendaftar;
    }
    
}



?>