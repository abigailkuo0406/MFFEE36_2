<?php

require './parts/yun_parts/yun_connect-db.php';

$pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

$sql = " DELETE FROM Products WHERE product_id={$pid}";


$pdo->query($sql);

#在此頁面執行完刪除資料後，快速連回主頁面 list.php
$comeFrom = './yun_product.php';

// $_SERVER['HTTP_REFERER'] 為抓取從何來此 PHP 的 URL
// 如果用輸入網址或書籤頁前來則會為空，以下 if(!true)會無法進入，則直接轉跳回 list.php
// 如果是由某頁跳轉而來，例如 list.php?page=2，則將其值存入轉跳網址變數 $comeFrom 內
if(! empty($_SERVER['HTTP_REFERER'])){
    $comeFrom = $_SERVER['HTTP_REFERER'];
}
//

header('Location: '. $comeFrom);
