<?php
include("../include/conn.php");
include("../include/function.php");
header('Content-Type: application/json');

$id = $_POST['id'];
$status = $_POST['status'] == 'true' ? 'true' : 'false';

$query = "UPDATE `admin` SET `status` = '$status' WHERE `id` = '$id'";

if ($conn->query($query) === TRUE) {
    echo json_encode(['message' => 'Status updated successfully.']);
} else {
    echo json_encode(['message' => 'Failed to update status.']);
}
?>
