<div>
    <div class="trade-bg d-flex align-items-center justify-content-between p-3">
        <a class="nav-link text-success" href="."><i class="fa-solid fa-coins fa-2x"></i></a>
        <?php
        echo "<h4>" . number_format(getBalance($email), 2) . " USDT</h4>";
        ?>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 bg-dark p-3 mt-3">
                <div id="lds-hourglass"></div>
                <strong>Investment Statistics</strong>

                <hr>
                <?= time() ?>
                <?= $lastExecutionTime ?>
                <?= time() - $lastExecutionTime ?>
                <?php echo 2 * 60; ?>
                <?php echo "<p class='bg-success p-2 rounded'>Profit: " . number_format(getBalance($email), 2) . " USDT</p>"; ?>
                <?php echo "<p class='bg-success p-2 rounded'>Bonus account: " . number_format(fetchReferralBonus($refCode), 2) . " USDT</p>"; ?>
                <p class="bg-success p-2 rounded">Current Plan: <?= number_format(fetch_plan($id), 2) . ' USDT' ?></p>
                <p class="bg-success p-2 rounded">Referrals: <?= fetchReferralCount($refCode) ?></p>
                <div class="bg-light rounded p-2 d-flex align-items-center justify-content-between">
                    <div class="text-dark font-bolder">Miner running</div>
                    <div class="custom-loader"></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <p class="p-3 bg-dark">Transaction Code: <?= getAccount($email) ?></p>
    </div>
    <div class="bg-dark p-3">
        <div class="container p-0">
            <div class="row">
                <div class="col-xl-6">
                    <a class="btn btn-sm  btn-secondary mt-2 w-100" href="./market">Buy Plan</a>
                </div>
                <div class="col-xl-6">
                    <a class="btn btn-sm  btn-success mt-2 w-100" href="./referral">Refer & Earn</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card p-3 mt-3 bg-dark text-light">
        <h5>Account Details</h5>
        <hr>
        <p>Email: <label id="getEmail" for=""><?= $email ?></label></p>
        <div class="container p-0">
            <div class="row">
                <div class="col-xl-6">
                    <a class="btn btn-sm  btn-secondary w-100 mb-2" href="./withdrawal"><i class="fa-solid fa-wallet"></i> Wallet</a>
                </div>
                <div class="col-xl-6">
                    <p><a class="btn btn-sm  btn-success w-100" class="nav-link" href="../logout.php">Logout</a></p>
                </div>
            </div>
        </div>
    </div>
</div>