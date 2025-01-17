<?php require_once "./inc/user-data.php";

$userid = getUserid($email);


?>

<!DOCTYPE html>
<html>

<head>
    <title>T-Clouds - Place Order</title>
    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./assets/css/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/libs/font-awesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/trade.css">
    <title>T-Cloud</title>
</head>

<body>


    <?php
    require_once "./inc/user-header-data.php";
    ?>
    <div class="container mt-5 vh-100 p-0">
        <div class="row">
            <div class="col-xl-3 shadow-lg bg-dark p-3">
                <h5>Orders</h5>
                <hr>
                <div id="ordersContainer" class="small shadow-lg bg-dark">
                </div>
            </div>
            <div class="col-xl-6" style="height:70vh">
                <div style="width: 100%; height:100%" id="chartContainer"></div>
            </div>
            <div class="col-xl-3 bg-dark p-3">
                <input class="form-control form-control-sm" type="hidden" id="userid" value="<?= $userid ?>">
                <label for="symbol">Symbol:</label>
                <select class="form-select form-select-sm mb-3" id="symbol" onchange="changeSymbol()"></select>

                <label for="amount">Amount:</label>
                <input class="form-control form-control-sm mb-3" type="number" id="amount" min="0" onchange="checkAmount()" />

                <label for="time">Time (minutes):</label>
                <input class="form-control form-control-sm mb-3" type="number" id="time" min="1" />

                <label for="leverage">Leverage:</label>
                <input class="form-control form-control-sm" type="number" id="leverage" min="1" />

                <label id="basePrice"></label>
                <label id="pairRate"></label>
                <div class="container p-0">
                    <div class="row">
                        <div class="col-xl-6">
                            <button class="btn btn-sm btn-success w-100 mt-2" onclick="placeOrder('buy')" id="buyButton" disabled>Buy</button>
                        </div>
                        <div class="col-xl-6">
                            <button class="btn btn-sm btn-danger w-100 mt-2" onclick="placeOrder('sell')" id="sellButton" disabled>
                                Sell
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="fixed-bottom w-100 bottom-0">
        <div class="col-xl-12 d-flex align-items-center justify-content-around mt-5 p-3 bg-dark">
            <a class="btn btn-sm btn-dark" href="."><i class="fa-solid fa-home"></i><span class="pan-hide"><span>Home</span> </span></a>
            <a class="btn btn-sm btn-dark" href="./market"><i class="fa-solid fa-chart-simple"></i><span class="pan-hide"><span>Market</span></span></a>
            <a class="btn btn-sm btn-dark" href="./place-order"><i class="fa-solid fa-clock"></i><span class="pan-hide"><span>Place Order</span></span></a>
            <a class="btn btn-sm btn-dark" href="./trade"><i class="fa-solid fa-chart-simple"></i><span class="pan-hide"><span>Trades</span></span></a>
            <a class="btn btn-sm btn-dark" href="."><i class="fa-sharp fa-solid fa-user"></i><span class="pan-hide"><span>Profile</span></span></a>
        </div>
    </div>


    <script>
        let orders = [];
        let accountBalance = 10000;

        // Fetch symbols from Binance API
        function fetchSymbols() {
            fetch("https://api.binance.com/api/v3/exchangeInfo")
                .then((response) => response.json())
                .then((data) => {
                    const symbols = data.symbols.map(
                        (symbol) => symbol.symbol
                    );
                    const symbolDropdown =
                        document.getElementById("symbol");
                    symbols.forEach((symbol) => {
                        const option = document.createElement("option");
                        option.value = symbol;
                        option.text = symbol;
                        symbolDropdown.appendChild(option);
                    });

                    // Initialize the chart with the default symbol
                    const defaultSymbol = symbols[0];
                    initializeChart(defaultSymbol);
                })
                .catch((error) => console.log(error));
        }

        // Get base price and pair rate for a selected symbol
        function getPrice(symbol) {
            return fetch(
                    `https://api.binance.com/api/v3/ticker/price?symbol=${symbol}`
                )
                .then((response) => response.json())
                .then((data) => ({
                    basePrice: parseFloat(data.price),
                    pairRate: 1 / parseFloat(data.price),
                }))
                .catch((error) => console.log(error));
        }

        // Initialize the TradingView chart
        function initializeChart(symbol) {
            const widget = new TradingView.widget({
                autosize: true,
                symbol: symbol,
                interval: "1",
                timezone: "Etc/UTC",
                theme: "dark",
                style: "1",
                locale: "en",
                toolbar_bg: "#f1f3f6",
                enable_publishing: false,
                withdateranges: true,
                container_id: "chartContainer",
            });
        }

        // Change the symbol and update the chart
        function changeSymbol() {
            const symbol = document.getElementById("symbol").value;
            initializeChart(symbol);
        }

        // Calculate profit or loss based on randomization
        function calculateProfitLoss() {
            const numbers = Array.from({
                    length: 10
                },
                () => Math.floor(Math.random() * 10) + 1
            );
            const evenCount = numbers.filter((num) => num % 2 === 0).length;
            return evenCount === 5 ? 0.01 : -0.01;
        }

        // Generate a reference ID
        function generateReferenceId() {
            const timestamp = Date.now().toString();
            const random = Math.floor(Math.random() * 1000000)
                .toString()
                .padStart(6, "0");
            return timestamp + random;
        }

        // Check the entered amount against the account balance
        function checkAmount() {
            const amount = parseFloat(
                document.getElementById("amount").value
            );
            const buyButton = document.getElementById("buyButton");
            const sellButton = document.getElementById("sellButton");

            if (amount >= accountBalance) {
                buyButton.disabled = true;
                sellButton.disabled = true;
            } else {
                buyButton.disabled = false;
                sellButton.disabled = false;
            }
        }

        // Place an order
        async function placeOrder(type) {
            const symbol = document.getElementById("symbol").value;
            const amount = parseFloat(
                document.getElementById("amount").value
            );
            const userid = document.getElementById('userid').value;
            const timeLimit = parseInt(
                document.getElementById("time").value
            );
            const leverage = parseInt(
                document.getElementById("leverage").value
            );

            const priceData = await getPrice(symbol);

            const order = {
                referenceId: generateReferenceId(),
                userid: userid,
                symbol: symbol,
                amount: amount,
                basePrice: priceData.basePrice,
                pairRate: priceData.pairRate,
                type: type,
                timeLimit: timeLimit,
                leverage: leverage,
                result: null,
                expiryTime: Date.now() + timeLimit * 60000, // Convert minutes to milliseconds
            };

            orders.push(order);
            renderOrder(order);
            startOrderTimer(order);
        }

        // Render an order
        function renderOrder(order) {
            const ordersContainer =
                document.getElementById("ordersContainer");
            const orderElement = document.createElement("div");
            orderElement.id = `order-${order.referenceId}`;

            orderElement.innerHTML = `<table class="table table-stripped">
                <tr>
                    <td class='text-light'>${order.symbol}</td>
                    <td class='text-light'>${order.amount}</td>
                    <td class='text-light'>${order.type}</td>
                    <td class='text-light'><span id="timer-${order.referenceId}"></span></td>
                    <td class='text-light'><span id="result-${order.referenceId}"></span></td>
                </tr>
            </table>
            
        `;
            ordersContainer.appendChild(orderElement);
        }



        // Start the timer for an order
        function startOrderTimer(order) {
            const resultElement = document.getElementById(
                `result-${order.referenceId}`
            );
            const userid = document.getElementById('userid').value;
            const timerElement = document.getElementById(
                `timer-${order.referenceId}`
            );
            const countdown = setInterval(() => {
                const remainingTime = Math.max(
                    0,
                    Math.floor((order.expiryTime - Date.now()) / 1000)
                ); // Convert milliseconds to seconds
                if (remainingTime <= 0) {
                    clearInterval(countdown);
                    const profitLoss = calculateProfitLoss();
                    const result =
                        order.amount * order.leverage * profitLoss;
                    order.result = result;
                    resultElement.textContent = result.toFixed(2);
                    updateAccountBalance(result, userid);
                    saveOrderToDatabase(order);
                    removeExpiredOrderFromUI(order);
                    removeExpiredOrder(order);
                } else {
                    const minutes = Math.floor(remainingTime / 60);
                    const seconds = remainingTime % 60;
                    timerElement.textContent = `${minutes}m ${seconds}s`;
                }
            }, 1000);
        }

        // Remove an expired order from the browser
        function removeExpiredOrderFromUI(order) {
            const orderElement = document.getElementById(
                `order-${order.referenceId}`
            );
            if (orderElement) {
                orderElement.remove();
            }
        }

        // Remove an expired order from the list
        function removeExpiredOrder(order) {
            orders = orders.filter(
                (o) => o.referenceId !== order.referenceId
            );
            console.log(orders.length);
            if (orders.length <= 0) {
                refreshWindow();
            }
        }
        // regresh window
        function refreshWindow() {
            location.reload();
        }

        // Call the refreshWindow function to refresh the window

        // Save the order to the database using AJAX
        function saveOrderToDatabase(order) {
            const data = {
                order: order,
            };

            fetch("save_order.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((data) => {

                    setTimeout(function() {}, 2000);
                })
                .catch((error) => console.log(error));
        }

        // Update the account balance
        // Update the account balance
        function updateAccountBalance(result, userid) {
            const data = {
                userid: userid,
                result: result,
            };

            fetch("update_balance.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                })
                .then((response) => response.json())
                .then((data) => {
                    // Handle the response from the server
                    console.log(data);
                    if (data.success) {
                        accountBalance = data.newBalance;
                        const accountBalanceElement =
                            document.getElementById("accountBalance");
                        accountBalanceElement.textContent = `$${accountBalance.toFixed(
                                2
                            )}`;
                    } else {
                        console.log(data.error);
                    }
                })
                .catch((error) => console.log(error));
        }

        // Check for expired orders and remove them
        function checkExpiredOrders() {
            const currentTime = Date.now();
            const expiredOrders = [];

            orders.forEach((order) => {
                if (order.expiryTime <= currentTime) {
                    const resultElement = document.getElementById(
                        `result-${order.referenceId}`
                    );
                    resultElement.textContent = "Expired";
                    expiredOrders.push(order);
                }
            });

            expiredOrders.forEach((expiredOrder) => {
                removeExpiredOrderFromUI(expiredOrder);
                removeExpiredOrder(expiredOrder);
            });
        }

        fetchSymbols();
        setInterval(checkExpiredOrders, 1000); // Check for expired orders every second
    </script>
</body>

</html>