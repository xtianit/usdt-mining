<?php
date_default_timezone_set('Africa/Lagos');
define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('db', 'jubilee');

$conn = mysqli_connect(host, user, pass) or die("Connection to server failed failed");

$db = mysqli_select_db($conn, db) or die("Data connection failed");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


function generateRandomString($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}




function generateReferralCode($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';
    $maxIndex = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, $maxIndex)];
    }

    return $code;
}
