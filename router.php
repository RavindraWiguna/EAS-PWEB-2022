<?php

$request = $_SERVER['REQUEST_URI'];
$app_url = 'http://localhost/kelautan';

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
    'proses_logout.php' => '/assets/php/proses_logout.php',
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