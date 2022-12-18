<?php
include("../../config.php");
include('proses_ambil_datadiri.php');
if(!session_id()) session_start();

//ambil id
$id = $_SESSION['user']['id'];
//TODO TAMBAH KODE HAPUS FILE LAMA SETELAH BERHASIL DI UPLOAD
if(isset($_POST['isi_berkas'])){

    // nama kolom tabel
    // id	id_akun	nik	nama	tanggal_lahir	tempat_lahir	jenis_kelamin	alamat	agama	status_perkawinan	path_berkas	path_foto	

    // ambil file yang di ungga berupa berkas dari nama berkas dan foto dari nama pasfoto
    $berkas = $_FILES['berkas']['name'];
    $pasfoto = $_FILES['pasfoto']['name'];

    // Rename nama file dan tambahkan tanggal dan jam upload
    $berkas = date('dmYHis')."_".$berkas;
    $pasfoto = date('dmYHis')."_".$pasfoto;

    // Set path folder tempat menyimpan berkas dan foto
    $path_berkas = "../../storages/berkas/".$berkas;
    $path_foto = "../../storages/pasfoto/".$pasfoto;

    // upload berkas dan foto
    $result_berkas = move_uploaded_file($_FILES['berkas']['tmp_name'], $path_berkas);
    if(! $result_berkas){
        // kembali ke laman dashboard dengan status gagal upload berkas
        header('Location: ../../pages/dashboards/user_dashboard.php?status=gagal&pesan=upload-berkas');
        exit();
    }

    // jika berhasil lanjut upload foto
    $result_foto = move_uploaded_file($_FILES['pasfoto']['tmp_name'], $path_foto);

    if(! $result_foto){
        // karena gagal upload foto hapus berkas yang baru saja berhasil diupload
        unlink($path_berkas);
     
        // kembali ke laman dashboard dengan status gagal upload foto
        header('Location: ../../pages/dashboards/user_dashboard.php?status=gagal&pesan=upload-foto');
        exit();
    }

    
    $backup_berkas = $path_berkas;
    $backup_foto = $path_foto;

    // update path dulu sebelum dimasukkan ke tabel yakni menghilangkan ../..
    $path_berkas = str_replace("../..", "", $path_berkas);
    $path_foto = str_replace("../..", "", $path_foto);

    // jika berhasil upload berkas dan foto lanjut simpan path ke tabel pendaftar pada kolom path_berkas dan path_foto
    $sql = "UPDATE `pendaftar` SET `path_berkas` = '$path_berkas', `path_foto` = '$path_foto' WHERE id_akun=$id";
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman dashboard.php dengan status=sukses dan pesan upload-semua
        header('Location: ../../pages/dashboards/user_dashboard.php?status=sukses&pesan=upload-semua');
        exit();
    } else {
        // kalau gagal disimpan di tabel maka hapus semua file yang baru saja diupload
        unlink($backup_berkas);
        unlink($backup_foto);

        // kalau gagal alihkan ke halaman dashboard.php dengan status=gagal dan pesan upload-semua 
        header('Location: ../../pages/dashboards/user_dashboard.php?status=gagal&pesan=upload-semua');
        exit();
    }
}
else {
    die("Akses dilarang...");
}
?>