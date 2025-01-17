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
    $userid = getID($email);
    $amount = $_POST['amount'];
    $reference = $_POST['reference'];
    $date = date("Y-m-d");
    $sql  = "INSERT INTO `deposit` (`userid`, `email`, `amount`, `reference`, `date`) VALUES (?,  ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'ssdss', $userid, $email, $amount, $reference, $date);
        mysqli_stmt_execute($stmt);
        if (mysqli_affected_rows($conn) > 0) {
            if (email_admin_deposit($email, $amount, $reference)) {
                $response['status'] = 1;
                $response['message'] = "Account deposit successful";
            }
        }
    }
}

echo json_encode($response);


function email_admin_deposit($email, $amount, $reference)
{
    $mail = new PHPMailer(true);
    //Enable SMTP debugging.
    //$mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     
    $mail->Username = "tianit1212@gmail.com";
    $mail->Password = "fcgtupvvfqawrtkj";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = $email;
    $mail->FromName = "Peimexbl Trading Community";

    $mail->addAddress($email, "PrimeXBL Admin");

    $mail->isHTML(true);

    $mail->Subject = "Account Deposit";
    $mail->Body = "<html>
                    <head>

                    </head>
                    <body>
                        <h1>Account Deposit</h1>
                        <p>Dear Admin,
                        <p>Account Deposit of: $$amount from $email with a reference number: $reference, is awaiting your approval.</p>
                        <p><a href='url'>Validate Payment</a><p>
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
