<?php
include("../include/conn.php"); // Adjust the path if necessary to match your folder structure

if (isset($_POST['id']) && isset($_POST['password'])) {
    $id = $_POST['id'];
    $newPassword = $_POST['password'];

    // Hash the new password using SHA1 before storing it in the database
    $hashedPassword = sha1($newPassword);

    // Update the password in the admin table
    $query = "UPDATE admin SET password = '$hashedPassword' WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        echo json_encode(['status' => 'success', 'message' => 'Password updated successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update password.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
}
?>
