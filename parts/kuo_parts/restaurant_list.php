<?php
// 連線資料庫
require './';

// 每頁要顯示的資料數量
$perPageDataNum = 5;


$sql = 'SELECT * FROM restaurant LIMIT 0,5';
$rows = $pdo->query($sql)->fetchAll();




?>




<div class="container">
    <pre>
        <?= print_r($rows) ?>
    </pre>

</div>