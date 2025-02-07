<?php
include("../include/conn.php");

// Set JSON response header
header('Content-Type: application/json');

$id = $_POST['id'];
$status = $_POST['status'];

// Update reseller's status in the admin table
$reseller_update = mysqli_query($conn, "UPDATE `admin` SET `status` = '$status' WHERE `id` = '$id'");

if ($reseller_update) {
    // Now update all licenses created by this reseller in the users table
    $users_update = mysqli_query($conn, "UPDATE `users` SET `status` = '$status' WHERE `user_id` = '$id'"); // Adjust field name as needed

    if ($users_update) {
        echo json_encode(['message' => 'Reseller and associated licenses updated successfully']);
    } else {
        echo json_encode(['message' => 'Reseller updated, but license update failed']);
    }
} else {
    echo json_encode(['message' => 'Failed to update reseller status']);
}
?>
