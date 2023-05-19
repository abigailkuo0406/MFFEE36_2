<?php

require './parts/john_parts/back/part/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
];



if (!empty($_POST['email']) and !empty($_POST['password'])) {

    $sql = "SELECT * FROM manager WHERE email=?";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $_POST['email']
    ]);

    $row = $stmt->fetch();

    if (empty($row)) {
        $output['code'] = 410; # 帳號是錯的
    } else {
        if (password_verify($_POST['password'], $row['password'])) {
            # 密碼也是對的
            $_SESSION['admin'] = $row;
            $output['success'] = true;
        } else {
            # 密碼是錯的
            $output['code'] = 420;
        }
    }
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
