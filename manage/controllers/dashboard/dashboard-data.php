<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "./../vendor/autoload.php";
require_once "../controllers/account/access.php";
require_once './../config/config.php';

session_start();


if (!isset($_SESSION['username'])) {
    header("location:.");
} else {
    $username = $_SESSION['username'];
}

//fetch users
$fetch = false;
$fetchUsers = mysqli_query($conn, "select * from users");
if (mysqli_num_rows($fetchUsers) > 0) {
    $fetch = true;
}
//fetch pending accounts
$activateUser = mysqli_query($conn, "select * from users where status='pending'");
if (mysqli_num_rows($activateUser) > 0) {
    $fetch = true;
}

$fetched_withdraw = false;
$withdrawals = mysqli_query($conn, "select * from withdraw where status='pending' or status='declined'");
if (mysqli_num_rows($withdrawals) > 0) {
    $fetched_withdraw = true;
}


//activate account

if (isset($_POST['activate-account'])) {
    $userid = $_POST['userid'];
    $usercode = rand(1000000000, 9999999999);
    $email = getEmail($userid);
    if (account_activated($email, $usercode)) {
        $sql = mysqli_query($conn, "update users set status='activated' where userid='$userid'");
        if (mysqli_affected_rows($conn) > 0) {
            $sql = "INSERT INTO `account` (`userid`, `usercode`) VALUES (?, ?)";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, 'si', $userid, $usercode);
                mysqli_stmt_execute($stmt);
                if (mysqli_affected_rows($conn) > 0) {
                    echo "<script>alert('Activation successful')
                    window.location.href='./dashboard.php?activate'
                    </script>";
                } else {
                    echo "<script>alert('Activation unsuccessful')
                    window.location.href='./dashboard.php?activate'
                    </script>";
                }
            }
        }
    }
}
if (isset($_POST['block-account'])) {
    $userid = $_POST['userid'];
    $sql = mysqli_query($conn, "UPDATE `users` SET `status` = 'deactivated' WHERE `users`.`userid` = '$userid'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Account blocked successfully')
        window.location.href='./dashboard.php';
        </script>";
    }
}
if (isset($_POST['unblock-account'])) {
    $userid = $_POST['userid'];
    $sql = mysqli_query($conn, "UPDATE `users` SET `status` = 'activated' WHERE `users`.`userid` = '$userid'");
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Account unblocked successfully')
        window.location.href='./dashboard.php';
        </script>";
    }
}

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
function getStatus($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        return $row['status'];
    }
}
//proces status function
function processStatus($data)
{
    global $statusValue;
    switch ($data) {
        case 'activated':
            $statusValue = "<span class='btn btn-success btn-sm'>Active</span>";
            break;
        case 'deactivated':
            $statusValue = "<span class='btn btn-secondary btn-sm'>Suspended</span>";
            break;
        default:
            $statusValue = "<span class='btn btn-warning btn-sm'>Pending</span>";
            break;
    }
    return $statusValue;
}

//Approve depposit
$deposit_fetched = false;
$fetchDepsit = mysqli_query($conn, "select * from deposit where (status='pending' or status='declined')");
if (mysqli_num_rows($fetchDepsit) > 0) {
    $deposit_fetched = true;
}

function fetch_email($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $email = $row['email'];
        return $email;
    }
}

if (isset($_POST['approve'])) {
    $userid = $_POST['userid'];
    $email = getEmail($userid);
    $amount = $_POST['amount'];
    $formatted_amount = number_format($amount, 2);
    $reference = $_POST['reference'];

    if (send_approval_email($email, $reference, $formatted_amount)) {
        $sql = mysqli_query($conn, "UPDATE `account` SET `plan`= '$amount' WHERE `userid` = '$userid'");
        if (mysqli_affected_rows($conn) > 0) {
            mysqli_query($conn, "update deposit set status='approved' where ((userid='$userid') and (reference='$reference'))");
            mysqli_query($conn, "update users set plan='$amount' where userid='$userid'");
            if (mysqli_affected_rows($conn) > 0) {
                echo "<script>alert('Account funding approved..')
                window.location.href='?deposits'
                </script>";
            }
        } else {
            var_dump($conn);
        }
    } else {
        echo "<script>alert('Email could not be sent')
        window.location.href='?deposits'
        </script>";
    }
}
if (isset($_POST['decline'])) {
    $userid = $_POST['userid'];
    $email = getEmail($userid);
    $amount = $_POST['amount'];
    $reference = $_POST['reference'];

    $symbol = $currencySymbols[fetch_currency($userid)];

    if (send_decline_email($email, $reference, $amount, $symbol)) {
        $sql =  mysqli_query($conn, "update deposit set status='declined' where ((userid='$userid') and (reference='$reference'))");
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('Account funding declined..')
                window.location.href='?deposits'
                </script>";
        }
    } else {
        echo "<script>alert('Email could not be sent')
        window.location.href='?deposits'
        </script>";
    }
}




function send_approval_email($email, $reference, $amount)
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
    $mail->Username = "dexeterone@gmail.com";
    $mail->Password = "gxmjqoaohkfyjjok";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "account-deposit@optimuminternationalmarkets.com";
    $mail->FromName = "T-Cloud Deposit Team";

    $mail->addAddress($email, "Miner");

    $mail->isHTML(true);

    $mail->Subject = "Approved deposit";
    $mail->Body = "<html>
                    
                    <body>
                        <h1>Deposit Approved</h1>
                        <p>Dear Miner,
                        <p>Payment of <em style='color:red'>$$amount</em> with transaction ID:<strong>$reference</strong> has been successfully approved.</p>
                        <p>Kindly login and enjoy the best of trading.</p>
                        <p>
                            <Strong>Regards</strong>
                        </p>
                        <p><strong>T-Cloud Finance</strong></p>
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
function send_decline_email($email, $reference, $amount, $currency)
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
    $mail->Username = "dexeterone@gmail.com";
    $mail->Password = "gxmjqoaohkfyjjok";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "account-deposit@optimuminternationalmarkets.com";
    $mail->FromName = "OIM";

    $mail->addAddress($email, "Trader");

    $mail->isHTML(true);

    $mail->Subject = "Declined Deposit";
    $mail->Body = "<html>
                    
                    <body>
                        <h1>Deposit Decline</h1>
                        <p>Dear Trader,
                        <p>Your deposit of <em style='color:red'>$$amount</em> with refence:<strong>$reference</strong> has been declined.</p>
                        <p>Contact admin for details.</p>
                        <p>
                            <Strong>Regards</strong>
                        </p>
                        <p><strong>Optimum International Market Finance</strong></p>
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





function account_activated($email, $accountCode)
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
    $mail->Username = "dexeterone@gmail.com";
    $mail->Password = "gxmjqoaohkfyjjok";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
    //Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "acount-activation@t-cloud.com";
    $mail->FromName = "T-Cloud HR";

    $mail->addAddress($email, "Trader");

    $mail->isHTML(true);

    $mail->Subject = "Account Activated";
    $mail->Body = "<html>

<head>

</head>

<body>
    <h1>Account Activated</h1>
    <p>Dear Trader,
    <p>Congratulations, your account has been activated.</p>
    <p>Your account transaction code is: $accountCode.</p>
    <p>Ensure to keep your account code safe as it will be required for withdrawals.</p>
    <p>Kindly login and enjoy the best of trading.</p>
    <p>
        <Strong>Regards</strong>
    </p>
    <p><strong>T-Cloud Investment, LLC</p>
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
