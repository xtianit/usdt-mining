<header class="fixed-top bg-dark d-flex align-items-center justify-content-between px-3">
    <a class="nav-link" href=".">
        <img src="../assets/images/site/tcloud-logo.png" width="20%" class="responsive-img" />

    </a>
    <div class="d-flex align-items-center justify-centent-center">
        <div style="width: 50px;">
            <?php if (is_ptoto_uploaded($email)) { ?>
                <img class="rounded-circle" src="./uploads/<?= fetch_photo_id($email) ?>" width="10px" height="10px" alt="yesID">
            <?php } else { ?>
                <img src="./uploads/photoid.png" width="100%" alt="noID">
            <?php } ?>
        </div>
        <div>
            <?php
            echo "<h5 class='text-success' id='accountBalance'>" . number_format(getBalance($email), 2) . " USDT</h5>";
            ?>
        </div>
    </div>
</header>