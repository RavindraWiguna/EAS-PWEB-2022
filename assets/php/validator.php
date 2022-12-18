<?php
// fungsi untuk mengecek valid email
function valid_email($str) {
    return (!preg_match(
        "/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/",
        $str)) ? FALSE : TRUE;
}

// cek apakah string terdiri dari huruf dan angka
function valid_string($str) {
    return (!preg_match(
        "/^[a-zA-Z0-9]+$/",
        $str)) ? FALSE : TRUE;
}

// cek apakah string terdiri dari huruf saja dan spasi
function valid_alphabet($str){
    return (!preg_match(
        "/^[a-zA-Z\s]*$/",$str
    ))? FALSE:TRUE;
}
?>