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
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    //check if the password has been used
    $OldPasswordCorrect = false;
    $passCheck = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($passCheck) > 0) {
        $row = mysqli_fetch_assoc($passCheck);
        $pass = $row['password'];
        $fullName = $row['lastname'] . ' ' . $row['firstname'];
        if (password_verify($oldPass, $pass)) {
            $OldPasswordCorrect = true;
        } else {
            $response['message'] = "The old password provided is invalid";
        }
    }
    if ($OldPasswordCorrect === true) {
        if (email_password_change_notification($email, $fullName)) {
            $hashPass = password_hash($newPass, PASSWORD_DEFAULT);
            $sql = mysqli_query($conn, "update users set password='$hashPass' where email='$email'");
            if (mysqli_affected_rows($conn) > 0) {
                $response['status'] = 1;
                $response['message'] = 'Password updated successfully';
            } else {
                $response['message'] = 'Password could not be updated.';
            }
        }
    }
}

echo json_encode($response);





function email_password_change_notification($email, $name)
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
    $mail->FromName = "Password Reset";

    $mail->addAddress($email, "Password Reset"); //company email here

    $mail->isHTML(true);

    $mail->Subject = "Password Reset";
    $mail->Body = "<html>
                    <body>
                        <h1>Password Reset</h1>
                        <p>Dear $name,
                        <p>Your password was changed successfuly</p>
                        <p>
                            <Strong>Regards</strong>
                        </p>
                        <p>T-Cloud USDT Cloud Mining</p>
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
