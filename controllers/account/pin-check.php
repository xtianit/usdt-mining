<?php

require_once "./../../vendor/autoload.php";
require_once './../../controllers/account/access.php';

require_once './../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => 0
);

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $pin = $_POST['pin'];
    $userid = getID($email);

    $checkPin = mysqli_query($conn, "select usercode from account where userid='$userid'");
    if (mysqli_num_rows($checkPin) > 0) {
        $row = mysqli_fetch_assoc($checkPin);
        $userpin = $row['usercode'];
        if ($pin === $userpin) {
            $response['message'] = "Success: Pin is valid";
            $response['status'] = 1;
        } else {
            $response['message'] = "Error: Pin is invalid";
        }
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
