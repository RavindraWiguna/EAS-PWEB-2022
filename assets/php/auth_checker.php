<?php
if(!session_id()) session_start();
$app_url = $_SESSION['app_url'];

function redirect_handler($url){
    global $app_url;
    header('Location: '.$app_url.$url);
    exit();
}

function redirect_login(){
    redirect_handler('/pages/form_login.php');
    exit();
}

// redirect ke 403 access denied
function denied(){
    redirect_handler('/pages/403.php');
    exit();
}

// redirect ke dashboard akun
function redirect_dashboard(){
    if(!isset($_SESSION['user_is_login'])){
        redirect_login();
        exit();
    }
    if($_SESSION['user']['privilege_level'] == 1){
        redirect_handler('/pages/dashboards/user_dashboard.php');
        exit();
    }
    if($_SESSION['user']['privilege_level'] >= 2){
        redirect_handler('/pages/dashboards/pegawai_dashboard.php');
        exit();
    }
}

function check($level){

    switch ($level) {
        case -1:
            if(isset($_SESSION['user_is_login'])){
                redirect_dashboard();
                exit();
            }
            break;
        case 1:
            if(!isset($_SESSION['user_is_login'])){
                redirect_login();
                exit();
            }
            // jika lebih tinggi arahkan ke dashboard mereka
            if($_SESSION['user']['privilege_level'] > 1){
                redirect_dashboard();
                exit();
            }
            break;
        case 2:
            if(!isset($_SESSION['user_is_login'])){
                redirect_login();
                exit();
            }
            if($_SESSION['user']['privilege_level'] < 2){
                denied();
                exit();
            }
            break;
        case 4:
            if(!isset($_SESSION['user_is_login'])){
                redirect_login();
                exit();
            }
            if($_SESSION['user']['privilege_level'] < 4){
                denied();
                exit();
            }
            break;
        default:
            // do nothing
    }
}

?>