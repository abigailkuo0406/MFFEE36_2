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

    $sql = "INSERT INTO `restaurant_class` (
        `rest_class`
        ) VALUES (
            ?
            )";


    $stmt = $pdo->prepare($sql);
    if ($ispass) {
        $stmt->execute([
            $_POST['rest_class'],
        ]);
    }
    $output['success'] = !!$stmt->rowCount();
}

header('Content-Type:application/json');
echo json_encode(
    $output,
    JSON_UNESCAPED_UNICODE
);
