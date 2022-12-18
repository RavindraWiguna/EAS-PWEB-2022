<?php
if(!session_id()) session_start();
$app_url = $_SESSION['app_url'];

session_destroy();
header("Location: ".$app_url."/pages/form_login.php");
exit();
?>