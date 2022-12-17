<?php

$request = $_SERVER['REQUEST_URI'];
$app_url = 'http://localhost/kelautan';

// Real url catcher

if(str_contains($request, $app_url)){
    require $request;
    die();
}

// Index.php
// if($request==$app_url.'/index.php'){
//     require $request;
//     die();
// }
// form signup.php
// if($request==$app_url.'/pages/form_signup.php'){
//     require __DIR__.'/index.php';
//     die();
// }


// redirecter
if(str_contains($request, 'index.php')){
    header('Location:'.$app_url.'/');
    die();
}

if(str_contains($request, 'form_login.php')){
    header('Location:' .$app_url.'/pages/form_login.php');
    die();
}
if(str_contains($request, 'form_signup.php')){
    header('Location:' .$app_url.'/pages/form_signup.php');
    die();
}

http_response_code(404);
echo 'Unfortunatelly '.$request.' doesnt exist';
require __DIR__ . '/pages/404.php';
die();
?>