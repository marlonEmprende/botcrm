<?php
// getanouncement

header("Access-Control-Allow-Origin: *"); // Replace '*' with a specific domain if needed, e.g., 'https://web.whatsapp.com'
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

include("../include/conn.php");
include("../include/function.php");

$data = json_decode(file_get_contents("php://input"), true);

// Get query parameters
$unique_id = $_GET['unique_id'] ?? null;
$mo_no = $_GET['phone'] ?? null;
$license = $_GET['license'] ?? null;
$r_id = $_GET['reseller_id'] ?? null;

error_log("unique id---> $unique_id");
error_log("mo_no id---> $mo_no");
error_log("license---> $license");
error_log("r_id ---> $r_id");

// Sanitize the input to prevent SQL injections
$sub_key = mysqli_real_escape_string($conn, $license);
$mo_no = mysqli_real_escape_string($conn, $mo_no);

$query = "SELECT * FROM `users` WHERE `whatsapp_number` = '$mo_no' AND `license_key` = '$sub_key'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    error_log("coming-->");
    $row = $result->fetch_assoc();
    $checkStatus = $row['status'];
    $checkDeleted_key = $row['deleted_key'];
    if ($checkStatus == "false" || strtolower($checkDeleted_key) == "yes") {
        $response = [
          "phone" => $mo_no,
          "unique_id" => "MTczMDE5MDQ0MzI1NS1nZHV3aDQ4ag==",
          "license" => ""
        ];
        echo json_encode($response);
        exit; // Exit to prevent further code execution if condition is met
    }
    
    $date1 = strtotime($row['end_date']);
    $formattedDate = date("Y-m-d\TH:i:s.000\Z", $date1);
    $date2=date("Y-m-d H:i:s");
    $date2=strtotime($date2);
    $diffInSeconds = $date1 - $date2;

    // Calculate the difference in days
    $daysRemaining = floor($diffInSeconds / (60 * 60 * 24));

    if ($daysRemaining > 0) {
        $response = [
            "message" => "OK",
            "status" => 200,
            "dData" => [
              "userDeviceData" => [
                  "sub_key" => $sub_key,
                  "success" => true,
                  "validate" => [
                      "is_pro" => true,
                      "end_date" => $formattedDate,
                      "sk_licence_key" => $sub_key,
                      "day_remaining" => 1,
                      "life_time" => false
                  ],
                  "is_subscription" => true,
                  "plan_type" => "Premium",
                  "sub_email" => "example@gmail.com",
                  "skey" => $sub_key,
                  "device_data" => [
                      "skd_id" => 26444,
                      "skd_fk_sk_id" => 6433,
                      "skd_device_id" => "MTczMDE5MDQ0MzI1NS1nZHV3aDQ4ag==",
                      "skd_wa_no" => $mo_no,
                      "skd_config" => null,
                      "skd_archive" => false,
                      "skd_created_at" => "2024-04-07T09:50:14.619157+00:00",
                      "skd_modified_at" => "2024-04-07T09:50:14.619157+00:00",
                      "skd_device_name" => "WA-605",
                      "skd_removed_at" => null,
                      "skd_removed_manual" => false,
                      "skd_removed_manual_at" => null,
                      "skd_build_version" => "1.0.6"
                  ]
              ],
              "userkeyuniquedata" => [
                  "licence_key" => $sub_key,
                  "uniqueId" => "MTczMDE5MDQ0MzI1NS1nZHV3aDQ4ag==",
                  "version" => "1.0.6"
              ],
              "userPurchaseStatus" => "PREMIUM"
            ]
        ];        
    } else {
        $response = [
          "phone" => $mo_no,
          "unique_id" => "MTczMDE5MDQ0MzI1NS1nZHV3aDQ4ag==",
          "license" => ""
        ];
        echo json_encode($response);
        exit; // Exit to prevent further code execution if condition is met        
    }
}

echo json_encode($response);
?>