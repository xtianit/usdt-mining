<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "./../../vendor/autoload.php";
require_once './../../controllers/account/access.php';

require_once './../../config/config.php';
require_once './../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => 0
);

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $userid = getID($email);
    $package = $_POST['package'];
    $reference = $_POST['reference'];
    $name =  getName($email);
    $date = date("Y-m-d:H:i:s");
    $update_plan = false;
    if (has_plan($email)) {
        $response['message'] = "Active plan exists";
        $update_plan = true;
    } else {
        if (email_admin_deposit($email, $package, $reference, $name)) {

            $sql  = "INSERT INTO `deposit` (`userid`, `email`, `package`, `reference`, `date`) 
                        VALUES (?, ?, ?, ?,?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssiss', $userid, $email, $package, $reference, $date);
                mysqli_stmt_execute($stmt);
                if (mysqli_affected_rows($conn) > 0) {
                    $response['status'] = 1;
                    $response['message'] = "Account deposited successfully. Your payment will be verified shortly";
                }
            }
        } else {
            $response['message'] = "Account deposit unsuccessful. Please try again..";
            var_dump($conn);
        }
    }
    if ($update_plan) {
        //send for plan update
        if (validate_update($email, $package)) {
            $response['message'] = "Choose a different package this time";
        } else {
            if (email_admin_update($email, $package, $reference, $name)) {
                $sql = mysqli_query($conn, "update deposit set package='$package', status='pending'");
                if (mysqli_affected_rows($conn) > 0) {
                    $response['status'] = 1;
                    $response['message'] = "Upgrade sent...";
                } else {
                    $response['message'] = "Upgrade failed!";
                }
            }
        }
    }
}

echo json_encode($response);

function has_plan($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from account where userid='$userid')");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $plan = $row['plan'];
        if (!empty($plan)) {
            return true;
        } else {
            return false;
        }
    }
}

function validate_update($email, $package)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from deposit where email='$email' and package=$package");
    if (mysqli_num_rows($sql) > 0) {
        return true;
    } else {
        return false;
    }
}

function email_admin_update($email, $package, $reference, $fullName)
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
    $mail->Username = "dexeterone@gmail.com";
    $mail->Password = "gxmjqoaohkfyjjok";

    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = $email;
    $mail->FromName = "Account Update";
    //change this to the company admin email address
    $mail->addAddress("services@tcloudusdt.com", "Account Update"); //company email here

    $mail->isHTML(true);

    $mail->Subject = "Account Update";
    $mail->Body = "<html>
                    <body style='padding:50px'>
                        <h1>Account Deposit</h1>
                        <p>Dear Admin,
                        <p>An update of $package USDT package from $email with a reference number: $reference, is awaiting your approval.</p>
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
function email_admin_deposit($email, $package, $reference, $fullName)
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
    $mail->Username = "dexeterone@gmail.com";
    $mail->Password = "gxmjqoaohkfyjjok";

    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = $email;
    $mail->FromName = "Account Deposit";
    //change this to the company admin email address
    $mail->addAddress("ohore4luv@yahoo.com", "T-Cloud USDT Mining"); //company email here

    $mail->isHTML(true);

    $mail->Subject = "Account Deposit";
    $mail->Body = "<html>
                    <body style='padding:50px'>
                        <h1>Account Deposit</h1>
                        <p>Dear T-Cloud Admin,
                        <p>A purchase of $package USDT package from $email with a reference number: $reference, is awaiting your approval.</p>
                        <p>Copy customer's reference number to payment explorer for payment validation.<p>
                        <p>Endeavour to login to your dashboard for validation and approvals.<p>
                        <p>Regards</p>
                        <p>$fullName</p>
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
