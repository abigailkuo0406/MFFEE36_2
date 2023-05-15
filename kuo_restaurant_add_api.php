<?php

require './parts/kuo_parts/restaurant_connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => [],
];
if (!empty($_POST['rest_name'])) {
    $ispass = true;

    $sql = "INSERT INTO `restaurant_list` (
        `rest_name`, `rest_area_id`, `rest_adress`, 
        `rest_lon`, `rest_lat`, `rest_intro`, 
        `rest_class_id`, `created_time`
        ) VALUES (
            ?,?,?, 
            ?,?,?,
            ?,NOW() 
            )";
    $stmt = $pdo->prepare($sql);
    if ($ispass) {
        $stmt->execute([
            $_POST['rest_name'],
            $_POST['rest_area_id'],
            $_POST['rest_adress'],
            $_POST['rest_lon'],
            $_POST['rest_lat'],
            $_POST['rest_lon'],
            $_POST['rest_intro'],
            $_POST['rest_class_id'],
        ]);
    }
    $output['success'] = !!$stmt->rowCount();
}
// header('Content-Type:application/json');
// echo json_encode(
//     $output,
//     JSON_UNESCAPED_UNICODE
// );
