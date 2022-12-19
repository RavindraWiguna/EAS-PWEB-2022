<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

$app_url = $_SESSION['app_url'];

// memanggil library FPDF
require('fpdf/fpdf.php');
include('../../config.php');

// ambil data pendaftar dari tabel pendaftar
$sql = 'SELECT * FROM pendaftar WHERE id_akun = '.$_SESSION['user']['id'];
$query = mysqli_query($db, $sql);
$pendaftar = mysqli_fetch_assoc($query);

// intance object dan memberikan pengaturan halaman PDF
$pdf = new FPDF('l','mm','A4');
// membuat halaman baru
$pdf->AddPage();
// setting jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);


// exit();

// $img = $app_url.$pendaftar['path_foto'];
// // prepare a base64 encoded "data url"
// // $pic = 'data://text/plain;base64,' . base64_encode($img);
// $info = getimagesize($img);

// exit($info);


$pdf->Image("../media/LOGO.png", 3, 3, 30, 30, 'png');
// $pdf->Image('../..'.$pendaftar['path_foto'], 10, 30, 50, 50, 'jpg');

// mencetak string 
$pdf->Cell(280,7,'KARTU PESERTA UJIAN CPNS  2023',0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(280,7,'FORMASI LULUSAN TERBAIK',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,15,'',0,1);


// membuat garis lurus di pdf
$pdf->Line(10, 35, 290, 35);


// membuat header tabel
$width_col1 = 50;
$pdf->SetFont('Arial','',12);
$pdf->Cell($width_col1,6,'Instansi:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Lokasi:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'NIK:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Nomor Peserta:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Nama:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Jenis Kelamin:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Tempat/Tanggal Lahir:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Kualifikasi Pendidikan:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Formasi Jabatan:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell($width_col1,6,'Lokasi Tes:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');

// This function call can be copied into your project and can be made from anywhere in your code
$filepath = '../../storage/berkas/'
barcode( $filepath, $text, $size, $orientation, $code_type, $print, $sizefactor );

$pdf->Image()

// untuk koneksi ke database
// include ("config.php");
// // melakukan query untuk mengambil seluruh data calon siswa
// $query = "SELECT * FROM calon_siswa";
// $result = mysqli_query($db, $query);
// if(!$result){
//     die("Gagal mengambil data");
// }
// // query berhasil, tambahkan data tersebut pada pdf
// $pdf->SetFont('Arial', '', 12);
// while($siswa = mysqli_fetch_array($result)){
//     $pdf->Cell(10,6,$siswa['id'],1,0);
//     $pdf->Cell(64,6,$siswa['nama'],1,0);
//     $pdf->Cell(75,6,$siswa['alamat'],1,0);
//     $pdf->Cell(34,6,$siswa['jenis_kelamin'],1,0);
//     $pdf->Cell(30,6,$siswa['agama'],1,0);
//     $pdf->Cell(64,6,$siswa['sekolah_asal'],1,1);
// }
// selesai
$pdf->Output();
?>