<?php
///gettime
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header('Content-Type: application/json');

include("../include/conn.php");
include("../include/function.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response = [
        'status' => '400',
        'message' => 'Bad Request'
    ];
    echo json_encode($response);
    exit;
}

$number = $_POST['mo_no'];

if ($number == null || $number == "") {
    $response = [
        'status' => '400',
        'message' => 'Parameter Missing'
    ];
    echo json_encode($response);
    exit;
}

// Sanitize the input if needed, e.g., using mysqli_real_escape_string
$number = mysqli_real_escape_string($conn, $number);

$query = "SELECT `act_date`, `plan` FROM `users` WHERE `whatsapp_number` = '$number'";
$result = $conn->query($query);

if (!$result) {
    $response = [
        'status' => '500',
        'message' => 'Database Error',
        'plan' => false
    ];
} elseif ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    $act = $row['act_date'];
    $plan = $row['plan'];
    $response = [
        'status' => '200',
        'message' => 'OK',
        'data' => $act,
        'plan' => $plan
    ];
} else {
    $response = [
        'status' => '404',
        'message' => 'Record Not Found',
        'plan' => false
    ];
}

echo json_encode($response);
