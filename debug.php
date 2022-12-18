<?php
$filelocations = [
    'index.php' => '/index.php',
    'form_login.php'=>'/pages/form_login.php',
    'form_signup.php'=>'/pages/form_signup.php',
];

foreach($filelocations as $filename => $location){
    echo '('.$filename.")\n";
}
?>