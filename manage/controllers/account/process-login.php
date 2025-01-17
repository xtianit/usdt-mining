<?php
require_once "./../../../vendor/autoload.php";
require_once './../../../controllers/account/access.php';
require_once './../../config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => 0

);



if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from manager where username=?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $pass = $row['password'];
            if (password_verify($password, $pass)) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['logged_in'] = true;
                $response['status'] = 1;
                $response['message'] = "Authentication successful";
            } else {
                $response['message'] = "Invalid login creadentials provided.";
            }
        }
    }
}

echo json_encode($response);
