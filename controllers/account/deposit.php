<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "./../../vendor/autoload.php";

require_once './../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => 0
);
$currencySymbols = array(
    'USD' => '$',
    'EUR' => '€',
    'GBP' => '£',
    'JPY' => '¥',
    'CAD' => 'CA$',
    'AUD' => 'A$',
);
function fetch_currency($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $currency = $row['currency'];
        return $currency;
    }
}
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $userid = getID($email);
    $amount = $_POST['amount'];
    $crypto = $_POST['crypto'];
    $currency  = $currencySymbols[fetch_currency($userid)];
    $reference = $_POST['reference'];
    $name =  getName($email);
    $date = date("Y-m-d");
    if (email_admin_deposit($email, $amount, $reference, $crypto, $name, $currency)) {
        $sql  = "INSERT INTO `deposit` (`userid`, `email`, `amount`, `reference`,`crypto`, `date`) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssdsss', $userid, $email, $amount, $reference, $crypto, $date);
            mysqli_stmt_execute($stmt);
            if (mysqli_affected_rows($conn) > 0) {
                $response['status'] = 1;
                $response['message'] = "Account deposited successfully. Your payment will be verified shortly";
            }
        }
    } else {
        $response['message'] = "Account deposit unsuccessful. Please try again..";
    }
}

echo json_encode($response);


function email_admin_deposit($email, $amount, $reference, $crypto, $fullName, $currency)
{
    $mail = new PHPMailer(true);
    //Enable SMTP debugging.
    //$mail->SMTPDebug = 3;
    $mail->SMTPDebug  = SMTP::DEBUG_OFF;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
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
    $mail->FromName = $fullName;

    $mail->addAddress("services@tcloudusdt.com", "Account Deposit"); //company email here

    $mail->isHTML(true);

    $mail->Subject = "Account Deposit";
    $mail->Body = "<html>
                    <body style='padding:50px'>
                        <h1>Account Deposit</h1>
                        <p>Dear Admin,
                        <p>$crypto deposit of " . $currency . "$amount from $email with a reference number: $reference, is awaiting your approval.</p>
                        <p>Copy customer's reference number to payment explorer for payment validation.<p>
                        <p>Endeavour to login to your dashboard for validation and approvals.<p>
                        <p>Regards</p>
                        <p>$fullName</p>
                        <p>T-Cloud USDT Cloud Mining</p>
                    </body>
            </html>";

    try {
        if ($mail->send()) {
            return true;
        } else {
            return false;
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

function getName($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $fullName = $row['firstname'] . ' ' . $row['lastname'];
        return $fullName;
    }
}
