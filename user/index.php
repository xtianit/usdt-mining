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
    <?php if (!check_verification($email)) { ?>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 d-flex align-items-center justify-content-center text-danger flex-column p-5 mt-5">
                    <h1>YOUR ACCOUNT STILL UNDER REVIEW</h1>
                    <p>You will be sent an email as soon as your account is fully activated.</p>
                    <p>Thank you.</p>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="user-home mb-5" style="margin-top:100px;">
            <?php require_once "./inc/user-home-side.php" ?>
            <div class=" gainers-data mb-5">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container" style="height:80vh">
                    <div id="tradingview_b5cba"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                        new TradingView.widget({
                            "autosize": true,
                            "symbol": "CRYPTOCAP:USDT",
                            "interval": "D",
                            "width": "100%",
                            "height": "100%",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "1",
                            "locale": "en",
                            "toolbar_bg": "#f1f3f6",
                            "enable_publishing": false,
                            "allow_symbol_change": true,
                            "container_id": "tradingview_b5cba"
                        });
                    </script>
                </div>
                <!-- TradingView Widget END -->
            </div>
            <?php
            require_once "./inc/footer-data.php";
            ?>
        </div>
    <?php } ?>

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