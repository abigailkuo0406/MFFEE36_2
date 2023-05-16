<?php
// require './parts/admin-required.php';
require './parts/john_parts/back/part/connect-db.php';

$member_id = isset($_GET['member_id']) ? intval($_GET['member_id']) : 0;

$sql = " DELETE FROM `member` WHERE member_id={$member_id}";

$pdo->query($sql);

$comeFrom = 'list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}


header('Location: ' . $comeFrom);
