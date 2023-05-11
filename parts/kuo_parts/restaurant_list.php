<?php
// 連線資料庫
require './parts/kuo_parts/restaurant_connect-db.php';

// 每頁要顯示的資料數量
$perPageDataNum = 5;

$sql = 'SELECT * FROM restaurant_list LIMIT 0,5';
$rows = $pdo->query($sql)->fetchAll();







?>




<div class="container">
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">餐廳編號</th>
                    <th scope="col">餐廳名稱</th>
                    <th scope="col">所在縣市</th>
                    <th scope="col">地址</th>
                    <th scope="col">經度</th>
                    <th scope="col">緯度</th>
                    <th scope="col">介紹文字</th>
                    <th scope="col">餐廳類型</th>
                    <th scope="col">創建日期</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['rest_id'] ?></td>
                        <td><?= $r['rest_name'] ?></td>
                        <td><?= $r['rest_area_id'] ?></td>
                        <td><?= $r['rest_adress'] ?></td>
                        <td><?= $r['rest_lon'] ?></td>
                        <td><?= $r['rest_lat'] ?></td>
                        <td><?= $r['rest_intro'] ?></td>
                        <td><?= $r['rest_class_id'] ?></td>
                        <td><?= $r['created_time'] ?></td>


                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>