<?php
$db_host = 'localhost';
$db_name = 'friendtrip';
$db_user = 'root';
$db_pass = 'root';
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8"; // data source name
$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];
#


// 以下不一定要做
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $ex) {
    echo 'Connection failed: ' . $ex->getMessage();
}

// if(! isset($_SESSION)) {
//     session_start();
// }