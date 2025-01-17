<?php
require_once "../config/config.php";
$response = array(
    'success' => false,
    'message' => ''
);
// Retrieve the data from the POST request
$data = json_decode(file_get_contents("php://input"), true);

$order = $data['order'];

$referenceId = $order['referenceId'];
$userId = $order['userid'];
$symbol = $order['symbol'];
$amount = $order['amount'];
$basePrice = $order['basePrice'];
$pairRate = $order['pairRate'];
$type = $order['type'];
$timeLimit = $order['timeLimit'];
$leverage = $order['leverage'];
$result = $order['result'];
$expiryTime = $order['expiryTime'] / 1000;
$formattedDatetime = date("Y-m-d H:i:s", strtotime("@$expiryTime"));



//get the time of order
$timestamp = time();
$utcDateTime = gmdate('Y-m-d H:i:s', $timestamp);


$sql = "INSERT INTO `orders`
(`reference_id`, `user_id`, `symbol`, `amount`, `base_price`, `pair_rate`, `type`, `time_limit`, `leverage`, `result`, `expiry_time`, `order_date`)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, 'sssdddsiidss', $referenceId, $userId, $symbol, $amount, $basePrice, $pairRate, $type, $timeLimit, $leverage, $result, $formattedDatetime, $utcDateTime);
    mysqli_stmt_execute($stmt);
    if (mysqli_affected_rows($conn) > 0) {
        $response['success'] = true;
        $response['message'] = 'saved and closed';
    } else {
        $response['message'] = 'Could not be saved';
    }
} else {
    $response['message'] = 'Data was not saved';
    var_dump($conn);
}

echo json_encode($response);
