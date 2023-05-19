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

    // $product_id = empty($_POST['product_id']) ? null : $_POST['product_id'];
    // $product_num = empty($_POST['product_num']) ? null : $_POST['product_num'];


/* 成立orders訂單 start */
    $order_sql = "INSERT INTO `Orders`(
        `member_id`
        ,`receiver_name`
        , `receiver_gender`
        , `receiver_address`
        , `receiver_email`
        , `receiver_tel`
        , `order_note`
        , `order_total`
        , `order_time`
        , `ad`
        , `order_complete`
        , `order_status`
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, now(),?,?,?
        )";

    $order_stmt = $pdo->prepare($order_sql);

    if($isPass){
        $order_stmt->execute([
            $_POST['member_id']
            ,$_POST['receiver_name']
            ,$_POST['receiver_gender']
            ,$_POST['receiver_address']
            ,$_POST['receiver_email']
            ,$_POST['receiver_tel']
            ,$_POST['order_note']
            ,$_POST['order_total']
            
            ,$_POST['ad']
            ,0,"訂單成立"
           
        ]);
    
        $output['success'] = !! $order_stmt->rowCount();

        ##當訂單生成後，產生 order id，可以建立新的資料表資料
        $order_id = $pdo->lastInsertId(); #抓取剛生成資料的 order_id

        $jsonData = $_POST['jsonData'];
        $product_data = json_decode($jsonData, true);
        $idArray = $product_data['id'];
        $numArray = $product_data['num'];
        $lengthArray = count($idArray);

        for ($i = 0; $i < $lengthArray; $i++){
            $item_sql = "INSERT INTO `Orders_Items`(
            `order_id`
            ,`product_id`
            , `product_num`
            ) VALUES (
                ?, ?, ?
            )";
    
        $item_stmt = $pdo->prepare($item_sql);
    
        if($isPass){
            $item_stmt->execute([
                $order_id
                ,$idArray[$i]
                ,$numArray[$i]
            ]);
        }

    }
        
            $output['success'] = !! $order_stmt->rowCount();
        
    }
    

    

}
header('Content-Type: application/json');
echo json_encode($output, JSON_UNESCAPED_UNICODE);