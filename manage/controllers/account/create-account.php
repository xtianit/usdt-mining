<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "./../../vendor/autoload.php";
require_once './../../controllers/account/access.php';

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

        // Convert the random bytes to a hexadecimal string
        $hexString = bin2hex($randomBytes);
        //end of random key generation

        $id  = $hexString;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phash = password_hash($password, PASSWORD_DEFAULT);
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $zipcode = $_POST['zipcode'];
        $currency = $_POST['currency'];
        $accountType = $_POST['accountType'];
        $accept = $_POST['accept'];

        if ($accept == "on") {
            $accept = "true";
        } else {
            $accept = "false";
        }
        $fullName = $firstName . " " . $lastName;
        $vcode = rand(100000, 999999);
        if (send_registration_email($email, $fullName, $vcode)) {
            $sql = "INSERT INTO `users` (`userid`, `firstname`, `lastname`, `email`, `password`, `country`, `state`, `city`, `currency`, `accountType`,`zipcode`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, 'sssssssssss', $id, $firstName, $lastName, $email, $phash, $country, $state, $city, $currency, $accountType, $zipcode);
                mysqli_stmt_execute($stmt);
                $res = mysqli_stmt_get_result($stmt);
                if (mysqli_affected_rows($conn) > 0) {
                    $sql = "INSERT INTO `verification` (`userid`,`email`, `code`) VALUES ('$id,','$email', '$vcode')";
                    $verification = mysqli_query($conn, $sql);
                    if (mysqli_affected_rows($conn) > 0) {
                        $response['message'] = "Account created successfully";
                        $response['status'] = 1;
                    }
                } else {
                    var_dump($conn);
                }
            }
        }
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
    $mail->CharSet = 'UTF-8';
    //Set SMTP host name                          
    $mail->Host = "smtp.mailosaur.net";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     
    $mail->Username = "aes0tlya@mailosaur.net";
    //$mail->Password = "gpurpsolbzkbemsd";
    $mail->Password = "qF5MvptGylDGcxPHT5sDlyagoRv0FP4O";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "services@tcloudusdt.com";
    $mail->FromName = "<p>T-Cloud USDT Cloud Mining</p>";

    $mail->addAddress($email, $fullName);

    $mail->isHTML(true);

    $mail->Subject = "Account Creation";
    $mail->Body = "<html>
                    <head>

                    </head>
                    <body>
                        <h1>Account Creation</h1>
                        <p>Dear $fullName,
                        <p>Welcome to <strong>Primexbl Trading Community.</p>
                        <p>Our community provides the best of trading, lowest leverages, and free account with a minimum fuss.</p>
                        <p>Traders in our community are diversified and keen to copying trades irrespective of expertise.</p>
                        <p>Please note that you account will be under review for 3 business days before activation but meanwhile you will be 
                        given access to our individual resources and deem necessary.</p>
                        <p>Your prelimnary verification code is $code. You will need this code for validation.</p>
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
