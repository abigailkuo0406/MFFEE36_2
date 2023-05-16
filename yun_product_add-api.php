<?php
require './parts/yun_parts/yun_connect-db.php';
$output = [
    'success' => false,
    'postData' => $_POST, # 除錯用的
    'code' => 0,
    'error' => [],
];

if(!empty($_POST['product_name'])){
    $isPass = true;


    # TODO: 檢查欄位資料
    // $email = trim($_POST['email']); # 去掉頭尾的空白
    // $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    // if(empty($email)){
    //     $isPass = false;
    //     $output['error']['email'] = 'Email 格式不正確';
    // }


    // $birthday = empty($_POST['birthday']) ? null : $_POST['birthday'];


    $sql = "INSERT INTO `Products`(
        `product_name`, `product_price`, `product_brief`,
        `product_category`, `product_launch`,
        `product_discon`, `product_main_img`, `product_description`,
        `product_post`, `product_update`, `product_upload`
        ) VALUES (
            ?, ?, ?,
            ?, ?, ?, ?, ?, ?, NOW(), NOW()
        )";

    $stmt = $pdo->prepare($sql);

    if($isPass){
        $stmt->execute([
            $_POST['product_name'],
            $_POST['product_price'],
            $_POST['product_brief'],
            $_POST['product_category'],
            $_POST['product_launch'],
            $_POST['product_discon'],
            $_POST['product_main_img'],
            $_POST['product_description'],
            $_POST['product_post']
           
        ]);
    
        $output['success'] = !! $stmt->rowCount();
    }
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);