<?php
require './parts/pei_parts/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST, #除錯用
    'code' => 0,
    'error' => '',
];



if (!empty($_POST['name'])) {

    #檢查欄位
    // $open_time = empty($_POST['name']) ? null : $_POST['name'];
    // $public = isset($_POST['public']) ? 1 : 0;

    $sql = "INSERT INTO `Itinerary`(
        `itin_id`, `date`, `name`, 
        `description`, `public`, `ppl`, 
        `member_id`, `create_at`) VALUES (
            ?, ?, ?,
            ?, ?, ?,
            ?, NOW())";



    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['itin_id'],
        $_POST['date'],
        $_POST['name'],
        $_POST['description'],
        $_POST['public'],
        $_POST['ppl'],
        $_POST['member_id'],
    ]);

    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type:application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
