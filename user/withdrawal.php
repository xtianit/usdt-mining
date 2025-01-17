<?php
require_once "./inc/user-data.php";
require_once "./inc/generate-profit.php";
?>

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
    <title>T-Cloud Wallet</title>
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
            <div class="gainers-data mb-5">
                <!-- TradingView Widget BEGIN -->
                <div class="container p-2 mb-5">
                    <div class="row">
                        <div class="col-xl-12">
                            <h2><i class="fa-solid fa-wallet"></i> My Wallet</h2>
                        </div>
                        <div class="col-xl-5 p-3 bg-secondary d-flex align-items-center justify-content-center flex-column">
                            <?php echo "<h4>Balance: " . number_format(getBalance($email), 2) . " USDT</h4>";
                            ?>
                            <hr>
                            <a class="btn btn-sm btn-danger" href="./market"><i class="fa-solid fa-money-bill-transfer"></i> Upgrade plan</a>
                        </div>
                        <div class="col-xl-5 pl-5">
                            <h4>Fund withdrawal procedure:</h4>
                            <p>Our fund withdrawal procesure is almost instaneous as long as your withdrawal pin is intact</p>
                            <p>You can withdraw funds in the following steps:</p>
                            <ol>
                                <li>
                                    Enter your account withdrawal pin and click next
                                </li>
                                <li>
                                    Enter you account password
                                </li>
                                <li>
                                    Enter the amount to withdraw
                                </li>
                                <li>
                                    Watch out for fund.
                                </li>
                            </ol>

                            <?php
                            if (isset($_GET['start-withdraw'])) { ?>
                                <div>
                                    <form id="check-pin">
                                        <input type="hidden" name="email" value="<?= $email ?>">
                                        <input type="password" name="pin" class="form-control form-control-sm mt-2 w-50">
                                        <button class="btn btn-sm btn-danger mt-2">Continue</button>
                                        <a class="btn btn-sm btn-warning mt-2" href="./withdrawal">Cancel</a>
                                    </form>
                                </div>
                                <div id="cover-spin"></div>
                            <?php } else if (isset($_GET['create-amount'])) { ?>
                                <form id="create-amount">
                                    <hr>
                                    <p>Enter amount to continue</p>
                                    <input type="hidden" name="email" value="<?= $email ?>">
                                    <input placeholder="Enter amount" type="text" name="amount" class="form-control form-control-sm w-50 mt-2 w-50">
                                    <input placeholder="Enter your wallet address here" type="text" name="walletAddress" class="form-control form-control-sm w-50 mt-2 w-50">
                                    <input placeholder="Enter your crypto name here" type="text" name="cryptoName" class="form-control form-control-sm w-50 mt-2 w-50">
                                    <button class="btn btn-sm btn-danger mt-2">Complete Withdrawal</button>
                                    <a class="btn btn-sm btn-warning mt-2" href="./withdrawal">Cancel</a>
                                </form>
                            <?php } else { ?>
                                <a class="btn btn-sm btn-danger" href="?start-withdraw"><i class="fa-solid fa-money-bill-transfer"></i> Start withdrawal</a>
                            <?php }
                            ?>
                        </div>
                        <div id="cover-spin"></div>
                    </div>
                </div>
            </div>
            <div id="cover-spin"></div>
            <?php
            require_once "./inc/footer-data.php";
            ?>
        </div>
    <?php } ?>


    <div id="cover-spin"></div>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
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