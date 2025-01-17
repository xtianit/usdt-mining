<?php
require_once "./../../vendor/autoload.php";
require_once './../../controllers/account/access.php';
require_once './../../config/config.php';
$response = array(
    'status' => 0,
    'message' => 'Unexpected error occured!'
);

// File upload folder 
$uploadDir = './../../user/uploads/';

// Allowed file types 
$allowTypes = array('pdf', 'jpg', 'png', 'jpeg');
$uploadStatus = 0;

// If form is submitted 
$email = $_POST['email'];

// Check whether submitted data is not empty 
if (!empty($email)) {

    // Upload file 
    $uploadedFile = '';

    if (!check_email($email)) {
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
                    $uploadStatus = 1;
                } else {
                    $uploadStatus = 0;
                    $response['message'] = 'Sorry, there was an error uploading your file.';
                }
            } else {
                $uploadStatus = 0;
                $response['message'] = 'Sorry, only ' . implode('/', $allowTypes) . ' files are allowed to upload.';
            }
        }
    } else {
        $response['message'] = "Passport uploaded previously";
    }


    if ($uploadStatus == 1) {
        // Insert form data in the database
        //cid 	pr_id 	pr_name 	price 	pr_desc 	picture 	subnitted_on 

        $sql = "INSERT INTO `photoid` (`userid`, `image`) VALUES (?,?)";
        if ($stmt = mysqli_prepare($conn,  $sql)) {
            mysqli_stmt_bind_param($stmt, 'ss', $email, $new_file_name);
            mysqli_stmt_execute($stmt);
            if (mysqli_affected_rows($conn) > 0) {
                $response['status'] = 1;
                $response['message'] = "Uploaded successfull";
            } else {
                $response['message'] = "Photo could not be uploaded";
            }
        }
    }
} else {
    $response['message'] = 'Please fill all the mandatory fields (name and email).';
}
// Return response 
echo json_encode($response);

function  check_email($email)
{
    global $conn;
    $sql = mysqli_query($conn, "select * from photoid where userid='$email'");
    if (mysqli_num_rows($sql) > 0) {
        return true;
    } else {
        return false;
    }
}
