<?php
require './parts/yun_parts/yun_connect-db.php';
$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => [],
];
if(! empty($_POST['member_id'])){
    $isPass = true;

    #查詢資料表 SUM start
    // $member_id = $_POST['member_id'];
    // $sum_sql = "SELECT * FROM Sum_Cart WHERE  member_id = :member_id";
    // $sum_stmt = $pdo->prepare($sum_sql);
    // $sum_stmt->bindParam(':member_id', $member_id); #綁定參數使用於SQL參數用冒號開頭，綁定給 PHP變數 $member_id
    // $sum_stmt->execute();
    // $sum_price= $sum_stmt->fetch(PDO::FETCH_ASSOC)['sum_price'];
   
    #查詢資料表 SUM end

    $sql = "UPDATE `Cart` SET
    `product_id`=?,
    `product_num`=?
    
    WHERE `cart_id`=? ";
    $stmt = $pdo->prepare($sql);

    if($isPass){
        $stmt->execute([
            $_POST['product_id'],
            $_POST['product_num'],
            $_POST['cart_id']
        ]);
    
        $output['success'] = !! $stmt->rowCount();
        if($output['success'] != false) {
            include './yun_cart_sum-api.php';
        }
    }
}

//
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);
