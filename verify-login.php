<?php
require_once './vendor/autoload.php';
require_once './controllers/account/access.php';
require_once './config/config.php';

if (isset($_POST['verify'])) {
    $email = $_POST['email'];
    $vcode = $_POST['vcode'];
    $sql = mysqli_query($conn, "select * from verification where email='$email'");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_array($sql);
        $code = $row['code'];
        if ($vcode === $code) {
            session_start();
            $_SESSION['email'] = $email;
            header("location:./user");
        } else {
            echo "<script>alert('Invalid verification code provided!')</script>";
        }
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
    session_start();
    if (isset($_GET['current'])) {
        $email = $_GET['current'];
    }
    ?>

    <section class=" mt-5">

        <div class="container mt-5 diaplay-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-xl-5 p-5 m-5 mx-auto">
                    <center>
                        <img src="./assets/images/site/tcloud-logo.png" style="max-height: 150px" class="responsive-img" />
                    </center>
                    <h4 class="h4 text-center">Email Verification</h4>

                    <form method="post" class="d-flex justify-content-center flex-column">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <label for="" class="d-block text-center"><?= $email ?></label>
                        <label class="mt-3 text-center" style="text-align:center">Enter verification code:</label>

                        <div class="d-flex justify-content-center">
                            <input type="text" id="vcode" name="vcode" autocomplete="off" placeholder="Enter verification code" class="px-0 form-control form-control-sm" value="">
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <button name="verify" class="text btn btn-sm btn-outline-dark mt-3">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>

    <div id="cover-spin"></div>







    <!--main -->

    <!--end of content-->









    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="./assets/js/process.js"></script>
</body>

</html>