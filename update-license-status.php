<?php
include("include/conn.php");

if (isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'] === 'true' ? 'true' : 'false';

    $query = "UPDATE users SET status='$status' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
