<?php
// validatedevice.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header('Content-Type: application/json');

include("../include/conn.php");
include("../include/function.php");

// Get query parameters
$sub_key = $_POST['sub_key'];
$unique_id = $_POST['unique_id'];
$mo_no = $_POST['mo_no'];
$b_version = $_POST['b_version'];
$r_id = $_POST['r_id'];

if (empty($sub_key) || empty($unique_id) || empty($mo_no) || empty($b_version) || empty($r_id)) {
    $response = [
        'status' => 400,
        'message' => 'Missing Parameters',
    ];
    echo json_encode($response);
    exit;
}

$query = "SELECT  `whatsapp_number`, `license_key`, `act_date`, `end_date`, `life_time`, `plan_type`, `email`, `skd_id`, `pc_id`, `status`, `plan` FROM `users` WHERE `whatsapp_number` = '$mo_no' AND `license_key` = '$sub_key'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $date1 = strtotime($row['end_date']);
    $date2 = strtotime($row['act_date']);
    $diffInSeconds = $date1 - $date2;
    
    // Calculate the difference in days
    $daysRemaining = floor($diffInSeconds / (60 * 60 * 24));
    if ($row['pc_id'] == NULL) {
        $q = mysqli_query($conn, "UPDATE `users` SET `pc_id`='$unique_id' WHERE `license_key` = '$sub_key'");
    }

    $response = [
        'status' => 200,
        'message' => 'OK',
        'data' => [
            'success' => true,
            'validate' => [
                'is_pro' => true,
                'end_date' => $row['end_date'],
                'day_remaining' => $daysRemaining, // You can calculate this based on the current date and end_date
                'life_time' => false,
            ],
            'plan_type' => $row['plan'],
            'sub_email' => null, // You can add the email here if needed
            'device_data' => [
                'skd_id' => '651ee3de4ced524d7f74bf0c', // Hardcoded for now
            ],
        ],
    ];
} else {
    $response = [
        'status' => 400,
        'message' => 'INVALID_SUBSCRIPTION_KEY_OR_MOBILE_NUMBER',
        'code' => 41,
    ];
}

echo json_encode($response);
