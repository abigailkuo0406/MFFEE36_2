<?php

require './parts/yun_parts/yun_connect-db.php';

$mid = isset($_GET['mid']) ? intval($_GET['mid']) : 0;


$cart_sql = " DELETE FROM Cart WHERE member_id={$mid}";

$pdo->query($cart_sql);



$sum_sql = "UPDATE `Sum_Cart` SET
    `sum_price`=?
    
    WHERE `member_id`=? ";
    $sum_stmt = $pdo->prepare($sum_sql);

  
        $sum_stmt->execute([
            0,
            $mid
        ]);






$comeFrom = './yun_order.php';



header('Location: '. $comeFrom);
?>