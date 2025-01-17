<?php
require_once './../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => 0

);
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $vcode = $_POST['vcode'];
    $sql = mysqli_query($conn, "select * from verification where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
        $code = $row['code'];
        if ($vcode === $code) {
            $response['status'] = 1;
            $response['message'] = "Account verified successfully. It will be under review for 24 hours.";
        } else {
            $response['message'] = "Invalid verification code provided!";
        }
    }
}
    
echo json_encode($response);
