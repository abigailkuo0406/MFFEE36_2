<?php
require './parts/pei_parts/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST, #除錯用
    'code' => 0,
    'error' => '',
];



if (!empty($_POST['name'])) {


    $typeName = empty($_POST['type_name']) ? null : $_POST['type_name'];

    $sql_typeid = sprintf("SELECT `id` FROM `attractions＿type` WHERE `type_name`='%s'", $typeName);

    $typeid = $pdo->query($sql_typeid)->fetch(PDO::FETCH_NUM)[0];





    #檢查欄位
    $open_time = empty($_POST['open_time']) ? null : $_POST['open_time'];


    $sql = "INSERT INTO `attractions`(
        `city`,`address`,`name`,
        `typ_id`, `description`, `open_time`, `tel`) VALUES (
            ?, ?, ?,
            ?, ?, ?, ?
        )";


    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['city'],
        $_POST['address'],
        $_POST['name'],
        $typeid,
        $_POST['description'],
        $open_time,
        $_POST['tel'],
    ]);

    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type:application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
