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
    <script src="../assets/js/investment.js"></script>
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
            <div class="gainers-data">
                <div class="gainers-data bg-dark text-light p-3">
                    <?php
                    if (isset($_GET['change-password'])) { ?>

                        <form id="change-password">
                            <div class="container p-2">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <h3>Update Password</h3>
                                    </div>
                                    <div class="col-xl-4">
                                        <input type="hidden" name="email" value="<?= $email ?>">
                                        <input placeholder="Enter old password" class="form-control form-control-sm mt-3" type="password" name="oldPass" id="">
                                    </div>
                                    <div class="col-xl-4">
                                        <input placeholder="Enter new password" id="newPass" class="form-control form-control-sm mt-3" type="password" name="newPass">
                                    </div>
                                    <div class="col-xl-4">
                                        <input placeholder="Confirm new folder" class="form-control form-control-sm mt-3" type="password" name="confirmNewPass" id="">
                                    </div>

                                    <div class="col-xl-8">
                                        <div class="container p-0">
                                            <div class="row">
                                                <div class="col-xl-6"> <button class="btn btn-sm btn-primary mt-3 w-100">
                                                        Update Password
                                                    </button></div>
                                                <div class="col-xl-6"> <a class="btn btn-sm btn-warning w-100 mt-3" href=".">Cancel</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <p class="alert bg-danger p-2 mt-3">Note that you will be automatically logged out as soon as your password is changed.</p>
                                    </div>



                                </div>
                            </div>

                        </form>
                    <?php } else if (isset($_GET['passport'])) { ?>
                        <form id="uploadPhoto" enctype="multipart/form-data">
                            <div class="container p-0">
                                <div class="row">
                                    <div class="col-xl-4 shadow-lg text-light p-3">
                                        <h3 class="mb-3 text-light">ID Upload</h3>
                                        <input type="hidden" id="email" name="email" value="<?= $email ?>">
                                        <label for="">Customer's Photo</label>
                                        <input class="form-control form-control-sm bg-transparent text-light" type="file" name="file" id="file">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button id="uploadButton" class="btn btn-sm btn-danger mt-3"><i class="fa-solid fa-upload"></i> Upload</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </form>

                        <div id="cover-spin"></div>
                    <?php } else { ?>
                        <style>
                            /* Adjust the button's size and padding */
                            .small-button {
                                font-size: 10px;
                                padding: 4px 8px;
                                border-radius: 2px;
                                background-color: rgba(25, 135, 84);
                                color: #fff;
                                text-decoration: none;
                            }



                            .first {
                                margin-right: 20px !important;
                            }

                            .small-button:hover {
                                color: black;
                                transition: 0.5s ease-in-out;
                            }
                        </style>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>Profile</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div><a class="small-button first" href="?passport">Upload Photo ID</a></div>
                                <div><a class="small-button" href="?change-password">Change Password</a></div>
                            </div>

                        </div>

                        <hr>

                        <table class="table p-0 border-0 text-light small table-sm">
                            <thead>
                                <tr>
                                    <th colspan="2">Profile Details</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th>First name</td>
                                    <td><?= $profile['firstname'] ?></td>
                                </tr>
                                <tr>
                                    <th>Last name</td>
                                    <td><?= $profile['lastname'] ?></td>
                                </tr>
                                <tr>
                                    <th>Email Address</td>
                                    <td><?= $profile['email'] ?></td>
                                </tr>
                                <tr>
                                    <th>Country</td>
                                    <td><?= $profile['country'] ?></td>
                                </tr>
                                <tr>
                                    <th>Gender</td>
                                    <td><?= $profile['gender'] ?></td>
                                </tr>
                                <tr>
                                    <th>State</td>
                                    <td><?= $profile['state'] ?></td>
                                </tr>

                                <tr>
                                    <th>Phone</td>
                                    <td><?= $profile['phone'] ?></td>
                                </tr>
                                <tr>
                                    <th>Date Started</td>
                                    <td><?= $profile['date'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    <?php } ?>
                </div>
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