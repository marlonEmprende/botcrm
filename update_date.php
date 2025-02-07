<?php
include("include/conn.php");

// Check if connection is established
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id']) && isset($_POST['field']) && isset($_POST['value'])) {
    $id = mysqli_real_escape_string($conn, $_POST['id']); // Sanitize ID
    $field = $_POST['field'];
    $value = mysqli_real_escape_string($conn, $_POST['value']); // Sanitize Value

    // Validate field name to allow only specific columns
    if (in_array($field, ['act_date', 'end_date'])) {
        // Ensure value is in valid datetime format (convert if needed)
        $datetime = date('Y-m-d H:i:s', strtotime($value)); // Convert to 'YYYY-MM-DD HH:MM:SS' format
        
        // Prepare the SQL update query
        $query = "UPDATE users SET `$field` = '$datetime' WHERE id = '$id'";
        
        // Execute the query and check for success
        if (mysqli_query($conn, $query)) {
            echo 'success';
        } else {
            echo 'error: ' . mysqli_error($conn); // Output MySQL error for debugging
        }
    } else {
        echo 'invalid_field';
    }
} else {
    echo 'invalid_request';
}
?>
