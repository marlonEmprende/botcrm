<?php
// getanouncement

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header('Content-Type: application/json');

include("../include/conn.php");
include("../include/function.php");

$sub_key = $_GET['sub_key'];
$plan_name = $_GET['plan_name'];
$mo_no = $_GET['mo_no'];
$b_version = $_GET['b_version'];

if (empty($sub_key) || empty($plan_name) || empty($mo_no) || empty($b_version)) {
    $response = [
        'status' => 400,
        'message' => 'Missing Parameters'
    ];
    echo json_encode($response);
    exit;
}

// Perform the removal of the key from the database here (if required)
// Example SQL query to delete the key based on some condition:
// $query = "DELETE FROM `your_table` WHERE `sub_key` = '$sub_key' AND `mo_no` = '$mo_no'";
// $result = $conn->query($query);

$response = [
    'status' => '200',
    'message' => 'OK'
];

echo json_encode($response);
