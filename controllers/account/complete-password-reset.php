<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "./../../vendor/autoload.php";
require_once './../../controllers/account/access.php';
require_once './../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => false
);
if (isset($_POST['email'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "update users set password = ? where email=?";
    if ($stmt = mysqli_prepare($conn,  $sql)) {
        mysqli_stmt_bind_param($stmt, 'ss', $hash, $email);
        mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($conn) > 0) {
            $response['message'] = "Successful";
            $response['status'] = true;
        }
    }
}

echo json_encode($response);
