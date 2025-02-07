<?php
include("../include/conn.php");
include("../include/function.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $wnumber = $_POST['wnumber'];
    $validity = $_POST['validity'];
    $cname = $_POST['cname'];
    $admin_id= $_SESSION['id'];

    // Check for empty or null values
    if (empty($wnumber) || empty($validity) || empty($cname)) {
        $response['status'] = false;
        $response['message'] = "Please fill in all required fields.";
    } else {
        if (check_number($wnumber) == true) {
            $response['status'] = false;
            $response['message'] = "WhatsApp Number Already Exists.";
        } else {
            $today = date("Y-m-d H:i:s"); // Use a more standard date format
            $licenseKey = generate_license();
            $futureDate = date("Y-m-d H:i:s", strtotime("+$validity days"));

            $query = "INSERT INTO `users` (`user_id`,`customer_name`,`whatsapp_number`, `license_key`, `act_date`, `end_date`, `life_time`, `plan_type`) VALUES ('$admin_id','$cname','$wnumber', '$licenseKey', '$today', '$futureDate', 'false', 'Premium')";

            if ($conn->query($query) === TRUE) {
                $response['status'] = true;
                $response['message'] = "License key generated: $licenseKey";
            } else {
                $response['status'] = false;
                $response['message'] = "Failed to insert data: " . $conn->error;
            }
        }
    }
} else {
    $response['status'] = false;
    $response['message'] = "Invalid request method.";
}

// Set the content type to JSON
header('Content-Type: application/json');

// Encode the response array as JSON and send it back to the client
echo json_encode($response);
?>