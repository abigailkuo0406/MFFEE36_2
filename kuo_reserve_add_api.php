<?php

require './parts/kuo_parts/restaurant_connect-db.php';

// $memberName = $_POST['member_name'];
//  $memberName = 'aaa'
//  $sql_memberId = sprintf("SELECT `member_id` FROM `member` WHERE `member_name`=%s",$memberName);
//  $memberId = $pdo->query($sql_memberId)->fetch();
//  echo print_r($memberId);
//  exit;

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
];
// if (!empty($_POST['rest_name'])) {
$ispass = true;




// $restName = $_POST['rest_name'];
// $sql_restId = "SELECT `rest_id` FROM `restaurant_list` WHERE `rest_name`=$restName]";
// $restrId = $pdo->query($sql_restId)->fetch(PDO::FETCH_NUM)[0];

// echo $memberId
// echo $restrId
// exit

$memberName = empty($_POST['member_name']) ? null : $_POST['member_name'];
$sql_memberId = sprintf("SELECT `member_id` FROM `member` WHERE `member_name`=%s", $memberName);
$memberId = $pdo->query($sql_memberId)->fetch();
echo print_r($memberId);
exit;

$sql = "INSERT INTO `reserve`
    (`member_id`, `rest_id`, `reserve_date`, `reserve_people`) 
    VALUES (?,?,?,?)";


$stmt = $pdo->prepare($sql);
if ($ispass) {
    $stmt->execute([
        // $memberId['member_id'],
        // $restrId,
        $_POST['member_id'],
        $_POST['rest_id'],
        $_POST['reserve_date'],
        $_POST['reserve_people'],
    ]);
}
$output['success'] = !!$stmt->rowCount();
// }

header('Content-Type:application/json');
echo json_encode(
    $output,
    JSON_UNESCAPED_UNICODE
);
