<?php
$_GET['plan1000'] = 1000;
$plan = $_GET['plan1000'];
?>

<!--THE PARENT OF THIS element IS AN EMPTY CONTAINER-->
<div class="container">
    <div class="row">
        <div class="col-xl-4 bg-secondary p-4">

            <div class="d-flex align-items-center justify-content-between">
                <div id="qrcode"></div>
                <a class="btn btn-sm btn-outline-light m-2 d-flex align-item-center justy-content-bewteen flex-column" href="./market.php">
                    <i class="fa-solid fa-exchange"></i>
                    <small>Change plan</small>
                </a>
                <h3><?= '$' . $plan ?></h3>
            </div>
            <div>
                <p class="text-center bg-dark p-2">Amount to pay: <br> <?= '$' . number_format(1000, 2) ?> + 10 = <?= '$' . number_format(1010, 2) ?><br>Processing fee inclusive.</p>
                <div class="container p-0">
                    <div class="row">
                        <div class="row">
                            <div class="col-xl-8">
                                <label for=""><?= wallet('token') ?> Token</label>
                                <input class="form-control form-control-sm bg-dark text-light w-100 border-0" readonly type="text" id="myInput" value="<?= wallet('address') ?>">
                            </div>
                            <div class="col-xl-4">
                                <label for=""></label>
                                <button class="btn btn-success btn-sm bg-success w-100" onclick="copyText()">Copy</button>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .error {
                        color: yellow;
                    }
                </style>


                <form id="pl_1000_rrusdt_06">
                    <label for="">Enter amount paid</label>
                    <input type="hidden" name="return" value="0.095" id="">
                    <input type="hidden" id="package" name="package" value="<?= $plan ?>">
                    <input type="hidden" name="email" value="<?= $email ?>" id="">
                    <input type="number" id="amount" name="amount" class="form-control form-control-sm bg-dark border-0 mt-2 text-light" placeholder="E.g. $1010.00">
                    <label for="" class="d-block">Paste transaction id here</label>
                    <input type="text" name="reference" class="form-control form-control-sm bg-dark border-0 mt-2 text-light" placeholder="skdfklasdjabkhgsd">
                    <div class="container p-0 mt-2">
                        <div class="row">
                            <div class="col-xl-6">
                                <button class="btn btn-sm btn-dark w-100">Send Payment</button>
                            </div>
                            <div class="col-xl-6">
                                <a class="btn btn-sm btn-success w-100" disabled href="./market.php">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php require_once './inc/procedure.php' ?>
        <div id="cover-spin"></div>





    </div>
</div>
</div>

<script>
    function copyText() {
        /* Get the text input */
        var copyText = document.getElementById("myInput");

        /* Select the text in the input */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text to the clipboard */
        document.execCommand("copy");

        /* Alert the user */
        alert("Copied the text: " + copyText.value);
        event.preventDefault();
    }
</script>