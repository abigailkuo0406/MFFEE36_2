<?php
  $select = isset($_GET['select']) ? $_GET['select'] : null;
?>
<select name="select" onchange="select_search(this.value)" class="mb-3 w-75 mx-auto">
  <option value="all" <?php if($select =='all'){echo "selected";} ?>>全部訂單</option>
  <option value="launch" <?php if($select =='launch'){echo "selected";} ?>>訂單成立</option>
  <option value="cancel" <?php if($select =='cancel'){echo "selected";} ?>>已取消訂單</option>
  <option value="complete" <?php if($select =='complete'){echo "selected";} ?>>已完成訂單</option>
</select>

</form>
<?php
$pageName = 'list';
$title = '列表';
require './parts/yun_parts/yun_connect-db.php';
#

$perPage = 20; #每頁最多幾筆
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
// 用戶要看第幾頁，強制轉int為了不讓人拿字串亂試網址
// 如果頁面沒有 page (直接進入 list.php，則給予 $page = 1 顯示第一頁)

if($page < 1) {
    // 如果手動亂輸入 page=負數或0，直接轉跳為顯示第一頁
    header('location: ? page = 1'); //在瀏覽器檢視網頁狀態302是指轉向
    exit; // 結束所有code，因為已經要轉跳了，瀏覽器執行下面所有的程式碼是沒有意義的
}

if($select){
  switch ($select)
  {
  case "launch":
    $t_sql = "SELECT COUNT(1) FROM Orders WHERE order_status = '訂單成立'";
    break;  
  case "cancel":
    $t_sql = "SELECT COUNT(1) FROM Orders WHERE order_status = '已取消'";
    break;
  case "complete":
    $t_sql = "SELECT COUNT(1) FROM Orders WHERE order_status = '已完成'";
    break;
  default:
    $t_sql = "SELECT COUNT(1) FROM Orders";
  }
  $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
  $totalPages = ceil($totalRows / $perPage);
  $rowcs = [];
  if($totalRows){
    if ($page > $totalPages) {
      header("Location: ?page=$totalPages");
      exit;
    }

    switch ($select)
      {
      case "launch":
        $sqlc = sprintf("SELECT Orders.*, Sum_Cart.* FROM Orders LEFT JOIN Sum_Cart ON Orders.member_id = Sum_Cart.member_id WHERE Orders.order_status = '訂單成立'  ORDER BY Orders.order_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
        break;  
      case "cancel":
        $sqlc = sprintf("SELECT Orders.*, Sum_Cart.* FROM Orders LEFT JOIN Sum_Cart ON Orders.member_id = Sum_Cart.member_id WHERE Orders.order_status = '已取消'  ORDER BY Orders.order_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
        break;
      case "complete":
        $sqlc = sprintf("SELECT Orders.*, Sum_Cart.* FROM Orders LEFT JOIN Sum_Cart ON Orders.member_id = Sum_Cart.member_id WHERE Orders.order_status = '已完成'  ORDER BY Orders.order_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );
        break;
      default:
      $sqlc = sprintf("SELECT Orders.*, Sum_Cart.* FROM Orders LEFT JOIN Sum_Cart ON Orders.member_id = Sum_Cart.member_id ORDER BY Orders.order_id DESC LIMIT %s, %s", ($page-1)*$perPage, $perPage );      
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
    $sqlc = sprintf(
      "SELECT Orders.*, Sum_Cart.* 
      FROM Orders 
      LEFT JOIN Sum_Cart 
      ON Orders.member_id = Sum_Cart.member_id 
      ORDER BY Orders.order_id 
      DESC LIMIT %s, %s",
      ($page-1)*$perPage, $perPage );
    $rowcs = $pdo->query($sqlc)->fetchAll();
  }
}


?>

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
      <th scope="col">訂單 ID</th>
      <th scope="col">會員 ID</th>
      <th scope="col">訂單金額</th>
      <th scope="col">收件者</th>
      <th scope="col">稱謂</th>
      <th scope="col">收件地址</th>
      <th scope="col">聯絡電話</th>
      <th scope="col">Email</th>
      <th scope="col">訂單備註</th>
      <th scope="col">是否接收廣告</th>
      <th scope="col">成立時間</th>
      <th scope="col">是否完成</th>
      <th scope="col">完成時間</th>
      <th scope="col">訂單狀態</th>
      <th scope="col">取消訂單</th>
      <th scope="col">完成訂單</th>
      <th scope="col">刪除訂單</th>
    </tr>
  </thead>
  <tbody>
    
  <?php
  foreach($rowcs as $r): ?>
                <tr>
                    <td
                      style="<?php
                        if($r['order_status'] =='已取消'){
                          echo "text-decoration: line-through;";
                        }
                      ?>"
                    ><?= $r['order_id'] ?>
                    </td>
                    <td><?= $r['member_id'] ?></td>
                    <td><?= $r['order_total'] ?></td>
                    <td><?= $r['receiver_name'] ?></td>
                    <td><?= $r['receiver_gender'] ?></td>
                    <td><?=  $r['receiver_address'] ?></td>
                    <td><?=  $r['receiver_tel'] ?></td>
                    <td><?=  $r['receiver_email'] ?></td>
                    <td><?=  htmlentities($r['order_note']) ?></td>
                    <td><?=  $r['ad'] ?></td>
                    <td><?=  $r['order_time'] ?></td>
                    <td><?=  $r['order_complete'] ?></td>
                    <td><?=  $r['complete_time'] ?></td>
                    <td><?=  $r['order_status'] ?></td>
                    <td>
                      <a
                      <?php
                        if($r['order_status'] =='訂單成立'){
                          echo "href='javascript: cancel_it(".$r['order_id'].")'";
                        }
                      ?>"
                      >
                      <i class="fa-solid fa-xmark"></i>
                      </a>
                    </td>
                    <td>
                      <a href="./yun_order_edit.php?pid=<?= $r['order_id'] ?>">
                      <a
                      <?php
                        if($r['order_status'] =='訂單成立'){
                          echo "href='javascript: complete_it(".$r['order_id'].")'";
                        }
                      ?>"
                      >
                      <i class="fa-regular fa-circle-check"></i>
                      </a>
                    </td>
                    <td>
                      <a href="javascript: delete_it(<?= $r['order_id'] ?>)">
                        <i class="fa-solid fa-trash-can"></i>
                      </a>
                    </td>
                </tr>
                <tr>
                  <?php

$items_qlc =
"SELECT Orders_Items.*, Orders.order_id
FROM Orders
INNER JOIN Orders_Items
ON Orders.order_id=Orders_Items.order_id
WHERE Orders.order_id = :oid";

$items_stmt = $pdo->prepare($items_qlc);
        $items_stmt->bindParam(':oid', $r['order_id']);
        $items_stmt->execute();
        $items_stmt = $items_stmt->fetchAll();
                foreach ($items_stmt as $ritem):
                ?>
                  <td>
                  <?= '商品：'.$ritem['product_id'].'，數量：'.$ritem['product_num'] ?>
                  </td>
                  <?php endforeach; ?>
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
  function select_search(value) {
    window.location.href = "?select=" + value;
  }



  // 已經在 php for 中的生成頁碼選擇按鈕設置 $i==$page ? 'active' : '' ，所以當前頁面會啟動 active 反白
  // 此程式碼目的為將當前頁碼移除可點擊連結的功能
  document.querySelector('li.page-item.active a').removeAttribute('href');

  // 點擊資料刪除 icon 會啟動的 JS function，點擊確定後連結到 delete.php?sid=編號
  function cancel_it(oid) {
    if(confirm(`是否取消 ID 為：${oid} 的訂單?`)){
      location.href = 'yun_order_cancel-api.php?oid=' + oid;
    }
  }

  function complete_it(oid) {
    if(confirm(`訂單：${oid} 是否完成?`)){
      location.href = 'yun_order_complete-api.php?oid=' + oid;
    }
  }

  function delete_it(oid) {
    if(confirm(`是否要刪除訂單 ID 為：${oid} 的資料?`)){
      location.href = 'yun_order_delete.php?oid=' + oid;
    }
  }

</script>
<?php #include './parts/html-foot.php' ?>
