<?php
require_once "./vendor/autoload.php";
require_once "./controllers/account/access.php";
require_once './config/config.php';

$response = array(
    "message" => "Something went wrong....",
    "status" => 0

);
if (isset($_POST['very-email'])) {
    $email = $_POST['email'];
    $vcode = $_POST['vcode'];
    $sql = mysqli_query($conn, "select * from verification where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
        $code = $row['code'];
        if ($vcode === $code) {
            session_start();
            $_SESSION['email'] = $email;
            $usercode = rand(1000000000, 9999999999);
            $userid = fetch_id($email);
            $vf = mysqli_query($conn, "update users set status='activated' where email='$email'");
            if (mysqli_affected_rows($conn) > 0) {
                //create account
                $sql = "INSERT INTO `account` (`userid`, `usercode`) VALUES (?, ?)";
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, 'si', $userid, $usercode);
                    mysqli_stmt_execute($stmt);
                    if (mysqli_affected_rows($conn) > 0) {
                        echo "<script>
                        alert('Your account has been verified successfully..')
                        window.location.href='./user'
                        </script>";
                    }else{
                        var_dump($conn);
                    }
                } else {
                    var_dump($conn);
                }
            }
        } else {
            echo "<script>alert('Invalid verification code')</script>";
        }
    }
}

function fetch_id($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from users where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $userid = $row['userid'];
        return $userid;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>T-Cloud - Verify</title>

    <meta property="”og:title”" content="T-Cloud" />
    <meta property="”og:image”" content="”./assets/images/site/logo.png”" />

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <link rel="stylesheet" href="./assets/css/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body style="background-color: white;">


    <?php
    if (isset($_GET['current'])) {
        $email = $_GET['current'];
    }
    ?>


    <section class=" mt-5">

        <div class="container">
            <div class="row">
                <div class="col-xl-5 p-5 m-5 mx-auto shadow-lg">
                    <h4 class="h4 text-center">Email Verification</h4>

                    <form method="post">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <strong for="" class="d-block text-center"><?= $email ?></strong>
                        <hr>
                        <label class="text-center">Enter verification code:</label>
                        <input type="text" id="vcode" name="vcode" autocomplete="off" placeholder="Enter code here" class="px-0 form-control form-control-sm border-0 border-bottom" style="border-radius:0; outline: none;">
                        <div class="d-flex align-items-center justify-content-center">
                            <button name="very-email" class=" btn btn-sm btn-info w-100 mt-3">Verify Email</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>







    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="./assets/js/process.js"></script>
</body>

</html>