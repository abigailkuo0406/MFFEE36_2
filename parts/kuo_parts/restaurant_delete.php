<?php

require "./parts/kuo_parts/restaurant_connect-db.php";

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;

$sql = "DELETE FROM restaurant_list WHERE rest_id = {$sid}";

$pdo->query($sql);
