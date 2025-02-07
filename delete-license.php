<?php
include("include/conn.php");

// Check if the user is logged in
include("include/function.php");
$login = cekSession();
if ($login != 1) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized access']);
    exit();
}

// Check if the ID is provided
if (isset($_POST['id'])) {
    $licenseId = intval($_POST['id']);

    // Update the record instead of deleting it
    $query = "UPDATE `users` SET `deleted_key` = 'yes' WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $licenseId);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
    $conn->close();
}
?>