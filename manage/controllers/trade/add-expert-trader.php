<?php
// File upload folder 
$uploadDir = '../../assets/img/traders/';

// Allowed file types 
$allowTypes = array('pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg');

// Default response 
$response = array(
    'status' => 0,
    'message' => 'Form submission failed, please try again.'
);
// If form is submitted 

$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$symbol = $_POST['symbol'];
$wp = $_POST['wp'];



$uploadStatus = 1;


// Upload file 
$uploadedFile = '';
if (!empty($_FILES["file"]["name"])) {
    // File path config 
    $fileName = basename($_FILES["file"]["name"]);

    //Make file name unique
    $f = explode('.', $fileName);
    $unique_name = $f[0] . rand(000000, 999999);
    $new_file_name = $unique_name . '.' . $f[1];


    $targetFilePath = $uploadDir . $new_file_name;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


    // Allow certain file formats to upload 
    if (in_array($fileType, $allowTypes)) {
        // Upload file to the server 
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $uploadedFile = $new_file_name;
        } else {
            $uploadStatus = 0;
            $response['message'] = 'Sorry, there was an error uploading your file.';
        }
    } else {
        $uploadStatus = 0;
        $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
    }
}



if ($uploadStatus == 1) {
    // Include the database config file 
    include_once '../../config/config.php';
    $length = 16; // Length of the random bytes you want to generate
    // Generate random bytes
    $randomBytes = random_bytes($length);
    // Convert the random bytes to a hexadecimal string
    $tradersid = bin2hex($randomBytes);
    $sql = "INSERT INTO `traders` (`tradersid`, `lastname`, `firstname`, `photo`, `symbol`, `wp`) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'ssssss', $tradersid, $lastname, $firstname, $new_file_name, $symbol, $wp);
        if (mysqli_stmt_execute($stmt)) {
            $response['status'] = 1;
            $response['message'] = 'Expert Trader added successfully!';
        }
    }
}
// Return response 
echo json_encode($response);
