<?php
// Establish a database connection
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  $response = array(
    "success" => false,
    "error" => "Connection failed: " . $conn->connect_error
  );
  echo json_encode($response);
  exit;
}

// Fetch the account balance from the database
$sql = "SELECT balance FROM accounts LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $balance = $row["balance"];

  $response = array(
    "success" => true,
    "balance" => $balance
  );
  echo json_encode($response);
} else {
  $response = array(
    "success" => false,
    "error" => "Failed to fetch account balance."
  );
  echo json_encode($response);
}

// Close the database connection
$conn->close();
