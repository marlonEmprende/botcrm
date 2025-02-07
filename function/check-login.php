<?php
session_start();
include("../include/conn.php");
include("../include/function.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = sha1($password);
  
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password' AND status = 'true'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id']; // Store the admin's row ID in the session
        $_SESSION['user_type'] = $row['user_type'];

        // Successful login
        echo 'success';
        exit();
    } else {
        // Failed login
        echo 'failure';
        exit();
    }
}
?>

