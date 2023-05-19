<?php
// require './parts/admin-required.php';
require './parts/john_parts/back/part/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => [],
];



// if (!empty($_POST['name']) and !empty($_POST['member_id'])) {
$isPass = true;


# TODO: 檢查欄位資料
// $email = trim($_POST['email']); # 去掉頭尾的空白
// $email = filter_var($email, FILTER_VALIDATE_EMAIL);
// if (empty($email)) {
//     $isPass = false;
//     $output['error']['email'] = 'Email 格式不正確';
// }




$sql = "UPDATE `member` SET 
    `email`=?,
    `password`=?,
    `images`=?,
    `member_name`=?,
    `member_birth`=?,
    `id_number`=?,
    `gender`=?,
    `location`=?,
    `height`=?,
    `weight`=?,
    `zodiac`=?,
    `bloodtype`=?,
    `smoke`=?,
    `alchohol`=?,
    `education_level`=?,
    `job`=?,
    `profile`=?,
    `mobile`=?
    WHERE `member_id`=? ";

$stmt = $pdo->prepare($sql);

// if ($isPass) {
$stmt->execute([
    $_POST['email'],
    $_POST['password'],
    $_POST['images'],
    $_POST['member_name'],
    $_POST['member_birth'],
    $_POST['id_number'],
    $_POST['gender'],
    $_POST['location'],
    $_POST['height'],
    $_POST['weight'],
    $_POST['zodiac'],
    $_POST['bloodtype'],
    $_POST['smoke'],
    $_POST['alchohol'],
    $_POST['education_level'],
    $_POST['job'],
    $_POST['profile'],
    $_POST['mobile'],
    $_POST['member_id']
]);

$output['success'] = !!$stmt->rowCount();
// }

// }
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
