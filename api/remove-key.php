<?php
// removekey.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, x-requested-with");
header('Content-Type: application/json');

include("../include/conn.php");
include("../include/function.php");

$sub_key = $_GET['sub_key'];
$plan_name = $_GET['plan_name'];
$mo_no = $_GET['mo_no'];
$b_version = $_GET['b_version'];



    $response = [
        'status' => '200',
        'message' => 'OK',
        'data' => 'Subscription key removed successfully.'
    ];


echo json_encode($response);
