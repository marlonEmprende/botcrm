<?php
// getanouncement

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header('Content-Type: application/json');

include("../include/conn.php");
include("../include/function.php");

error_log("t anouncement");
$data = json_decode(file_get_contents("php://input"), true);
$data = $data['data'];

error_log("data--> " . print_r($data, true));


$mo_no = $data['mo_no'] ?? null;


if (empty($mo_no)) {
    $response = [
        'status' => 400,
        'message' => 'Missing Parameters'
    ];
    echo json_encode($response);
    exit;
}

$mo_no = mysqli_real_escape_string($conn, $mo_no);
$query = "SELECT * FROM users WHERE whatsapp_number = '$mo_no'";
$result = $conn->query($query);


// Perform the removal of the key from the database here (if required)
// Example SQL query to delete the key based on some condition:
// $query = "DELETE FROM your_table WHERE sub_key = '$sub_key' AND mo_no = '$mo_no'";
// $result = $conn->query($query);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $date1 = strtotime($row['end_date']);

  $response = [
    'data' => [
      'data' => null,
      'timestamp' => "$date1"
    ],
    'status' => '200',
    'message' => 'OK'
];

echo json_encode($response);

}