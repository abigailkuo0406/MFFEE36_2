<?php
include './yun_cart_sum-api.php';
?>
<form class="input-group mb-3 w-75 mx-auto" method="GET">
  <input name="search" type="text" class="form-control" placeholder="輸入會員 ID 或 產品 ID" value="<?= isset($_GET['search']) ? $_GET['search'] : null ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
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
#
if($page < 1) {
    // 如果手動亂輸入 page=負數或0，直接轉跳為顯示第一頁
    header('location: ? page = 1'); //在瀏覽器檢視網頁狀態302是指轉向
    exit; // 結束所有code，因為已經要轉跳了，瀏覽器執行下面所有的程式碼是沒有意義的
}

$search = isset($_GET['search']) ? $_GET['search'] : null;
if($search){
  $search_type = 'member';
  $t_sql = "SELECT COUNT(1) FROM Cart WHERE member_id = '$search'";
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  if($totalRows == 0){
    $t_sql = "SELECT COUNT(1) FROM Cart WHERE product_id = '$search'";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    $search_type = 'product';
  }
  $totalPages = ceil($totalRows / $perPage);
  $rowcs = [];
  if($totalRows){
    if ($page > $totalPages) {
      header("Location: ?page=$totalPages");
      exit;
    }
    if($search_type == 'member') {
      $sqlc = sprintf("SELECT Cart.*, Products.* FROM Cart LEFT JOIN Products ON Cart.product_id = Products.product_id WHERE Cart.member_id = '$search'  ORDER BY member_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    } else if($search_type == 'product') {
      $sqlc = sprintf("SELECT Cart.*, Products.* FROM Cart LEFT JOIN Products ON Cart.product_id = Products.product_id WHERE Cart.product_id = '$search'  ORDER BY member_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    }
    $rowcs = $pdo->query($sqlc)->fetchAll();
  }
}else {
  $t_sql = "SELECT COUNT(1) FROM Cart";
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  $totalPages = ceil($totalRows / $perPage);
  $rowcs = [];
  if($totalRows){
    if ($page > $totalPages) {
      header("Location: ?page=$totalPages");
      exit;
    }
    $sqlc = sprintf("SELECT Cart.*, Products.* FROM Cart LEFT JOIN Products ON Cart.product_id = Products.product_id  ORDER BY member_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    $rowcs = $pdo->query($sqlc)->fetchAll();
  }
}
$sql_sum = "SELECT Sum_Cart.*, member.member_id, member.member_name FROM Sum_Cart LEFT JOIN member ON Sum_Cart.member_id = member.member_id";
$rowsum = $pdo->query($sql_sum)->fetchAll();

?>
<?php # include './parts/html-head.php' ?>
<?php # include './parts/navbar.php' ?>


<div class="container-fluid w-75"> 
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
      <th scope="col">會員 ID</th>
      <th scope="col">產品 ID</th>
      <th scope="col">產品名稱</th>
      <th scope="col">產品價格</th>
      <th scope="col">產品數量</th>
      <th scope="col">購買金額</th>
      <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rowcs as $r): ?>
                <tr>
                    <td>
                      <a href="javascript: delete_it(<?= $r['cart_id'] ?>, <?= $r['member_id'] ?>, <?= $r['product_price'] * $r['product_num'] ?>)">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </td>
                    <td><?= htmlentities($r['member_id']) ?></td>
                    <td><?= $r['product_id'] ?></td>
                    <td><?= $r['product_name'] ?></td>
                    <td><?= $r['product_price'] ?></td>
                    <td><?=  $r['product_num'] ?></td>
                    <td><?=  $r['product_price'] * $r['product_num'] ?></td>
                    
                    <td>
                    <!-- 讓 edit.php 帶有 ?sid=頁碼，來判斷是幫哪筆資料編輯 -->
                    <a href="./yun_cart_edit.php?cid=<?= $r['cart_id'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                    </td>
                </tr>
                <?php endforeach; ?>
  </tbody>
</table>
    </div>

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
<?php

$cart_sql = "SELECT Cart.*, member.*
FROM Cart
INNER JOIN member
ON Cart.member_id = member.member_id
";
$dis_sql ="SELECT DISTINCT member_id FROM Cart";
$cart_rows = $pdo->query($cart_sql)->fetchAll();
$dis_rows = $pdo->query($dis_sql)->fetchAll();
?>


  <div class="row">
    <table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">會員 ID</th>
      <th scope="col">會員姓名</th>
      <th scope="col">累積金額</th>
      <th scope="col">結帳</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rowsum as $r): 
    if($r['sum_price']>0.9):
    ?>
    
                <tr>
                    <td><?= $r['member_id'] ?></td>
                    <td><?= $r['member_name'] ?></td>
                    <td><?= $r['sum_price'] ?></td>
                    <td>
                    <a href="javascript: check_it(<?= $r['member_id'] ?>)">
                    <i class="fa-solid fa-check-to-slot"></i>
                      </a></td>
                </tr>
  <?php 
endif;
endforeach; ?>
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
  function delete_it(cid, mid, tid) {
    if(confirm(`是否要刪除購物車編號為：${cid} ，屬於使用者編號為：${mid} ，總價為的：${tid}資料?`)){
      location.href = 'yun_cart_delete.php?cid=' + cid+'&mid='+mid+'&tid='+tid;
    }
  }
  function check_it(mid) {
    if(confirm(`確定要為會員編號：${mid} 結帳?`)){
      location.href = 'yun_order_new.php?mid=' + mid;
    }
  }
</script>
<?php #include './parts/html-foot.php' ?>
