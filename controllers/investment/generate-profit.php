<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require_once "./../../vendor/autoload.php";
require_once './../../controllers/account/access.php';

require_once './../../config/config.php';
if (isset($_POST['email'])) {
    //fetch userplan

}
$email = $_POST['email'];

$userid = userid($email);
//fetch plan
$currentPlan = userPlan($userid);
$currentPlanData = '$' . userPlan($userid);

$investment = calculatePlan($currentPlanData, $currentPlan);
$date = date("F j, Y, g:i a");
//compute investment data
//check email
$checkEmail = mysqli_query($conn, "select * from users where email='$email'");
if(mysqli_num_rows($checkEmail)>0){
    //check investment data and plan
    $check_investment = mysqli_query($conn, "select * from account where userid='$userid'");
    if(mysqli_num_rows($check_investment)>0){
        
    }
}
$invUpdate = "update account set amount=(amount + ?) where userid =?";
if ($stmt = mysqli_prepare($conn, $invUpdate)) {
    mysqli_stmt_bind_param($stmt, 'ds', $investment, $userid);
    mysqli_stmt_execute($stmt);
    if (mysqli_affected_rows($conn)) {
        $insStats  = "INSERT INTO `investments` (`email`, `package`, `accrual`, `date`) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $insStats)) {
            mysqli_stmt_bind_param($stmt, 'ssds', $email, $currentPlanData, $investment, $date);
            mysqli_stmt_execute($stmt);
        }
    }
}
//fetch plan rate
function userPlan($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from account where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $plan = $row['plan'];
        return $plan;
    }
}

function userid($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email' limit 1");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $userid = $row['userid'];
        return $userid;
    }
}

function calculatePlan($planData, $plan)
{
    $accrual = '';
    switch ($planData) {
        case '$20':
            $accrual = $plan * 0.04;
            break;
        case '$50':
            $accrual = $plan * 0.05;
            break;
        case '$100':
            $accrual = $plan * 0.06;
            break;
        case '$300':
            $accrual = $plan * 0.06;
            break;
        case '$500':
            $accrual = $plan * 0.06;
            break;
        case '$1000':
            $accrual = $plan * 0.07;
            break;
        case '$3000':
            $accrual = $plan * 0.07;
            break;
        case '$5000':
            $accrual = $plan * 0.07;
            break;
        case '$10000':
            $accrual = $plan * 0.08;
            break;
        case '$30000':
            $accrual = $plan * 0.08;
            break;
    }
    return $accrual;
}

