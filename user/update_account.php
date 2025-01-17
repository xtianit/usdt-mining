<?php
require_once "../config/config.php";
$response = array(
    'status' => false,
    'message' => '',
);
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $operations = $_POST['operation'];
    $amount = $_POST['amount'];
    $userid = getUserId($email);
    $balance = getBalance($userid);
    $deduction = deduction($balance);
    switch ($operations) {
        case 'subtract':
            $sub = mysqli_query($conn, "update account set amount=amount-'$deduction'");
            break;
        case 'add':
            $sub = mysqli_query($conn, "update account set amount=amount+'$deduction'");
            break;
    }
    if (mysqli_affected_rows($conn) > 0) {
        $response['status'] = true;
        $response['message'] = 'Successful';
    }
}

echo json_encode($response);

function deduction($amount)
{
    $deduction = ($amount * 0.001);
    return $deduction;
}

function getBalance($userid)
{
    global $conn;
    $sql = mysqli_query($conn, "select amount from account where userid='$userid'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $amount = $row['amount'];
        return $amount;
    }
}




function getUserId($email)
{
    global $conn;
    $sql = "select userid from users where email=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            return $row['userid'];
        }
    }
}

