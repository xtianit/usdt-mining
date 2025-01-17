<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "./../vendor/autoload.php";
require_once './../config/config.php';

$response = array(
    "message" => ""
);

$email = $_POST['email'];


if (send_email_to_admin($email)) {
    $response["message"] = "Message sent to admin...";
}

function send_email_to_admin($email)
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

    $mail->From = "ohore4luv@yahoo.com";
    $mail->FromName = "Premium Trading Community";

    $mail->addAddress("ohore4luv@gmail.com", "T-Cloud Admin");

    $mail->isHTML(true);

    $mail->Subject = "Copying Trade";
    $mail->Body = "<html>
                    <head>

                    </head>
                    <body>
                        <h1>Copying Traders</h1>
                        <p>Dear Admin,
                        <p>This is to notify you that $email is copying a trade.</p>

                        <p>
                            <Strong>Regards</strong>
                        </p>
                        <p><strong>Prime XBL Trading Company LLC</p>
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
