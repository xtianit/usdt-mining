<?php
date_default_timezone_set('Africa/Lagos');
session_start();
require_once "../vendor/autoload.php";
require_once "../controllers/account/access.php";
require_once "../config/config.php";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) < 1) {
        header("location:../signin.php");
    }
} else {
    header("location:../signin.php");
}



$referral = mysqli_query($conn, "select * from users where email='$email'");
if (mysqli_num_rows($referral) > 0) {
    $row = mysqli_fetch_assoc($referral);
    $ref_link = $row['userid'];
}


function fetch_referral_link($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from referrals where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        return $row['referral_code'];
    }
}





//Account balance
function getBalance($email)
{
    global $conn;
    $userid = getUserid($email);
    $account = mysqli_query($conn, "select * from account where userid='$userid'");
    if (mysqli_num_rows($account) > 0) {
        $row = mysqli_fetch_assoc($account);
        $balance = $row['amount'];
        return $balance;
    }
}
function getUserid($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $userid = $row['userid'];
        return $userid;
    }
}
function getAccount($email)
{
    global $conn;
    $userid = getUserid($email);
    $sql = mysqli_query($conn, "select * from account where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $account = $row['usercode'];
        return $account;
    }
}

function check_verification($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        if ($row['status'] === 'pending') {
            return false;
        } else {
            return true;
        }
    }
}

$referral = mysqli_query($conn, "select * from users where email='$email'");
if (mysqli_num_rows($referral) > 0) {
    $row = mysqli_fetch_assoc($referral);
    $ref_link = $row['userid'];
}


$id = getUserid($email);
$fetched_investments = false;
$investments = mysqli_query($conn, "select * from investments where email='$email' order by date desc");
if (mysqli_num_rows($investments) > 0) {
    $fetched_investments = true;
}

$select_traders = false;
$expert_traders = mysqli_query($conn, "select * from traders");
if (mysqli_num_rows($expert_traders) > 0) {
    $select_traders = true;
}


$fetchProfile = mysqli_query($conn, "select * from users where email='$email'");
if (mysqli_num_rows($fetchProfile));
$profile = mysqli_fetch_assoc($fetchProfile);

function fetch_plan($id)
{
    global $conn;
    $sql = mysqli_query($conn, "select plan from account where userid='$id'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $currentPlan = $row['plan'];
        return $currentPlan;
    }
}

function fetch_my_plan($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from deposit where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        //check plan status
        if ($row['status'] === 'approved') {
            //fetch the user plan
            $current_plan = $row['package'];
            return $current_plan;
        }
    }
}

function is_ptoto_uploaded($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from photoid where userid='$email' limit 1");
    if (mysqli_num_rows($sql) > 0) {
        return true;
    } else {
        return false;
    }
}

function fetch_photo_id($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from photoid where userid='$email' limit 1");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        return $row['image'];
    }
}

function myReferralCode($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from referrals where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $referral_code = $row['referral_code'];
        return $referral_code;
    }
}

$refCode = myReferralCode($id);

function fetchReferralCount($ref_code)
{
    global $conn;
    $sql = mysqli_query($conn, "select count(referrer_id) as refs from referrals where referrer_id='$ref_code'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        return $row['refs'];
    }
}

function fetchReferralBonus($referralCode)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from referral_account where userid='$referralCode'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $bonus = $row['bonus'];
        return $bonus;
    }
}

function wallet($data){
    global $conn;
    $sql = mysqli_query($conn, "select * from usdt_address where id='1'");
    if(mysqli_num_rows($sql)>0){
        $row = mysqli_fetch_assoc($sql);
        $address = $row[$data];
        return $address;
    }
}


