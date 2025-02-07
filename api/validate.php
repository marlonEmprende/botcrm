<?php
// validatedevice.php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header('Content-Type: application/json');

include("../include/conn.php");
include("../include/function.php");

$data = json_decode(file_get_contents("php://input"), true);

// Log received parameters to console
/*echo "Received Parameters:\n";
foreach ($data as $key => $value) {
    echo "$key: $value\n";
}*/

// Log received parameters to a file
$logFile = 'params.txt';
$logMessage = "Received Parameters:\n";
foreach ($data as $key => $value) {
    $logMessage .= "$key: $value\n";
}
file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);

// Get query parameters
$sub_key = $data['sub_key'] ?? null;
$unique_id = $data['unique_id'] ?? null;
$mo_no = $data['mo_no'] ?? null;
$b_version = $data['b_version'] ?? null;
$r_id = $data['r_id'] ?? null;

if (empty($sub_key)) {
    $response = [
        'status' => 400,
        'message' => 'INVALID_SUBSCRIPTION_KEY_OR_MOBILE_NUMBER1'.$sub_key,
        'code' => 41,
    ];
    echo json_encode($response);
    exit;
}

// Sanitize the input to prevent SQL injections
$sub_key = mysqli_real_escape_string($conn, $sub_key);
$mo_no = mysqli_real_escape_string($conn, $mo_no);
$unique_id = mysqli_real_escape_string($conn, $unique_id);

$query = "SELECT * FROM `users` WHERE `whatsapp_number` = '$mo_no' AND `license_key` = '$sub_key' AND `plan` = 'true'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $row['end_date']);
    $formattedDate = $dateTime->format('Y-m-d\TH:i:s') . ".000Z";

    $date1 = strtotime($row['end_date']);
    $date2 = strtotime($row['act_date']);
    $date2=date("Y-m-d H:i:s");
    $date2=strtotime($date2);
    $diffInSeconds = $date1 - $date2;

    // Calculate the difference in days
    $daysRemaining = floor($diffInSeconds / (60 * 60 * 24));
    $pc_id= $row['pc_id'];
    $whatsapp_number= $row['whatsapp_number'];
    
    $q = mysqli_query($conn, "UPDATE `users` SET `pc_id`='$unique_id' WHERE `license_key` = '$sub_key'");


    $response = [
    "status" => 200,
    "message" => "OK",
    "dData" => [
        "userDeviceData" => [
            "sub_key" => "$sub_key",
            "success" => true,
            "validate" => [
                "is_pro" => true,
                "end_date" => "$formattedDate",
                "sk_licence_key" => "$sub_key",
                "day_remaining" => $daysRemaining,
                "life_time" => false
            ],
            "is_subscription" => true,
            "plan_type" => "Premium",
            "sub_email" => "example@gmail.com",
            "skey" => "$sub_key",
            "device_data" => [
                "skd_id" => 26444,
                "skd_fk_sk_id" => 6433,
                "skd_device_id" => "$pc_id",
                "skd_wa_no" => "$whatsapp_number",
                "skd_config" => null,
                "skd_archive" => false,
                "skd_created_at" => "2024-04-07T09:50:14.619157+00:00",
                "skd_modified_at" => "2024-04-07T09:50:14.619157+00:00",
                "skd_device_name" => "WA-605",
                "skd_removed_at" => "$formattedDate",
                "skd_removed_manual" => false,
                "skd_removed_manual_at" => null,
                "skd_build_version" => "1.0.6"
            ]
        ],
        "userkeyuniquedata" => [
            "licence_key" => "$sub_key",
            "uniqueId" => "$pc_id",
            "version" => "1.0.6"
        ],
        "userPurchaseStatus" => "PREMIUM"
    ]
];
} else {
    $response = [
        'status' => 400,
        'message' => 'INVALID_SUBSCRIPTION_KEY_OR_MOBILE_NUMBER',
        'code' => 41,
    ];
}

echo json_encode($response);
?>
