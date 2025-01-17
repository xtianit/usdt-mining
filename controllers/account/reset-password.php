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
    $sql = "select * from users where email=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $email = $row['email'];
            $vcode = rand(100000, 999999);
            $sql = mysqli_query($conn, "update verification set code='$vcode' where email='$email'");
            if (mysqli_affected_rows($conn) > 0) {
                if (sendVcode($email, $vcode)) {
                    $response['status'] = 1;
                    $response['message'] = "Password reset code sent.";
                }
            } else {
                $response['message'] = "Email unknown!.";
            }
        }
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
    $mail->Username = "tianit1212@gmail.com";
    $mail->Password = "gpurpsolbzkbemsd";

    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = $email;
    $mail->FromName = "Login Verification";

    $mail->addAddress($email, "Login Verification");

    $mail->isHTML(true);

    $mail->Subject = "Password Reset";
    $mail->Body = "<html>
                    <head>

                    </head>
                    <body>
                        <h1>Password Reset</h1>
                        <p>Dear Customer,
                        <p>Your password reset code is $code.</p>
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
