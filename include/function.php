<?php
include_once("conn.php");
session_start();

function get($param)
{
    global $koneksi;
    $d = isset($_GET[$param]) ? $_GET[$param] : null;
    $d = mysqli_real_escape_string($koneksi, $d);
    $d = filter_var($d, FILTER_SANITIZE_STRING);
    return $d;
}

function post($param)
{
    global $koneksi;
    $d = isset($_POST[$param]) ? $_POST[$param] : null;
    $d = mysqli_real_escape_string($koneksi, $d);
    $d = filter_var($d, FILTER_SANITIZE_STRING);
    return $d;
}
function cekSession()
{
    $login = isset($_SESSION['login']) ? $_SESSION['login'] : null;
    if ($_SESSION['login']) {
        return 1;
    } else {
        return 0;
    }
}
function redirect($target)
{
    echo '
    <script>
    window.location = "' . $target . '";
    </script>
    ';
    exit;
}
function generate_license($length = 16) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
        if ($i % 4 == 3 && $i < $length - 1) {
            $randomString .= '-';
        }
    }

    return $randomString;
}

function check_number($number) {
    global $conn; // Use your database connection variable

    // Sanitize the input (if needed)
    $number = mysqli_real_escape_string($conn, $number);

    // Construct the SQL query
    $query = "SELECT COUNT(*) FROM users WHERE whatsapp_number = '$number'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result === false) {
        // Handle query execution error
        return false;
    }

    // Fetch the count
    $count = mysqli_fetch_array($result)[0];

    // Check the count and return true if the number exists, otherwise return false
    return ($count > 0);
}