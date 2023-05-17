<?php

require './parts/kuo_parts/restaurant_connect-db.php';



$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];
if (!empty($_POST['member_name'])) {
    $ispass = true;

    // 把會員名字轉成會員ID讀進資料庫
    $memberName = empty($_POST['member_name']) ? null : $_POST['member_name'];

    $sql_memberId = sprintf("SELECT `member_id` FROM `member` WHERE `member_name` = '%s'", $memberName);

    $memberId = $pdo->query($sql_memberId)->fetch(PDO::FETCH_NUM)[0];


    // 把餐廳名稱轉成餐廳ID讀進資料庫
    $restName = empty($_POST['rest_name']) ? null : $_POST['rest_name'];
    $sql_restId = sprintf("SELECT `rest_id` FROM `restaurant_list` WHERE `rest_name`='%s'", $restName);
    $restrId = $pdo->query($sql_restId)->fetch(PDO::FETCH_NUM)[0];


    $sql = "UPDATE `reserve` SET 
    `member_id`=?,
    `rest_id`=?,
    `reserve_date`=?,
    `reserve_time`=?,
    `reserve_people`=?
     WHERE `reserve_id`=?";


    $stmt = $pdo->prepare($sql);
    // if ($ispass) {
    $stmt->execute([
        $memberId,
        $restrId,
        // $_POST['member_id'],
        // $_POST['rest_id'],
        $_POST['reserve_date'],
        $_POST['reserve_time'],
        $_POST['reserve_people'],
        $_POST['reserve_id']
    ]);
    // }
    $output['success'] = !!$stmt->rowCount();
}

header('Content-Type:application/json');
echo json_encode(
    $output,
    JSON_UNESCAPED_UNICODE
);
