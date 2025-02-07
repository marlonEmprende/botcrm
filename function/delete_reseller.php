<?php
include("../include/conn.php");
include("../include/function.php");
header('Content-Type: application/json');


$id = $_POST['id'];

// Set deleted = 'yes' for the reseller
$reseller_update = mysqli_query($conn, "UPDATE `admin` SET `deleted` = 'yes' WHERE `id` = '$id'");

if ($reseller_update) {
    // Set the status of all associated users created by this reseller to 'false'
    $users_update = mysqli_query($conn, "UPDATE `users` SET `status` = 'false' WHERE `user_id` = '$id'");

    if ($users_update) {
        echo json_encode(['message' => 'Reseller marked as deleted and associated users deactivated']);
    } else {
        echo json_encode(['message' => 'Reseller marked as deleted, but user status update failed']);
    }
} else {
    echo json_encode(['message' => 'Failed to mark reseller as deleted']);
}
?>

