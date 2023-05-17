<?php

require './parts/kuo_parts/restaurant_connect-db.php';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM reserve WHERE reserve_id = {$sid}";

$pdo->query($sql);

$comeFrom = 'reserve_list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location:' . $comeFrom);
