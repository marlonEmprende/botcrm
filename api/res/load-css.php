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

$cssFilePath = 'mx.css'; // Replace with the actual path to your CSS file

// Check if the file exists
if (file_exists($cssFilePath)) {
    // Read and echo the file content
    header('Content-Type: text/css');
    readfile($cssFilePath);
} else {
    // File not found error
    header('HTTP/1.1 404 Not Found');
    echo 'File not found.';
}
?>


?>
