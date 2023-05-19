
<form class="input-group mb-3 w-75 mx-auto" method="GET">
  <input name="search" type="text" class="form-control" placeholder="輸入商品名稱或 ID" value="<?= isset($_GET['search']) ? $_GET['search'] : null ?>" aria-label="Recipient's username" aria-describedby="button-addon2">
    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
</form>
<?php
$pageName = 'list';
$title = '列表';
require './parts/yun_parts/yun_connect-db.php';


$perPage = 10; #每頁最多幾筆
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
  $search_type = 'id';
  $t_sql = "SELECT COUNT(1) FROM Products WHERE product_id = '$search'";
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  if($totalRows == 0){
    $t_sql = "SELECT COUNT(1) FROM Products WHERE product_name = '$search'";
    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    $search_type = 'name';
  }
  $totalPages = ceil($totalRows / $perPage);
  $rows = [];
  if($totalRows){
    if ($page > $totalPages) {
      header("Location: ?page=$totalPages");
      exit;
    }
    if($search_type == 'id') {
      $sql = sprintf("SELECT * FROM Products WHERE product_id = '$search' ORDER BY product_id DESC  LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    } else if($search_type == 'name') {
      $sql = sprintf("SELECT * FROM Products WHERE product_name = '$search' ORDER BY product_id DESC  LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    }
    $rows = $pdo->query($sql)->fetchAll();
  }
}else {
  $t_sql = "SELECT COUNT(1) FROM Products";
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  $totalPages = ceil($totalRows / $perPage);
  $rows = [];
  if($totalRows){
    if ($page > $totalPages) {
      header("Location: ?page=$totalPages");
      exit;
    }
    $sql = sprintf("SELECT * FROM Products ORDER BY product_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
    $rows = $pdo->query($sql)->fetchAll();
  }
}


?>
<?php ## include './parts/html-head.php' ?>
<?php # include './parts/navbar.php' ?>
<?php if($totalPages<1){$totalPages = 1;} ?>

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
<a class="nav-link <?= $pageName=='add' ? 'active' : '' ?>" href="yun_product_add.php"><button class="btn"><i class="fa-solid fa-folder-plus"></i></button></a>
    </div>
    <div class="row">
    <table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">商品名稱</th>
      <th scope="col">價格</th>
      <th scope="col">簡述</th>
      <th scope="col">分類</th>
      <th scope="col">上架時間</th>
      <th scope="col">下架時間</th>
      <th scope="col">主圖</th>
      <th scope="col">描述</th>
      <th scope="col">商品頁連結</th>
      <th scope="col">最新修改</th>
      <th scope="col">上傳日期</th>
      <th scope="col">修改商品</th>
      <th scope="col">刪除商品</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rows as $r): ?>
                <tr>
                    <td><?= $r['product_id'] ?></td>
                    <td><?= htmlentities($r['product_name']) ?></td>
                    <td><?= $r['product_price'] ?></td>
                    <td><?= htmlentities($r['product_brief']) ?></td>
                    <td><?= $r['product_category'] ?></td>
                    <td style="font-size:12px;"><?= $r['product_launch'] ?></td>
                    <!-- htmlentities 為將所有 HTML 標籤無作用直接顯示化，避免遭受 <script> 埋入 JS 搞破壞 -->
                    <td style="font-size:12px;"><?=  $r['product_discon'] ?></td>
                    <td><img src="<?php
                    $imageUrl = $r['product_main_img'];
                    $imageContent = @file_get_contents("./imgs/".$imageUrl);
                    if($imageContent == true){
                      echo "./imgs/".$imageUrl;
                    } else if($imageContent == false) {
                      echo "https://digitalfinger.id/wp-content/uploads/2019/12/no-image-available-icon-6.png";
                    }
               
                     ?>"></td>
                    <td><?=  htmlentities($r['product_description']) ?></td>
                    <td><?=  htmlentities($r['product_post']) ?></td>
                    <td style="font-size:12px;"><?=  $r['product_update'] ?></td>
                    <td style="font-size:12px;"><?=  $r['product_upload'] ?></td>
                    <td>
                    <!-- 讓 edit.php 帶有 ?sid=頁碼，來判斷是幫哪筆資料編輯 -->
                    <a href="./yun_product_edit.php?pid=<?= $r['product_id'] ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                    </td>
                    <td>
                      <!-- 點選快速連到delete.php頁面執行刪除後快速返回此list.php頁面 -->
                      <!-- href="javascript: JS程式碼" 代表點選後會觸發 JS 程式碼 -->
                      <!-- 因為要埋入 JS 的 confirm() 詢問是否要刪除才使用 JS function -->
                      <a href="javascript: delete_it(<?= $r['product_id'] ?>)">
                        <i class="fa-solid fa-trash-can"></i>
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
