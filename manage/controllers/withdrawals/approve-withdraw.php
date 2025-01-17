<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "./../../../vendor/autoload.php";
require_once '../../../controllers/account/access.php';

require_once '../../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => 0
);


if (isset($_POST['id'])) {
    $ref = $_POST['reference'];
    $userid = $_POST['id'];
    $email = getEmail($userid);
    $amount = $_POST['amount'];
    $fullname = getFullName($userid);
    if (send_withdrawal_approval_email($email, $ref, $amount, $fullname)) {
        $sql = mysqli_query($conn, "update withdraw 
            set status = 'approved', amount='$amount' 
            where reference='$ref')");
        if (mysqli_affected_rows($conn) > 0) {
            $response['status'] = 1;
            $response['message'] = "Withdrawal sent.";
        } else {
            var_dump($conn);
        }
    }
}

echo json_encode($response);


function getEmail($id)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where userid='$id'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $email = $row['email'];
        return $email;
    }
}
function getFullName($id)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where userid='$id'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $name = $row['firstname'] . ' ' . $row['lastname'];
        return $name;
    }
}


function send_withdrawal_approval_email($email, $reference, $amount, $name)
{
    $mail = new PHPMailer(true);
    //Enable SMTP debugging.
    //$mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     
    $mail->Username = "dexeterone@gmail.com";
    $mail->Password = "gxmjqoaohkfyjjok";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "service@tcloud.com";
    $mail->FromName = "T-Cloud Trading Community";

    $mail->addAddress($email, "Trader");

    $mail->isHTML(true);

    $mail->Subject = "Fund Withdrawals";
    $mail->Body = "<html>
                    
                    <body>
                        <h1>Withdrawal Successful</h1>
                        <p>Dear $name,
                        <p>Your wallet has been credited with the sum of :<em style='color:red'>$amount USDT</em>. Your payment reference is:<strong>$reference</strong>.</p>
                        <p>For complaint, query or any form of inconsistencies send email with your reference code to:</p>
                        <p>payment@optimummarket.com</p>
                        <p>
                            <Strong>Regards</strong>
                        </p>
                        <p><strong>OIM Finance</strong></p>
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
