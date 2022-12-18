<?php
include("../../config.php");
include('validator.php');
include('proses_ambil_datadiri.php');

if(!session_id()) session_start();

//ambil id
$id = $_SESSION['user']['id'];

if(isset($_POST['isi_data_diri'])){

    // nama kolom tabel
    // id	id_akun	nik	nama	tanggal_lahir	tempat_lahir	jenis_kelamin	alamat	agama	status_perkawinan	path_berkas	path_foto	

    // ambil file yang di ungga berupa berkas dari nama berkas dan foto dari nama pasfoto
    $berkas = $_FILES['berkas']['name'];
    $pasfoto = $_FILES['pasfoto']['name'];

    // Rename nama file dan tambahkan tanggal dan jam upload
    $berkas = date('dmYHis')."_".$berkas;
    $pasfoto = date('dmYHis')."_".$pasfoto;

    // Set path folder tempat menyimpan berkas dan foto
    
    

}



?>