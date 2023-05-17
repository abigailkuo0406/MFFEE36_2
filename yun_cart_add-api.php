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
//

    $product_id = empty($_POST['product_id']) ? null : $_POST['product_id'];
    $product_num = empty($_POST['product_num']) ? null : $_POST['product_num'];

    $sql = "INSERT INTO `Cart`(
        `member_id`, `product_id`, `product_num`
        ) VALUES (
            ?, ?, ?
        )";

    $stmt = $pdo->prepare($sql);

    if($isPass){
        $stmt->execute([
            $_POST['member_id'],
            $product_id,
            $product_num
           
        ]);
    
        $output['success'] = !! $stmt->rowCount();
    if($output['success'] != false){
        $check_sql = "SELECT COUNT(*) FROM Sum_Cart WHERE member_id = :check_member_id";
$check_stmt = $pdo->prepare($check_sql);
$check_member_id = $_POST['member_id'];
$check_stmt->bindParam(':check_member_id', $check_member_id);
$check_stmt->execute();
$count = $check_stmt->fetchColumn();

if ($count > 0) {
    //已經有member id
    $find_cart_sql = "SELECT member_id FROM Cart";
    $find_cart_stmt = $pdo->query($find_cart_sql);
    $find_cart_member = $find_cart_stmt->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($find_cart_member as $change_member) {
                
                $change_sql = 
                "SELECT SUM(Cart.product_num * Products.product_price) AS total
                FROM Cart
                INNER JOIN Products ON Cart.product_id = Products.product_id
                WHERE Cart.member_id = :change_member";
                $change_stmt = $pdo->prepare($change_sql);
                $change_stmt->bindParam(':change_member', $change_member);
                $change_stmt->execute();
                $total= $change_stmt->fetchColumn();
    
                $sum_sql = "UPDATE `Sum_Cart` SET 
                `sum_price`=?
                WHERE `member_id`=? ";
    
                $sum_stmt = $pdo->prepare($sum_sql);
    
                    $sum_stmt->execute([
                    $total,
                    $change_member
                   
                    ]);
                }
} else {
    //沒有member id
    $new_member_id = $_POST['member_id'];
        $update_sql = "INSERT INTO Sum_Cart SET member_id = :new_member_id";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->bindParam(':new_member_id', $new_member_id);
        $update_stmt->execute(); 
}
    }
        
    }
}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);