<?php
if(!session_id()) session_start();
//ambil id
$id = $_SESSION['user']['id'];

// convert date string from yyyy-mm-dd to dd month yyyy
function convert_date($str){

    // nama bulan
    $month = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );


    $date = explode('-', $str);
    return $date[2].' '.$month[$date[1]].' '.$date[0];
}


// buat query untuk ambil data dari database
$sql = "SELECT * 
        FROM pendaftar as p 
        JOIN unit_kerja as u 
        ON p.id_unit_kerja=u.id
        JOIN tabel_lokasi as l
        ON p.id_lokasi=l.id
        WHERE id_akun=$id";
$query = mysqli_query($db, $sql);
$pendaftar = mysqli_fetch_assoc($query);
$pendaftar['exist']=true;
// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    // set boolean ada ke false
    $pendaftar['exist']=false;
}else{
    $pendaftar['lokasi_joined'] = $pendaftar['nama_dinas'].'<br>'.$pendaftar['alamat_dinas'];
    $pendaftar['tanggal_lahir'] = convert_date($pendaftar['tanggal_lahir']);
}
?>