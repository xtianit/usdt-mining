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
$length = 32; // The desired length of the random string, in bytes

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $userid = getID($email);
    $amount = (float)$_POST['amount'];
    $wallet_address = $_POST['walletAddress'];
    $cryptoName = $_POST['cryptoName'];
    $reference = bin2hex(random_bytes($length));
    $date = date("Y-m-d:h:i:s");
    $fullname = fullName($email);
    if (checkbalance($userid, $amount)) {
        if (email_admin_withdrawal($email, $amount, $reference, $fullname)) {

            $sql = mysqli_query($conn, "update account set amount=amount-'$amount' where userid='$userid'");
            if (mysqli_affected_rows($conn) > 0) {
                $sql = mysqli_query($conn, "INSERT INTO `withdraw` (`userid`, `amount`, `wallet`, `crypto`, `reference`, `date`) 
                                            VALUES ('$userid', '$amount', '$wallet_address', '$cryptoName', '$reference','$date')");
                if (mysqli_affected_rows($conn) > 0) {
                    $response['status'] = true;
                    $response['message'] = "Withdrawal request completed. Your account will be credited within 2 business days";
                } else {
                    $response['message'] = "Withdrawal request failed.";
                    var_dump($conn);
                }
            }
        }
    } else {
        $response['message'] = "Insufficient balance";
    }
}
echo json_encode($response);

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
function fullName($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $fullname = $row['firstname'] . ' ' . $row['lastname'];
        return $fullname;
    }
}

function checkbalance($userid, $withdrawalAmount)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from account where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $balance = $row['amount'];
        if ($balance >= $withdrawalAmount) {
            return true;
        } else {
            return false;
        }
    }
}

function email_admin_withdrawal($email, $amount, $reference, $name)
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

    $mail->From = $email;
    $mail->FromName = "Withdrawal Request";

    $mail->addAddress("services@tcloudusdt.com", "T-Cloud Finance"); //company email here

    $mail->isHTML(true);

    $mail->Subject = "Fund Withdrawal Request";
    $mail->Body = "<html>
                    <body style='padding:50px'>
                        <h1>Fund Withdrawal Request</h1>
                        <p>Dear T-Cloud Admin,
                        <p>A withdrawal of $amount USDT from $name with a transaction id: $reference, awaits your approval.</p>
                        <p>Login to your dashboard for approval as fund will not be given out without approval.<p>
                        <p>Regards.</p>
                        <p>$name/p>
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
