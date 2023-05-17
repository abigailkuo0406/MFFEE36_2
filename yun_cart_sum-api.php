<?php
require './parts/yun_parts/yun_connect-db.php';
#下載此使用者累積金額
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