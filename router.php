<?php

$request = $_SERVER['REQUEST_URI'];
$app_url = 'http://localhost/kelautan';

// exit($request);

if(!session_id()) session_start();
$_SESSION['app_url'] = $app_url;

$filelocations = [
    'index.php' => '/index.php',
    'form_login.php'=>'/pages/form_login.php',
    'form_signup.php'=>'/pages/form_signup.php',
    'pegawai_dashboard.php'=>'/pages/dashboards/pegawai_dashboard.php',
    'user_dashboard.php' => '/pages/dashboards/user_dashboard.php',
    'lihat_datadiri.php'=> '/pages/lihat_datadiri.php',
    'form_datadiri.php' => '/pages/form_datadiri.php',
    'lihat_berkas.php' => '/pages/lihat_berkas.php',
    'form_berkas.php' => '/pages/form_berkas.php',
    'lihat_hasil.php' => '/pages/lihat_hasil.php',
    'cetak_kartu_ujian.php' => '/assets/php/cetak_kartu_ujian.php',
    'proses_logout.php' => '/assets/php/proses_logout.php',
    'lihat_seluruh_pendaftar.php' => '/pages/lihat_seluruh_pendaftar.php?page=1&show=25',
    'lihat_pendaftar.php' => '/pages/lihat_pendaftar.php?id=1',
];

function redirector($filename, $app, $files){
    header('Location: '.$app.$files[$filename]);
    exit();
}


// Real url catcher
if(str_contains($request, $app_url)){
    $stripped = str_replace($app_url, '', $request);
    // cek apakah terdapat tanda garing ganda pada request
    while(str_contains($stripped, '//')){
        $stripped = str_replace('//', '/', $stripped);
    }
    $request = $app_url.$stripped;
    require $request;
    exit();
}

foreach($filelocations as $filename => $Location){
    if(str_contains($request, $filename)){
        // cek apakah ini page yang perlu get?
        if(str_contains($Location, '?')){
            $posisi_query = strpos($request, '?');
            $posisi_default_query = strpos($Location, '?');
            $prefixLoc = substr($Location, 0, $posisi_default_query);
            $request_query = substr($request, $posisi_query);
            $temp = join('', [$prefixLoc, $request_query]);
            // echo $prefixLoc.'------'.$request.'----1-';
            // echo $temp;
            $filelocations[$filename] = $temp;
        }

        redirector($filename, $app_url, $filelocations);
        exit();
    }
}
// if gak kena samsek
http_response_code(404);
echo 'Unfortunatelly '.$request.' doesnt exist';
require __DIR__ . '/pages/404.php';
die();
?>