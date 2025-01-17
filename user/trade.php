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
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/trade.css">
    <title>T-Cloud</title>
</head>

<body>
    <?php require_once "./inc/user-header-data.php" ?>
    <div class="user-home" style="margin-top:100px;">
        <?php require_once "./inc/user-home-side.php" ?>
        <div class="gainers-data bg-dark p-3">
            <h5>My Investment</h5>
            <hr>
            <table class="table text-light small" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Investment Plan</th>
                        <th>Accrual</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($fetched_investments) {
                        $sn = 1;
                        while ($row = mysqli_fetch_assoc($investments)) { ?>
                            <tr>
                                <td><?= $sn++ ?></td>
                                <td><?= $row['package'] ?></td>
                                <td><?= $row['accrual'] ?></td>
                                <td><?= $row['date'] ?></td>
                            </tr>

                    <?php }
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <?php
        require_once "./inc/footer-data.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/datatables-simple-demo.js"></script>
        <script src="../assets/js/investment.js"></script>
</body>

</html>