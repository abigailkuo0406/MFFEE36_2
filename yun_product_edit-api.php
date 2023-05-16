<?php
require './parts/yun_parts/yun_connect-db.php';
$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => [],
];
if(! empty($_POST['product_name']) and ! empty($_POST['product_id'])){
    $isPass = true;

    $sql = "UPDATE `Products` SET
    `product_name`=?,
    `product_price`=?,
    `product_brief`=?,
    `product_category`=?,
    `product_launch`=?,
    `product_discon`=?,
    `product_main_img`=?,
    `product_description`=?,
    `product_post`=?,
    `product_update`= NOW()
    
    WHERE `product_id`=? ";
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
            $_POST['product_post'],
            $_POST['product_id'],
        ]);
    
        $output['success'] = !! $stmt->rowCount();
    }
}


header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
