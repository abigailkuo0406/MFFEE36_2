<?php

require './parts/yun_parts/yun_connect-db.php';

$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
$mid = isset($_GET['mid']) ? intval($_GET['mid']) : 0;
$tid = isset($_GET['tid']) ? intval($_GET['tid']) : 0;


$sql = " DELETE FROM Cart WHERE cart_id={$cid}";

$pdo->query($sql);


#刪除Cart_Sum的member id start

$member_id = $mid;
$subtract_value = $tid;

$update_sql = "UPDATE Sum_Cart SET sum_price = sum_price - :subtract_value WHERE member_id = :member_id";
$update_stmt = $pdo->prepare($update_sql);
$update_stmt->bindParam(':subtract_value', $subtract_value);
$update_stmt->bindParam(':member_id', $member_id);
$update_stmt->execute();

#刪除Cart_Sum的member id end

#在此頁面執行完刪除資料後，快速連回主頁面 list.php
$comeFrom = './yun_cart.php';

// $_SERVER['HTTP_REFERER'] 為抓取從何來此 PHP 的 URL
// 如果用輸入網址或書籤頁前來則會為空，以下 if(!true)會無法進入，則直接轉跳回 list.php
// 如果是由某頁跳轉而來，例如 list.php?page=2，則將其值存入轉跳網址變數 $comeFrom 內
if(! empty($_SERVER['HTTP_REFERER'])){
    $comeFrom = $_SERVER['HTTP_REFERER'];
}
//

header('Location: '. $comeFrom);
