<div class="row">
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '20') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">

            <h3><?= '$' . number_format(20) ?></h3>
            <p>Daily Return:4%</p>

            <?php if (fetch_my_plan($email) === '20') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan20" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '50') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(50) ?></h3>
            <p>Daily Return:5%</p>
            <?php if (fetch_my_plan($email) === '50') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan50" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '100') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(100) ?></h3>
            <p>Daily Return:6% - limited slots</p>
            <?php if (fetch_my_plan($email) === '100') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan100" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '300') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(300) ?></h3>
            <p>Daily Return:7% - limited slots</p>
            <?php if (fetch_my_plan($email) === '300') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan300" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '500') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(500) ?></h3>
            <p>Daily Return:8.5%</p>
            <?php if (fetch_my_plan($email) === '500') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan500" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '1000') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(1000) ?></h3>
            <p>Daily Return:9.5%</p>
            <?php if (fetch_my_plan($email) === '1000') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan1000" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '3000') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(3000) ?></h3>
            <p>Daily Return:10%</p>
            <?php if (fetch_my_plan($email) === '3000') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan3000" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '5000') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(5000) ?></h3>
            <p>Daily Return:11%</p>
            <?php if (fetch_my_plan($email) === '5000') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan5000" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>

    <div class="col-xl-3 <?php if (fetch_my_plan($email) === '10000') {
                                echo 'disable-div';
                            }
                            ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            </h3>
            <h3><?= '$' . number_format(10000) ?></h3>
            <p>Daily Return:12%</p>
            <?php if (fetch_my_plan($email) === '10000') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan10000" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-xl-3 <?php (fetch_my_plan($email) === '30000') ? 'disable-div' : '' ?>">
        <div class="text-center rounded bg-secondary p-2 mb-3">
            <h3><?= '$' . number_format(30000) ?></h3>
            <p>Daily Return:13%</p>
            <?php if (fetch_my_plan($email) === '30000') { ?>
                <label class="btn btn-sm  btn-danger">
                    Selected <i class="fa-solid fa-check"></i>
                </label>
            <?php } else { ?>
                <a href="?plan30000" class="btn btn-sm  btn-success">
                    Select Plan
                </a>
            <?php } ?>
        </div>
    </div>
</div>