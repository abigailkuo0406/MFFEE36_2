<?php

require './parts/kuo_parts/restaurant_connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];
if (!empty($_POST['rest_name'])) {
    $ispass = true;

    $sql = "UPDATE restaurant_list SET 
    `rest_name`=?,
    `rest_area`=?, 
    `rest_adress`=?, 
    `rest_lon`=?, 
    `rest_lat`=?, 
    `rest_intro`=?, 
    `rest_class`=? 
    WHERE `rest_id`=?";



    $stmt = $pdo->prepare($sql);

    if ($ispass) {
        $stmt->execute([
            $_POST['rest_name'],
            $_POST['rest_area'],
            $_POST['rest_adress'],
            $_POST['rest_lon'],
            $_POST['rest_lat'],
            $_POST['rest_intro'],
            $_POST['rest_class'],
            $_POST['rest_id']
        ]);
    }
    $output['success'] = !!$stmt->rowCount();
}

header('Content-Type:application/json');
echo json_encode(
    $output,
    JSON_UNESCAPED_UNICODE
);
