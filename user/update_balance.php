<?php
// Establish a database connection
require_once "../config/config.php";
$response = array(
    "success" => false,
    "newBalance" => 0
);
// Get the new balance from the request
$data = json_decode(file_get_contents("php://input"), true);
print_r($data);
$tradeResult = $data["result"];
$userid = $data['userid'];

// Update the account balance in the database

//$sql = mysqli_query($conn, "UPDATE account SET amount '$tradeResult' where userid='$userid'");
$sql = mysqli_query($conn, "UPDATE account SET amount = amount + IF('$tradeResult' < 0, '$tradeResult', -'$tradeResult') WHERE userid='$userid'");

if (mysqli_affected_rows($conn) > 0) {
    $fetch_bal = mysqli_query($conn, "select amount from account where userid='$userid'");
    if (mysqli_num_rows($fetch_bal) > 0) {
        $row = mysqli_fetch_assoc($fetch_bal);
        $newBalance = $row['amount'];
        $response['success'] = true;
        $response['newBalance'] = $newBalance;
    }
}
echo json_encode($response);
// Close the database connection
mysqli_close($conn);
