<?php
require './parts/yun_parts/yun_connect-db.php';
$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => [],
];

$oid = isset($_GET['oid']) ? intval($_GET['oid']) : 0;

    $sql = "UPDATE `Orders` SET
    `order_status`=?
    WHERE `order_id`=? ";

    $stmt = $pdo->prepare($sql);

        $stmt->execute([
            '已取消',
            $oid
        ]);
    
        $output['success'] = !! $stmt->rowCount();


//
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);

$comeFrom = './yun_order.php';

// $_SERVER['HTTP_REFERER'] 為抓取從何來此 PHP 的 URL
// 如果用輸入網址或書籤頁前來則會為空，以下 if(!true)會無法進入，則直接轉跳回 list.php
// 如果是由某頁跳轉而來，例如 list.php?page=2，則將其值存入轉跳網址變數 $comeFrom 內
if(! empty($_SERVER['HTTP_REFERER'])){
    $comeFrom = $_SERVER['HTTP_REFERER'];
}
//

header('Location: '. $comeFrom);