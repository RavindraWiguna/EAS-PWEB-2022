<?php
$paths=[];
$paths['root']=$_SERVER['DOCUMENT_ROOT'].'/kelautan';
$paths['pages'] = $paths['root']."/pages";
$paths['components'] = $paths['pages']."/components";
$paths['php'] = $paths['root'].'/assets/php';   

$GLOBALS['paths']=$paths;

?>