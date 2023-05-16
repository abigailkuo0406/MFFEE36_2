
<form class="input-group mb-3" method="GET">
  <input name="search" type="text" class="form-control" placeholder="輸入訂單 ID 或 會員 ID" value="<?= isset($_GET['search']) ? $_GET['search'] : null ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
<?php
$pageName = 'list';
$title = '列表';
require './parts/yun_parts/yun_connect-db.php';


$perPage = 20; #每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// 用戶要看第幾頁，強制轉int為了不讓人拿字串亂試網址
// 如果頁面沒有 page (直接進入 list.php，則給予 $page = 1 顯示第一頁)

if($page < 1) {
    // 如果手動亂輸入 page=負數或0，直接轉跳為顯示第一頁
    header('location: ? page = 1'); //在瀏覽器檢視網頁狀態302是指轉向
    exit; // 結束所有code，因為已經要轉跳了，瀏覽器執行下面所有的程式碼是沒有意義的
}

$search = isset($_GET['search']) ? $_GET['search'] : null;
if($search){
  $search_type = 'order';
  $t_sql = "SELECT COUNT(1) FROM Orders WHERE order_id = '$search'";
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  if($totalRows == 0){
    $t_sql = "SELECT COUNT(1) FROM Orders WHERE member_id = '$search'";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    $search_type = 'member';
  }
  $totalPages = ceil($totalRows / $perPage);
  $rowcs = [];
  if($totalRows){
    if ($page > $totalPages) {
      header("Location: ?page=$totalPages");
      exit;
    }
    if($search_type == 'order') {
      $sqlc = sprintf("SELECT Orders.*, Cart.* FROM Orders LEFT JOIN Cart ON Orders.member_id = Cart.member_id WHERE Orders.order_id = '$search'  ORDER BY Orders.order_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    } else if($search_type == 'member') {
      $sqlc = sprintf("SELECT Orders.*, Cart.* FROM Orders LEFT JOIN Cart ON Orders.member_id = Cart.member_id WHERE Orders.member_id = '$search'  ORDER BY Orders.order_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    }
    $rowcs = $pdo->query($sqlc)->fetchAll();
  }
}else {
  $t_sql = "SELECT COUNT(1) FROM Orders";
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  $totalPages = ceil($totalRows / $perPage);
  $rowcs = [];
  if($totalRows){
    if ($page > $totalPages) {
      header("Location: ?page=$totalPages");
      exit;
    }
    $sqlc = sprintf("SELECT Orders.*, Cart.* FROM Orders LEFT JOIN Cart ON Orders.member_id = Cart.member_id ORDER BY Orders.order_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    $rowcs = $pdo->query($sqlc)->fetchAll();
  }
}


?>
<?php # include './parts/html-head.php' ?>
<?php # include './parts/navbar.php' ?>


<div class="container"> 
    <div class="row">

    <!-- 以下為：頁碼選擇 nav -->
    <nav aria-label="Page navigation example">
  <ul class="pagination">


    <!-- 前面到第一頁和前一頁的兩個按鈕 start -->
    <!-- 如果 $page 為1，給予 disabled 不能按按鈕跳到第一頁 ($page 小於1已設定會轉成1) -->
    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=1">
        <i class="fa-solid fa-angles-left"></i>
      </a>
    </li>
    <!-- 如果 $page 為1，給予 disabled 不能按上一頁按鈕 -->
    <li class="page-item <?= 1 == $page ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page - 1 ?>">
        <i class="fa-solid fa-angle-left"></i>
      </a>
    </li>
    <!-- 前面到第一頁和前一頁的兩個按鈕 end -->

    <!-- 中間數字頁碼選項 start -->
    <!-- 可以的話設置加自己頁碼+前後各5個頁碼共11個頁碼 -->
    <?php for($i=$page-5; $i<=$page+5; $i++): 
      if ($i >= 1 and $i <= $totalPages) :  # 讓小於1以及大於總頁數的頁碼不顯示出來
    ?>
        <!--當頁碼$i等於當前頁面時，加上BS屬性 active 讓當前頁碼反白-->
        <li class="page-item <?= $i==$page ? 'active' : '' ?>">
            <a class="page-link" href="?page=<?= $i #href內的 ?>"><?= $i #<a>顯示html的?></a>
        </li>
    <?php endif;
    endfor; ?>
    <!-- 中間數字頁碼選項 end -->

    <!-- 後面到上一頁和到最後一頁的兩個按鈕 start -->
    <!-- 如果現在頁碼 $page 等於總共頁碼 $totalPages 就會 disabled-->
    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $page + 1 ?>">
        <i class="fa-solid fa-angle-right"></i>
      </a>
    </li>
    <li class="page-item <?= $totalPages == $page ? 'disabled' : '' ?>">
      <a class="page-link" href="?page=<?= $totalPages ?>">
        <i class="fa-solid fa-angles-right"></i>
      </a>
    </li>
    <!-- 後面到上一頁和到最後一頁的兩個按鈕 end -->
  </ul>
</nav>
    </div>
    <div class="row">
    <table class="table table-bordered table-striped">
  <thead>
    <tr>
    <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
      <th scope="col">訂單 ID</th>
      <th scope="col">會員 ID</th>
      <th scope="col">訂購商品</th>
      <th scope="col">訂購總金額</th>
      <th scope="col">收件者</th>
      <th scope="col">稱謂</th>
      <th scope="col">收件地址</th>
      <th scope="col">Email</th>
      <th scope="col">聯絡電話</th>
      <th scope="col">訂單備註</th>
      <th scope="col">成立時間</th>
      <th scope="col">是否接收廣告</th>
      <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rowcs as $r): ?>
                <tr>
                    <td>
                      <a href="javascript: delete_it(<?= $r['order_id'] ?>)">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </td>
                    <td><?= $r['order_id'] ?></td>
                    <td><?= $r['member_id'] ?></td>
                    <td><?= $r['product_id'] ?></td>
                    <td><?= $r['product_id'] * $r['product_num'] ?></td>
                    <td><?= $r['receiver_name'] ?></td>
                    <td><?= $r['receiver_gender'] ?></td>
                    <td><?=  $r['receiver_address'] ?></td>
                    <td><?=  $r['receiver_email'] ?></td>
                    <td><?=  $r['receiver_tel'] ?></td>
                    <td><?=  htmlentities($r['order_note']) ?></td>
                    <td><?=  $r['order_time'] ?></td>
                    <td><?=  $r['ads'] ?></td>
                    <td>
                    <!-- 讓 edit.php 帶有 ?sid=頁碼，來判斷是幫哪筆資料編輯 -->
                    <a href="./yun_order_edit.php?pid=<?= $r['order_id'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                    </td>
                </tr>
                <?php endforeach; ?>
  </tbody>
</table>
    </div>
</div>



<?php #include './parts/scripts.php' ?>
<script>
  // 已經在 php for 中的生成頁碼選擇按鈕設置 $i==$page ? 'active' : '' ，所以當前頁面會啟動 active 反白
  // 此程式碼目的為將當前頁碼移除可點擊連結的功能
  document.querySelector('li.page-item.active a').removeAttribute('href');

  // 點擊資料刪除 icon 會啟動的 JS function，點擊確定後連結到 delete.php?sid=編號
  function delete_it(pid) {
    if(confirm(`是否要刪除商品 ID 為：${pid} 的資料?`)){
      location.href = 'yun_product_delete.php?pid=' + pid;
    }
  }
</script>
<?php #include './parts/html-foot.php' ?>
