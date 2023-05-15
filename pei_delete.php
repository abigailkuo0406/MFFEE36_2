<?php
require './parts/pei_parts/connect-db.php';

/* 沒拿到 get 就顯示錯誤 */
if (empty($_GET['id'])) {
    die('刪除失敗');
}
/* 設定 id 和指令 */

$id = $_GET['id'];
$sql = "DELETE FROM attractions WHERE id =$id";

if ($pdo->query($sql)) {
    echo "刪除成功~~~";
} else {
    echo "刪除失敗~~~";
}

$comeFrom = 'list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $comeFrom = $_SERVER['HTTP_REFERER'];
}

header('Location:' . $comeFrom);
