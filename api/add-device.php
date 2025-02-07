<?php
// Ensure no output before headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: auth-key, client-service, uid, token, append, delete, entries, foreach, get, has, keys, set, values, Authorization, content-type, x-requested-with");
header('Content-Type: application/json');

// Other PHP code

include("../include/config.php");
include("../include/db.php");
include("../include/conn.php");
include("../include/function.php");

$data = json_decode(file_get_contents("php://input"), true);
//file_put_contents("params.txt",json_encode($data));
// Get query parameters
$sub_key = $data['sub_key'] ?? null;
$unique_id = $data['unique_id'] ?? null;
$mo_no = $data['mo_no'] ?? null;
$r_id = $data['r_id'] ?? null;
$DB = new mysqliDB();
// Prepare SQL statement with placeholders to prevent SQL injection
/*$query = "SELECT * FROM `users` WHERE `license_key` = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $sub_key);
$stmt->execute();

// Bind result variables
$stmt->bind_result($id, $license_key, $end_date, $act_date, $pc_id, $whatsapp_number, $plan);*/

// Fetch the result
$data=$DB->fetch("SELECT * FROM `users` WHERE `license_key` ='$sub_key' limit 1");
//echo "<pre>";print_r($data);exit;
if (!empty($data)) {
   $row = $data[0];

    $currentDate = new DateTime();
    $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $row['end_date']); // Adjust format if needed
    $actDate = DateTime::createFromFormat('Y-m-d H:i:s', $row['act_date']); // Adjust format if needed
    $pc_id = $row['pc_id'];
    $email = $row['email'];
    $pc_name= 'WA-'.($row['id']+500);
    //$diff = $endDate->diff($actDate)->days;
    $date1 = strtotime($row['end_date']);
    $date2 = strtotime($row['act_date']);
    $date2=date("Y-m-d H:i:s");
    $modified = DateTime::createFromFormat('Y-m-d H:i:s', $date2);
    $date2=strtotime($date2);
    $diffInSeconds = $date1 - $date2;

    // Calculate the difference in days
    $diff = floor($diffInSeconds / (60 * 60 * 24));
    //echo $diff;exit;
    
    $whatsapp_number = $row['whatsapp_number'];

    if ($diff <= 0) {
        $q = $conn->query("UPDATE `users` SET `plan`='false' WHERE `license_key` = '$sub_key'");
        $response = [
            'status' => 400,
            'message' => 'License Expired'
        ];
    } elseif ($row['whatsapp_number'] != $mo_no) {
        $response = [
            'status' => 400,
            'message' => 'Invalid License Key'
        ];
    } elseif ($row['plan'] == 'false') {
        $response = [
            'status' => 400,
            'message' => 'License Expired'
        ];
    } else {
        $response = [
            'status' => 200,
            'message' => 'OK',
            'data' => 'License key is valid. Device added successfully.',
            'dData' => [
                'userDeviceData' => [
                    'sub_key' => $sub_key,
                    'success' => true,
                    'validate' => [
                        'is_pro' => true,
                        'end_date' => $endDate->format('Y-m-d H:i:s'), // Format the date as needed
                        'sk_licence_key' => $sub_key,
                        'day_remaining' => $diff,
                        'life_time' => false
                    ],
                    'is_subscription' => true,
                    'plan_type' => $row['plan_type'],
                    'sub_email' => $email,
                    'skey' => $sub_key,
                    'device_data' => [
                        'skd_id' => 26444,
                        'skd_fk_sk_id' => 6433,
                        'skd_device_id' => $pc_id,
                        'skd_wa_no' => $whatsapp_number,
                        'skd_config' => null,
                        'skd_archive' => false,
                        'skd_created_at' => $actDate->format('Y-m-d H:i:s'),
                        'skd_modified_at' => $modified->format('Y-m-d H:i:s'),
                        'skd_device_name' => $pc_name,
                        'skd_removed_at' => $endDate->format('Y-m-d H:i:s'),
                        'skd_removed_manual' => false,
                        'skd_removed_manual_at' => null,
                        'skd_build_version' => '1.0.6'
                    ]
                ],
                'userkeyuniquedata' => [
                    'licence_key' => $sub_key,
                    'uniqueId' => $pc_id,
                    'version' => '1.0.6'
                ],
                'userPurchaseStatus' => $row['plan_type']
            ]
        ];
    }
} else {
    $response = [
        'status' => 400,
        'message' => 'License Key Not Found'
    ];
}

// Close statement


echo json_encode($response);
?>
