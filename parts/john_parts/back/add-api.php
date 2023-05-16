<?php
require './parts/john_parts/back/part/connect-db.php';

$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => '',

];
if (isset($_POST['member_name'])) {
    $sql = "INSERT INTO `member`(
        `email`, `password`, `images`, 
        `member_name`, `member_birth`, `id_number`, 
        `gender`, `location`, `height`, 
        `weight`, `zodiac`, `bloodtype`, 
        `smoke`, `alchohol`, `education_level`, 
        `job`, `profile`, `mobile`,
        `create_at`)  VALUES (
        ?, ?, ?,
        ?, ?, ?,
        ?, ?, ?,
        ?, ?, ?,
        ?, ?, ?,
        ?, ?, ?,
        NOW())";
    $stmt = $pdo->prepare($sql);
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
        $_POST['mobile']
    ]);
    $output['success'] = !!$stmt->rowCount();
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
