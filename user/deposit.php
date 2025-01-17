<?php
require_once "./inc/user-data.php";
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
    <style>
        .color {
            color: red;
        }
    </style>
    <title>T-Cloud</title>
</head>

<body>
    <?php
    require_once "./inc/user-header-data.php"
    ?>
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
        <div class="user-home">
            <div>
                <div class="trade-bg d-flex align-items-center justify-content-center">
                    <?php
                    echo "<h3>" . number_format(getBalance($email), 2) . "</h3>";
                    ?>
                </div>
                <div class="mt-3 d-flex align-items-center justify-content-between">
                    <a class="btn btn-sm btn-dark" href="./deposit">Deposit</a>
                    <a href="./copy-trade" class="btn btn-sm btn-dark">Copy Traders</a>
                    <a class="btn btn-sm btn-dark" href="./referral">Refer & Earn</a>
                </div>
                <div class="card p-3 mt-3 bg-dark text-light">
                    <h5>Account Details</h5>
                    <hr>
                    <p>Email: <label for=""><?= $email ?></label></p>

                    <p><a class="btn btn-sm btn-info" class="nav-link" href="../logout.php">Logout</a></p>

                </div>
            </div>
            <div class="gainers-data">
                <div class="container shadow-lg">
                    <div class="row">
                        <div class="col-xl-6 bg-dark p-5" style="min-height: 75vh;">
                            <h3 class="text-center">Make Deposit</h3>
                            <p>Enter details of transaction in the form below after successful tranfer.</p>
                            <form id="deposit-form">
                                <input type="hidden" name="email" value="<?= $email ?>">
                                <input class="form-control mt-3 text-light bg-transparent form-control-lsm w-100" type="text" name="amount" placeholder="Amount Deposited">
                                <input class="form-control mt-3 text-light bg-transparent form-control-lsm w-100" type="text" name="reference" placeholder="Enter transfer reference code">
                                <input class="form-control mt-3 text-light bg-transparent form-control-lsm w-100" type="text" name="crypto" placeholder="Enter crypto name">
                                <div class="container-fluid p-0 mt-3">
                                    <div class="row">
                                        <div class="col-xl-6 mt-3">
                                            <button class="btn btn-sm btn-info w-100">Deposit</button>
                                        </div>
                                        <div class="col-xl-6 mt-3">
                                            <a class="btn btn-sm btn-light w-100" href="./users">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-2">Note: Transfer reference code is generated after a successful deposit to any of the addresses below for validation.</p>
                            </form>
                        </div>

                        <div class="col-xl-6 bg-dark">
                            <div class="container p-5">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h3>Deposit Addresses</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <ul>
                                        <li style="list-style: none;">BTC</li>
                                        <li class="list-group-item list-group-item-dark">
                                            <input type="text" class="form-control bg-transparent border-0 text-dark form-control-sm" id="btc" value="bc1qk2tq7243clsqy2wgrppe3tgwp4rtf7y8wk30lt" readonly>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <ul>
                                        <li style="list-style: none;">ETHERIUM</li>
                                        <li class="list-group-item list-group-item-dark">
                                            <input type="text" class="form-control bg-transparent text-dark border-0  form-control-sm w-100" id="eth" value="0x6F9839E989AbE13816aFE734EB2D5A579081A7F5" readonly>
                                        </li>
                                    </ul>
                                </div>


                                <div class="row">
                                    <ul>
                                        <li style="list-style: none;">USDT</li>
                                        <li class="list-group-item list-group-item-dark">
                                            <input type="text" class="bg-transparent text-dark form-control form-control-sm border-0" id="usdt" value="0x6F9839E989AbE13816aFE734EB2D5A579081A7F5" readonly>
                                        </li>
                                    </ul>
                                </div>

                                <div class="row">
                                    <ul>
                                        <li style="list-style: none;">BnB</li>
                                        <li class="list-group-item list-group-item-dark">
                                            <input type="text" class="bg-transparent text-dark form-control form-control-sm border-0" id="bnb" value="0x6F9839E989AbE13816aFE734EB2D5A579081A7F5" readonly>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <ul>
                                        <li style="list-style: none;">DOGE</li>
                                        <li class="list-group-item list-group-item-dark">
                                            <input type="text" class="bg-transparent text-dark form-control form-control-sm border-0" id="doge" value="DL4YY48FG5nuYTtRbSU7W3vs6qSpTjR419" readonly>
                                        </li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <p>Click to copy any of the wallet addresses above and copy to your payment wallet.</p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                require_once "./inc/footer-data.php";
                ?>
            <?php } ?>

            </div>
            <div id="cover-spin"></div>



            <script>
                var copyButton = document.getElementById("btc");
                copyButton.addEventListener("click", function() {
                    var referralLinkInput = document.getElementById("btc");
                    referralLinkInput.select();
                    document.execCommand("copy");
                    alert("BTC address copied to clipboard!");
                });
            </script>
            <script>
                var copyButton = document.getElementById("eth");
                copyButton.addEventListener("click", function() {
                    var referralLinkInput = document.getElementById("eth");
                    referralLinkInput.select();
                    document.execCommand("copy");
                    alert("ETH address copied to clipboard!");
                });
            </script>
            <script>
                var copyButton = document.getElementById("usdt");
                copyButton.addEventListener("click", function() {
                    var referralLinkInput = document.getElementById("usdt");
                    referralLinkInput.select();
                    document.execCommand("copy");
                    alert("USDT adress copied to clipboard!");
                });
            </script>
            <script>
                var copyButton = document.getElementById("bnb");
                copyButton.addEventListener("click", function() {
                    var referralLinkInput = document.getElementById("bnb");
                    referralLinkInput.select();
                    document.execCommand("copy");
                    alert("BnB address copied to clipboard!");
                });
            </script>
            <script>
                var copyButton = document.getElementById("ltc");
                copyButton.addEventListener("click", function() {
                    var referralLinkInput = document.getElementById("ltc");
                    referralLinkInput.select();
                    document.execCommand("copy");
                    alert("Litcoin address copied to clipboard!");
                });
            </script>
            <script>
                var copyButton = document.getElementById("doge");
                copyButton.addEventListener("click", function() {
                    var referralLinkInput = document.getElementById("doge");
                    referralLinkInput.select();
                    document.execCommand("copy");
                    alert("Doge copied to clipboard!");
                });
            </script>
            <script src="../assets/js/jquery-3.7.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
            <script src="../assets/js/process.js"></script>
</body>

</html>