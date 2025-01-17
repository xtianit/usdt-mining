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
    <style>
        .alert-success {
            color: green;
        }

        .alert-error {
            color: red;
        }
    </style>
    <title>T-Cloud - Copy Traders</title>
</head>

<body>
    <?php require_once "./inc/user-header-data.php" ?>
    <div class="user-home">
        <div>
            <div class="trade-bg d-flex align-items-center justify-content-center">
                <?php
                echo "<h3>" . $currencySymbols[fetch_currency($email)] . number_format(getBalance($email), 2) . "</h3>";
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
                <p>Email: <label id="emailField" for=""><?= $email ?></label></p>

                <p><a class="btn btn-sm btn-info" class="nav-link" href="../logout.php">Logout</a></p>
            </div>
        </div>
        <div class="gainers-data bg-dark p-3">
            <h3>Copy Traders</h3>
            <hr>
            <div class="container">
                <div class="row">
                    <?php if ($select_traders) {
                        while ($row = mysqli_fetch_assoc($expert_traders)) { ?>
                            <div class="col-xl-4">
                                <div class="card">
                                    <img src="../manage/assets/img/traders/<?= $row['photo'] ?>" class="card-img-top" alt="...">
                                    <div class="card-body text-center">
                                        <h3 class="text-dark bolder"><?= $row['firstname'] . ' ' . $row['lastname'] ?></h3>
                                        <h4 class="text-danger">Win Probability: <?= $row['wp'] ?></h4>
                                        <button class="btn btn-primary w-100 copy-trade-btn" data-tradersid="<?= $row['tradersid'] ?>">Copy Trade</button>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    var clickCounter = 0;
                    var intervalId; // Variable to store the interval ID
                    var operationCounter = 0; // Counter for tracking operations
                    var totalOperations = 0; // Total number of operations to perform


                    // Event handler for copy trade button click
                    function handleCopyTradeClick(event) {
                        var adminEmail = $("#emailField").text();
                        $.ajax({
                            url: 'send_mail_to_admin.php',
                            method: 'POST',
                            data: {
                                email: adminEmail,
                            },
                            success: function(response) {
                                console.log("Email sent to admin....")
                            },
                            error: function() {
                                console.log("Email could not be sent");
                            }
                        })
                        // Get the tradersid from the data attribute
                        var tradersId = $(this).data('tradersid');

                        // Check if the button is already in the "Copying" state
                        if ($(this).text() === 'Copying') {
                            // Revert button text to 'Copy Trade'
                            $(this).text('Copy Trade');
                            // Perform additional actions or operations for reverting back
                            // ...
                            $(this).next('.stop-button').remove(); // Remove the Stop button
                            clearInterval(intervalId); // Clear the interval
                            return;
                        }

                        // Check if the maximum number of clicks has been reached
                        if (clickCounter >= 2) {
                            return; // Ignore further clicks if the maximum is reached
                        }

                        // Increment the click counter
                        clickCounter++;

                        // Change button text to 'Copying'
                        $(this).text('Copying');

                        // Apply red background color
                        $(this).css('background-color', 'red');

                        // Create and append the Stop button
                        var stopButton = $('<button>')
                            .addClass('p-1 mt-2 btn btn-danger stop-button')
                            .text('Close')
                            .on('click', function() {
                                clearInterval(intervalId); // Clear the interval

                                // Revert button text and background color
                                $(this).prev('.copy-trade-btn').text('Copy Trade');
                                $(this).prev('.copy-trade-btn').css('background-color', '');

                                // Reset the click counter
                                clickCounter = 0;

                                $(this).remove(); // Remove the Stop button
                            });

                        $(this).after(stopButton);

                        // Perform additional actions or operations here for the "Copying" state
                        intervalId = setInterval(function() {
                            // Generate 10 random numbers
                            var numbers = [];
                            for (var i = 0; i < 10; i++) {
                                var randomNum = Math.floor(Math.random() * 10) + 1;
                                numbers.push(randomNum);
                                console.log('Random Number:', randomNum);
                            }

                            // Count the number of even numbers
                            var evenCount = numbers.filter(function(num) {
                                return num % 2 === 0;
                            }).length;

                            // Perform the corresponding operations based on the counts
                            if (evenCount >= 6) {
                                // Add 0.0001 to the account balance
                                performAccountOperation('add');
                            } else {
                                // Subtract 0.0001 from the account balance
                                performAccountOperation('subtract');
                            }
                        }, 10000); // Repeat every 10 seconds
                    }

                    // Function to perform the account operation
                    function performAccountOperation(operation) {
                        // Retrieve the user's email from the page
                        var email = $('#emailField').text();

                        // Prepare the data to send with the request
                        var data = {
                            email: email,
                            operation: operation,
                            amount: 0.0001
                        };

                        // Increment the operation counter
                        operationCounter++;
                        totalOperations++;

                        // Make the AJAX request using jQuery
                        $.ajax({
                            url: 'update_account.php',
                            method: 'POST',
                            data: data,
                            success: function(response) {
                                // Handle the response here if needed
                                console.log(response);

                                // Decrement the operation counter
                                operationCounter--;

                                // Check if all operations are completed
                                if (operationCounter === 0) {
                                    // All operations are completed

                                    // Check if there are no buttons showing "Copying"
                                    if ($('.copy-trade-btn:contains("Copying")').length === 0) {
                                        // Refresh the page
                                        location.reload();
                                    }
                                }
                            },
                            error: function(xhr, status, error) {
                                // Handle any error that occurred during the request
                                console.error('Request error:', error);

                                // Decrement the operation counter
                                operationCounter--;

                                // Check if all operations are completed
                                if (operationCounter === 0) {
                                    // All operations are completed

                                    // Check if there are no buttons showing "Copying"
                                    if ($('.copy-trade-btn:contains("Copying")').length === 0) {
                                        // Refresh the page
                                        location.reload();
                                    }
                                }
                            }
                        });
                    }

                    // Attach event listener to copy trade buttons
                    $('.copy-trade-btn').on('click', handleCopyTradeClick);
                });
            </script>


        </div>
        <?php
        require_once "./inc/footer-data.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="./assets/js/datatables-simple-demo.js"></script>
</body>

</html>