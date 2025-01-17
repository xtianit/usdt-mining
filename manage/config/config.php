<?php
    define('host','localhost');
    define('user','root');
    define('pass','');
    define('db','jubilee');

    $conn = mysqli_connect(host, user, pass) or die("Connection to server failed failed");
    
    $db = mysqli_select_db($conn, db) or die("Data connection failed");


    function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
