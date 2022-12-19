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


// ambil data pendaftar dari tabel pendaftar
$sql = 'SELECT uk.nama_unit_kerja, p.path_foto, p.nik, p.id, p.nama, p.jenis_kelamin, p.tempat_lahir, p.tanggal_lahir, p.kualifikasi_pendidikan, tl.nama_dinas, tl.alamat_dinas
        FROM pendaftar as p
        JOIN pendaftar_lolos as pl
        ON pl.id_pendaftar=p.id
        JOIN tabel_lokasi as tl
        ON tl.id=pl.id_lokasi
        JOIN unit_kerja as uk
        ON uk.id=p.id_unit_kerja
        WHERE p.id_akun='.$_SESSION['user']['id'].'
        ';
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
barcode( $filepath, generate_no_peserta($pendaftar['id']), $size, $orientation, $code_type, $print, $sizefactor );

$pdf->Image($filepath, 230, 40, 60, 18, 'png');
$pdf->Image('../..'.$pendaftar['path_foto'], 230, 60, 40, 60, 'jpg');

// membuat header tabel
$width_col1 = 50;
$gap = 3.5;
$pdf->SetFont('Arial','',12);
$pdf->Cell($width_col1,6,'Instansi:',0,0,'');
$pdf->Cell(72,6,'Kementrian Kelautan dan Perikanan',0,1,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Lokasi:',0,0,'');
$pdf->Multicell(150,6,'Pusat Pengendalian Mutu, Badan Karantina Ikan, Pengendalian Mutu dan Keamanan Hasil Perikanan',0,'');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'NIK:',0,0,'');
$pdf->Cell(64,6,$pendaftar['nik'],0,1,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Nomor Peserta:',0,0,'');
$pdf->Cell(64,6,generate_no_peserta($pendaftar['id']),0,1,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Nama:',0,0,'');
$pdf->Multicell(150,6,$pendaftar['nama'],0,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Jenis Kelamin:',0,0,'');
$pdf->Cell(64,6,$pendaftar['jenis_kelamin'],0,1,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Tempat/Tanggal Lahir:',0,0,'');
$pdf->Cell(64,6,$pendaftar['tempat_lahir'].' / '.convert_date($pendaftar['tanggal_lahir']),0,1,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Kualifikasi Pendidikan:',0,0,'');
$pdf->Cell(64,6,$pendaftar['kualifikasi_pendidikan'],0,1,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Formasi Jabatan:',0,0,'');
$pdf->Cell(64,6,$pendaftar['nama_unit_kerja'],0,1,'L');
$pdf->Cell(10,$gap,'',0,1);
$pdf->Cell($width_col1,6,'Lokasi Tes:',0,0,'');
$pdf->Multicell(150,6,$pendaftar['nama_dinas'].', '.$pendaftar['alamat_dinas'],0,'l');
$pdf->Cell(10,$gap+2,'',0,1);
$pdf->Cell(250,6,'........................................................, 2023',0,1, 'R');
$pdf->Cell(100,6,'Peserta',0,0,'C');
$pdf->Cell(150,6,'Panitia Pengadaan Instansi CPNS',0,1,'R');
$pdf->Cell(10,$gap+12,'',0,1);
$pdf->Cell(100,6,'........................................................',0,1,'C');

$pdf->Cell(100,6,$pendaftar['nama'],0,0,'C');


function generate_no_peserta($id){
    $no_peserta = '0000-000-000000';
    $no_peserta = substr($no_peserta, 0, -strlen($id)).$id;
    return $no_peserta;
}


$pdf->Output();
?>