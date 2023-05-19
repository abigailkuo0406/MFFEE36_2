<?php

$db_host = 'localhost';
$db_name = 'friendtrip'; //Mid-term FriendTrip
$db_user = 'root';
$db_pass = 'root';


$conn = new mysqli(
    $db_host,
    $db_user,
    $db_pass,
    $db_name,
);

if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}


$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}

// if (!isset($_SESSION)) {
//     session_start();
// }
