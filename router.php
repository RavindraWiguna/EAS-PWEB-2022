<?php

$request = $_SERVER['REQUEST_URI'];
$app_url = 'http://localhost/kelautan';

if(!session_id()) session_start();
$_SESSION['app_url'] = $app_url;

$filelocations = [
    'index.php' => '/index.php',
    'form_login.php'=>'/pages/form_login.php',
    'form_signup.php'=>'/pages/form_signup.php',
];

function redirector($filename, $app, $files){
    header('Location: '.$app.'/'.$files[$filename]);
    exit();
}


// Real url catcher
if(str_contains($request, $app_url)){
    require $request;
    die();
}

foreach($filelocations as $filename => $Location){
    if(str_contains($request, $filename)){
        redirector($filename, $app_url, $filelocations);
        die();
    }
}
// if gak kena samsek
http_response_code(404);
echo 'Unfortunatelly '.$request.' doesnt exist';
require __DIR__ . '/pages/404.php';
die();
?>