<?php

require './parts/kuo_parts/restaurant_connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];
if (!empty($_POST['rest_class'])) {
    $ispass = true;

    $sql = "UPDATE restaurant_class SET 
    `rest_class`=? 
    WHERE `rest_class_id`=?";



    $stmt = $pdo->prepare($sql);

    // if ($ispass) {
    $stmt->execute([
        $_POST['rest_class'],
        $_POST['rest_class_id']
    ]);
    // }
    $output['success'] = !!$stmt->rowCount();
}

header('Content-Type:application/json');
echo json_encode(
    $output,
    JSON_UNESCAPED_UNICODE
);
