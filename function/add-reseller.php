<?php
include("../include/conn.php");
include("../include/function.php");
header('Content-Type: application/json');

// Fetch POST data
$cname = $_POST['cname'];
$wnumber = $_POST['wnumber'];
$username = $_POST['username'];
$password = sha1($_POST['password']); // Encrypt password
$user_type = $_POST['user_type'];
$status = $_POST['status'];
$start_date = $_POST['start_date'];
$expired_date = $_POST['expired_date'];
$admin_id= $_SESSION['id'];
// Check if username already exists
$checkQuery = "SELECT * FROM `admin` WHERE `username` = '$username'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // Username already exists
    echo json_encode(['status' => false, 'message' => 'Username already exists.']);
} else {
    // Insert into database
    $query = "INSERT INTO `admin` (`username`, `name`, `contact_number`, `password`, `user_type`, `status`, `start_date`, `expired_date`,`admin_id`) VALUES ('$username', '$cname', '$wnumber', '$password', '$user_type', '$status', '$start_date', '$expired_date',$admin_id)";

    // Execute query and respond
    if ($conn->query($query) === TRUE) {
        echo json_encode(['status' => true, 'message' => 'Reseller added successfully.']);
    } else {
        echo json_encode(['status' => false, 'message' => 'Failed to add reseller.']);
    }
}
?>
