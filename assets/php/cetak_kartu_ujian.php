<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

$app_url = $_SESSION['app_url'];

// memanggil library FPDF
require('fpdf/fpdf.php');
include('../../config.php');
include('barcode.php');

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



$pdf->Image("../media/LOGO.png", 30, 3, 30, 30, 'png');

// mencetak string 
$pdf->Cell(280,7,'KARTU PESERTA UJIAN CPNS  2023',0,1,'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(280,7,'FORMASI LULUSAN TERBAIK',0,1,'C');

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,15,'',0,1);
// membuat garis lurus di pdf
$pdf->Line(10, 35, 290, 35);

// This function call can be copied into your project and can be made from anywhere in your code
$filepath = '../media/tmp/tmp.png';
$text = '1234567890';
$size = '30';
$orientation = 'horizontal';
$code_type = 'Code128';
$print  = true;
$sizefactor = 1;
if(is_file($filepath)) unlink($filepath);
barcode( $filepath, $text, $size, $orientation, $code_type, $print, $sizefactor );

$pdf->Image($filepath, 230, 40, 60, 18, 'png');

// membuat header tabel
$width_col1 = 50;
$gap = 4;
$pdf->SetFont('Arial','',12);
$pdf->Cell($width_col1,6,'Instansi:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Lokasi:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'NIK:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Nomor Peserta:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Nama:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Jenis Kelamin:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Tempat/Tanggal Lahir:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Kualifikasi Pendidikan:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Formasi Jabatan:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Lokasi Tes:',0,0,'');
$pdf->Cell(64,6,'Kementrian Kelautan dan Perikanan',0,1,'C');
$pdf->Cell(10,$gap*2,'',0,1);
$pdf->Cell(250,6,'........................................................, 2023',0,1, 'R');
$pdf->Cell(145,6,'Peserta',0,0,'C');
$pdf->Cell(145,6,'Panitia Pengadaan Instansi CPNS',0,1,'C');
$pdf->Cell(10,$gap*2,'',0,1);
$sx = 48;
$len = 70;
$y = 175;
$pdf->Line($sx, $y,$sx+$len, $y);

$pdf->Cell(10,$gap+8,'',0,1);
$pdf->Cell(145,6,'PUTU RAVINDRA WIGUNA',0,0,'C');



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