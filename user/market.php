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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/trade.css">
    <script src="../assets/js/investment.js"></script>
    <style>
        .hover-div {
            background-color: black;
            padding: 10px;
            transition: box-shadow 0.3s ease;
            cursor: pointer;
        }

        .hover-div:hover {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
        }

        .flex h3,
        .flex p {
            color: darkgreen;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }

        @media screen and (max-width:600px) {
            .flex {
                flex-direction: column !important;
                width: 100% !important;
            }

            .flex {
                text-align: center;
            }
        }
    </style>
    <title>T-Cloud</title>
</head>

<body>

    <?php require_once "./inc/user-header-data.php" ?>
    <div class="user-home mb-5" style="margin-top:100px;">
        <?php require_once "./inc/user-home-side.php" ?>
        <div class="gainers-data bg-dark mb-5">
            <h3 class="p-3 plans">Investment Plans</h3>
            <div class="container-fluid mb-5">
                <?php
                switch ($_GET) {
                    case isset($_GET['']):
                        require_once "./markets/plans.php";
                        break;
                    case isset($_GET['plan20']):
                        require_once "./markets/plan20.php";
                        break;
                    case isset($_GET['plan50']):
                        require_once "./markets/plan50.php";
                        break;
                    case isset($_GET['plan100']):
                        require_once "./markets/plan100.php";
                        break;
                    case isset($_GET['plan300']):
                        require_once "./markets/plan300.php";
                        break;
                    case isset($_GET['plan500']):
                        require_once "./markets/plan500.php";
                        break;
                    case isset($_GET['plan1000']):
                        require_once "./markets/plan1000.php";
                        break;
                    case isset($_GET['plan3000']):
                        require_once "./markets/plan3000.php";
                        break;
                    case isset($_GET['plan5000']):
                        require_once "./markets/plan5000.php";
                        break;
                    case isset($_GET['plan10000']):
                        require_once "./markets/plan10000.php";
                        break;
                    case isset($_GET['plan30000']):
                        require_once "./markets/plan30000.php";
                        break;
                }
                ?>
            </div>
        </div>
        <div id="cover-spin"></div>
        <?php
        require_once "./inc/footer-data.php";
        ?>
    </div>


    <script src="../assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script type="text/javascript">
        var qrcode = new QRCode("qrcode", {
            text: "http://jindo.dev.naver.com/collie",
            width: 50,
            height: 50,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
    </script>
    <script src="../assets/js/process.js"></script>
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