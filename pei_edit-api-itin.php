<?php
require './parts/pei_parts/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST, #除錯用
    'code' => 0,
    'error' => '',
];


if (!empty($_POST['member_id']) and !empty($_POST['itin_id'])) {

    $memberName = empty($_POST['member_id']) ? null : $_POST['member_id'];

    $sql_mid = sprintf("SELECT `member_id` FROM `member` WHERE `member_name`='%s'", $memberName);

    $nemberid = $pdo->query($sql_mid)->fetch(PDO::FETCH_NUM)[0];

    // #檢查欄位
    // $open_time = empty($_POST['name']) ? null : $_POST['name'];


    $sql = "UPDATE `Itinerary` SET
     `date`=?,
     `name`=?,
     `description`=?,
     `public`=?,
     `ppl`=?,
     `member_id`=?
     WHERE `itin_id`=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['date'],
        $_POST['name'],
        $_POST['description'],
        $_POST['public'],
        $_POST['ppl'],
        $nemberid,
        $_POST['itin_id'],
    ]);
    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type:application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
