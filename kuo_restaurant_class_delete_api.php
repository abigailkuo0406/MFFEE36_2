<?php

require './parts/kuo_parts/restaurant_connect-db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM restaurant_class WHERE rest_class_id = {$sid}";

$pdo->query($sql);

$comeFrom = 'restaurant_class_list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location:' . $comeFrom);
