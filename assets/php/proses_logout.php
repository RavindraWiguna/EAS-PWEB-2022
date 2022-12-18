<?php
if(!session_id()) session_start();
// backup app_url
$app_url = $_SESSION['app_url'];

// destroy session
session_destroy();

// redirect to login page
if(!session_id()) session_start();
$_SESSION['app_url']=$app_url;
header("Location: ".$app_url."/pages/form_login.php");
exit();
?>