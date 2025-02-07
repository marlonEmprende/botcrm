<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
include("../../include/conn.php");
include("../../include/function.php");
$id = $_GET['id'];
if (empty($id)) {
    $response = [
        'status' => 400,
        'message' => 'Missing Parameters'
    ];
    echo json_encode($response);
    exit;
}
$query = "SELECT `id` FROM `users` WHERE `whatsapp_number` = '$id' AND `status` = 'true'";
$result = $conn->query($query);

if (!$result) {
    $response = [
        'status' => '500',
        'message' => 'Database Error',
        'plan' => false
    ];
} 
else if ($result->num_rows > 0) {
$jsFilePath = 'mx.js'; 

header('Content-Type: application/javascript');
readfile($jsFilePath);
}
else
{
    $jsFilePath = 'false.js'; 

    header('Content-Type: application/javascript');
    readfile($jsFilePath);
}
?>
