<?php
require './parts/yun_parts/yun_connect-db.php';
$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => [],
];

if(!empty($_POST['member_id'])){
    $isPass = true;


    # TODO: 檢查欄位資料
    // $email = trim($_POST['email']); # 去掉頭尾的空白
    // $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    // if(empty($email)){
    //     $isPass = false;
    //     $output['error']['email'] = 'Email 格式不正確';
    // }


    // $product_id = empty($_POST['product_id']) ? null : $_POST['product_id'];
    // $product_num = empty($_POST['product_num']) ? null : $_POST['product_num'];

    $sql = "INSERT INTO `Orders`(
        `member_id`
        ,`receiver_name`
        , `receiver_gender`
        , `receiver_address`
        , `receiver_email`
        , `receiver_tel`
        , `order_note`
        , `order_total`
        , `order_time`
        , `ads`
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?,999, now(),1
        )";

    $stmt = $pdo->prepare($sql);

    if($isPass){
        $stmt->execute([
            $_POST['member_id']
            ,$_POST['receiver_name']
            ,$_POST['receiver_gender']
            ,$_POST['receiver_address']
            ,$_POST['receiver_email']
            ,$_POST['receiver_tel']
            ,$_POST['order_note']
           
        ]);
    
        $output['success'] = !! $stmt->rowCount();
    }
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);