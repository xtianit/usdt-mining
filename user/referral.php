<?php
require_once "./inc/user-data.php";

require_once "./inc/generate-profit.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/images/pwa/favicon.ico" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="48x48" href="./assets/images/favicon-48x48.png" />
    <meta name="mobile-web-app-capable" content="yes" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./assets/css/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/libs/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/trade.css">
    <title>T-Cloud</title>
</head>

<body>
    <?php require_once "./inc/user-header-data.php" ?>

    <div class="user-home mb-5" style="margin-top:80px;">
        <?php require_once "./inc/user-home-side.php" ?>
        <div class="gainers-data vh-50 bg-dark p-3 mb-5 d-flex flex-column">

            <?php
            $referral_id = fetch_referral_link($id);
            ?>

            <h5>Refer and Earn</h5>
            <p>We also have promotional contents where you can refer a friend to earn a sustainible percentage income.</p>
            <input class="form-control form-control-sm w-100" type="text" class="alert alert-light w-50" id="referralLinkInput" value="localhost/usdt-mining/signup.php?ref=<?= $referral_id ?>" readonly>
            <button id="copyButton" class="btn btn-sm btn-info mt-2">Copy Link</button>
            <!-- TradingView Widget END -->
        </div>
        <?php
        require_once "./inc/footer-data.php";
        ?>
    </div>



    <script>
        var copyButton = document.getElementById("copyButton");
        copyButton.addEventListener("click", function() {
            var referralLinkInput = document.getElementById("referralLinkInput");
            referralLinkInput.select();
            document.execCommand("copy");
            alert("Referral link copied to clipboard!");
        });
    </script>
    <script src="../assets/js/investment.js"></script>
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/64c0fa22cc26a871b02b54d8/1h68t26ne';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
</body>

</html>