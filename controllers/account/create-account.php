<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "./../../vendor/autoload.php";
require_once "./../../controllers/account/access.php";

require_once './../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "email" => "false",
    "status" => 0
);


if (isset($_POST['email'])) {
    $email = $_POST['email'];
    //Check email availability
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $response['message'] = "Email unavailable";
    } else {
        $response['email'] = "true";
        //genetate random key for users
        $length = 16; // Length of the random bytes you want to generate
        // Generate random bytes
        $randomBytes = random_bytes($length);
        //fetch cypher data for encryption
        // Convert the random bytes to a hexadecimal string
        $hexString = bin2hex($randomBytes);
        //end of random key generation
        $referral = $_POST['referral'];
        $id  = $hexString;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phash = password_hash($password, PASSWORD_DEFAULT);
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $accept = $_POST['accept'];
        $ref_code = generateReferralCode(200);
        if ($accept == "on") {
            $accept = "true";
        } else {
            $accept = "false";
        }
        $fullName = $firstName . " " . $lastName;
        $date = date("Y-m-d");
        $vcode = rand(100000, 999999);
        //if (send_registration_email($email, $fullName, $vcode)) {
        $sql = "INSERT INTO `users` (`userid`, `firstname`, `lastname`, `email`, `password`, `country`, `state`, `gender`,`phone`,`date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssssssss', $id, $firstName, $lastName, $email, $phash, $country, $state, $gender, $phone, $date);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if (mysqli_affected_rows($conn) > 0) {
                $sql = "INSERT INTO `verification` (`userid`,`email`, `code`) VALUES ('$id,','$email', '$vcode')";
                $verification = mysqli_query($conn, $sql);
                if (mysqli_affected_rows($conn) > 0) {

                    $sql = mysqli_query($conn, "INSERT INTO `referral_account` (`userid`) VALUES ('$ref_code')");
                    if (mysqli_affected_rows($conn) > 0) {
                        //Create referral list
                        $addReferral = mysqli_query($conn, "INSERT INTO `referrals` (`userid`,`referral_code`) VALUES ('$id','$ref_code')");
                        //check if user was referred by someone
                        if (!empty($referral)) {
                            $updateRefrral = mysqli_query($conn, "update referrals set referrer_id='$referral' where referral_code='$ref_code'");
                            $refAccount = mysqli_query($conn, "update referral_account set referralCount=referralCount+'1', bonus=bonus+'0.2' where userid='$referral'");
                        } else {
                            $response['message'] = "You do not have a referral";
                        }
                        $response['message'] = "Account created successfully";
                        $response['status'] = 1;
                    }
                }
            }
        }
        //}
    }
}

echo json_encode($response);

function send_registration_email($email, $fullName, $code)
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
    $mail->Username = "airsprev@gmail.com";
    $mail->Password = "dogrjalumfqcnlel";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "services@tcloudusdt.com";
    $mail->FromName = "T Cloud USDT Cloud Mining, LLC";

    $mail->addAddress($email, $fullName);

    $mail->isHTML(true);

    $mail->Subject = "Account Creation";
    $mail->Body = "<html>
                    <head>

                    </head>
                    <body>
                        <h1>Account Creation</h1>
                        <p>Dear $fullName,
                        <p>Welcome to <strong>T-Cloud Investment, where we make trading easy as easy as possible</p>
                        <p>Our community provides the best of USDT trading, with daily accruing profits per plan investments.</p>
                        <p>Please note that you account will be under review pending activication.</p>
                        <p>Your prelimnary verification code is $code. You will need this code for validation.</p>
                        <p>
                            <Strong>Regards</strong>
                        </p>
                        <p><strong>T Cloud USDT Cloud Mining</p>
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



function getUserIP()
{
    // Check for the most common server variables containing the user's IP address
    $ipVars = array(
        'HTTP_X_FORWARDED_FOR',
        'HTTP_CLIENT_IP',
        'HTTP_X_REAL_IP',
        'HTTP_X_CLUSTER_CLIENT_IP',
        'HTTP_FORWARDED_FOR',
        'HTTP_FORWARDED',
        'REMOTE_ADDR',
    );

    foreach ($ipVars as $ipVar) {
        if (isset($_SERVER[$ipVar]) && filter_var($_SERVER[$ipVar], FILTER_VALIDATE_IP)) {
            return $_SERVER[$ipVar];
        }
    }

    // Fallback method to get the IP address
    if (isset($_SERVER['REMOTE_ADDR']) && filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) {
        return $_SERVER['REMOTE_ADDR'];
    }

    // Return a default IP address if all methods fail
    return 'unknown';
}
