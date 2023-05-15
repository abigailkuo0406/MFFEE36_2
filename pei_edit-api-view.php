<?php
require './parts/pei_parts/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST, #除錯用
    'code' => 0,
    'error' => '',
];


if (!empty($_POST['name']) and !empty($_POST['id'])) {
    $isPass = true;

    #檢查欄位
    $open_time = empty($_POST['open_time']) ? null : $_POST['open_time'];


    $sql = "UPDATE `attractions` SET 
    `city`=?,
    `address`=?,
    `name`=?,
    `typ_id`=?,
    `description`= ?,
    `open_time`= ?,
    `tel`=?
     WHERE `id`=?";


    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['city'],
        $_POST['address'],
        $_POST['name'],
        $_POST['typ_id'],
        $_POST['description'],
        $open_time,
        $_POST['tel'],
        $_POST['id'],
    ]);

    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type:application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
