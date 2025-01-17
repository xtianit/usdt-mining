<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "./../../vendor/autoload.php";
require_once './../../controllers/account/access.php';

require_once './../../config/config.php';


$response = array(
    "message" => "Something went wrong....",
    "status" => 0

);


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from users where email=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $pass = $row['password'];
            $status = $row['status'];
            if (password_verify($password, $pass)) {
                if ($row['status'] !== "deactivated") {
                    $vcode = rand(100000, 999999);
                    $sql = mysqli_query($conn, "update verification set code='$vcode' where email='$email'");
                    if (mysqli_affected_rows($conn) > 0) {
                        //if (sendVcode($email, $vcode)) {
                        $_SESSION['email'] = $email;
                        $_SESSION['logged_in'] = true;
                        $response['status'] = 1;
                        $response['message'] = "Authentication successful";
                        //}
                    } else {
                        $response['message'] = "Invalid login creadentials provided.";
                    }
                } else {
                    $response['message'] = "Your account has been suspended till further notice!";
                }
            } else {
                $response['message'] = "Invalid login creadentials provided.";
            }
        }
    } else {
        $response['message'] = "Invalid login creadentials provided.";
    }
}

echo json_encode($response);


function sendVcode($email, $code)
{
    $mail = new PHPMailer(true);
    //Enable SMTP debugging.
    //$mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     

    $mail->Username = "tiarryben@gmail.com";
    $mail->Password = "jhnijkvpxrtvkobc";

    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = $email;
    $mail->FromName = "T-Cloud USDT Cloud Mining";

    $mail->addAddress($email, "T-Cloud USDT Cloud Mining");

    $mail->isHTML(true);

    $mail->Subject = "Login verification code";
    $mail->Body = "<html>
                    <head>

                    </head>
                    <body>
                        <h3>Login Verification</h3>
                        <p>Your login verification code is $code.</p>
                        <p>Please ignore if you did not perform this action.</p>
                        <p>
                            <Strong>Regards</strong>
                        </p>
                        <p><strong>T-Cloud USDT Cloud Mining</p>
                    </body>
            </html>";

    try {
        if ($mail->send()) {
            return true;
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}


function getID($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $id = $row['userid'];
        return $id;
    }
}
